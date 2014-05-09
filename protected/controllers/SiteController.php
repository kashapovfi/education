<?php

/**
 * Дефолтный контроллер сайта:
 *
 * @category YupeController
 * @package  yupe.controllers
 * @author   YupeTeam <team@yupe.ru>
 * @license  BSD http://ru.wikipedia.org/wiki/%D0%9B%D0%B8%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D1%8F_BSD
 * @version  0.5.3 (dev)
 * @link     http://yupe.ru
 *
 **/
class SiteController extends yupe\components\controllers\FrontController
{
    const POST_PER_PAGE = 5;
    const CRON_KEY = 'secret_cron_keyqmeter';

    public function actionModern()
    {
        $this->render('modern');
    }

    public function actionTest()
    {
        //Yii::app()->mailer->send('diwms@yandex.ua', 'THEME', 'CONTENT');
        $this->renderPartial('mail');
    }


    /**
     * Отображение главной страницы
     *
     * @return void
     */
    public function actionIndex()
    {
        $this->render('index');
    }

    /**
     * Отображение для ошибок:
     *
     * @return void
     */
    public function actionError()
    {
        $error = Yii::app()->errorHandler->error;

        if (empty($error) || !isset($error['code']) || !(isset($error['message']) || isset($error['msg']))) {
            $this->redirect(array('index'));
        }

        if (!Yii::app()->getRequest()->getIsAjaxRequest()) {

            $this->render(
                'error',
                array(
                    'error' => $error
                )
            );
        }
    }


    public function actionMain()
    {
        $dataProvider = new CActiveDataProvider('Post', array(

            'criteria' => new CDbCriteria(array(
                    'condition' => 't.status = :status',
                    'params' => array(':status' => Post::STATUS_PUBLISHED),
                    'limit' => self::POST_PER_PAGE,
                    'order' => 't.id DESC',
                    'with' => array('createUser', 'blog', 'commentsCount'),
                )),
        ));

        $this->render('main', array('dataProvider' => $dataProvider));
    }

    /**
     * Check for a job and send mails
     *
     * TODO: After testing move to mail module
     */
    public function actionCron($api = null)
    {
        if (!$api || $api !== self::CRON_KEY) {
            exit('What you want?');
        } else {
            
            Yii::import('application.modules.mail.models.*');

            /**
             * Алгоритм
             *
             * 1) Нам треба подивитись які є івенти
             * 2) Аналіз івента, якщо підходяща дата то грузим темплейт
             * 3) Парсим темплейт, підставляєм дані і все-таке.
             * 4) Відправляєм адресату
             */


            $events = MailEvent::model()->findAll();
            $today = date('d', strtotime('today'));

            foreach ($events as $event) {
                //Якщо треба виконувати кожного місяця. Тобто маємо не одноразову подію
                if ((bool)$event->every_month) {
                    //Якщо день збігається з сьогоднішнім
                    $eventDay = date('d', strtotime($event->date));

                    if ($today === $eventDay) {
                        //На один день в нас може бути декілька темплейтів, значить обходим їх
                        $templates = MailTemplate::model()->findAllByAttributes(array('event_id' => $event->id));
                        foreach ($templates as $template) {
                            //Якщо статус активний
                            if ($template->status) {
                                //Кому відправляєм?
                                if ($template->to == 'all') {
                                    $users = User::model()->findAll();
                                    //Ну і циклів тут %)
                                    foreach ($users as $user) {
                                        if ($this->_userHaveUndonedReport($user->id)) {
                                            //Рендер темплейта
                                            $mailHtml = $this->renderPartial(
                                                'mail',
                                                array(
                                                    'title' => $template->theme,
                                                    'content' => $template->body
                                                ),
                                                true
                                            );

                                            $SM = Yii::app()->swiftMailer;

                                            $pEmailGmail = 'educations.reports.mailer@gmail.com';
                                            $pFromName = 'Education Reports Notification';

                                            $transport = Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');

                                            $mMailer = Swift_Mailer::newInstance($transport);

                                            $mEmail = Swift_Message::newInstance();
                                            $mEmail->setSubject($template->name);
                                            $mEmail->setTo($user->email);
                                            $mEmail->setFrom(array($pEmailGmail => $pFromName));
                                            $mEmail->setBody($mailHtml, 'text/html'); //body html

                                            if ($mMailer->send($mEmail) !== 1) {
                                                Yii::log('Message send error!');
                                            }
                                        } else {
                                            continue;
                                        }
                                    }
                                }
                            } else {
                                continue;
                            }
                        }
                    } else {
                        continue;
                    }
                }
            }
        }

    }

    /**
     * Хелпер функція, перевіримо чи юзер має не зазвітований звіт
     * При відправці будемо дивитись, якщо в нього все ок то нема чого сіпати
     *
     * В майбутньому як фічу можна буде прикрутити щось типу:
     * а) Маєш звіт не виконаний - паршивець, лист на ящик
     * б) Маєш виконаний звіт - красавчик, лист подяки на ящик
     */
    private
    function _userHaveUndonedReport(
        $userid = null
    ) {
        if (!$userid) {
            return false;
        }

        $user = User::model()->findByPk($userid);
        if (!$user) {
            throw new CException('User Not Exist!');
        } else {
            $report = Post::model()->getByMonth(date('m'), date('Y'), $userid);

            if (isset($report[0])) {
                return $report[0]->progress == 5 ? false : true;
            }

            return false;
        }
    }
}
