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

    /**
     * Отображение главной страницы
     *
     * @return void
     */
    public function actionIndex($slug = null)
    {
        $blog = Blog::model()->with('posts', 'members', 'createUser')->getByUrl($slug)->published()->find();
        $this->render('index', array('blog' => $blog));
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

        if (Yii::app()->getRequest()->getIsAjaxRequest()) {
            echo json_encode(
                $error
            );
        } else {
            $this->render(
                'error',
                array(
                    'error' => $error
                )
            );
        }
    }

    /**
     * Import users
     */
    public function actionImport()
    {
        $xml = simplexml_load_file(Yii::app()->getBasePath() . '/../ternopil.xml');
        $count = count($xml->Worksheet->Table->Row);


        for ($i = 2; $i <= $count; $i++) {
            $cells = $xml->Worksheet[0]->Table->Row[$i];

            $index = 0;

            if (!is_object($cells))
                continue;

            foreach ($cells as $cell) {

                //1 - Fist and LAst name (eng)
                //2 - position (developer, tester etc)
                //3 - project branch
                //8 5sb 5jn
                //13 domen and login
                //14 corp mail
                //17 home phone
                //18 mob phone
                //23 custom mail
                //25 skype
                //28 Last name (uk)
                //29 first name uk
                //30 patronymic
                //31 gender Male/Female
                //35 month
                //34 day

                if ($index == 1) {
                    //0 first name
                    //1 last name
                    $userName = explode(' ', $cell->Data);
                }

                if ($index == 13) {
                    $userLogin = str_replace('eleks-software\\', '', $cell->Data);
                }

                if ($index == 2) {
                    $position = $cell->Data;
                }

                if ($index == 30) {
                    $patronymic = $cell->Data;
                }

                if ($index == 31) {
                    $gender = $cell->Data == 'Male' ? User::GENDER_MALE : User::GENDER_FEMALE;
                }

                if ($index == 14) {
                    $email = $cell->Data;
                }

                if ($index == 4) {
                    $l1 = $cell->Data;
                }


                $index++;
            }


            try {
                $push = new User();
                $push->first_name = $userName[0];
                $push->last_name = $userName[1];
                $push->nick_name = $userLogin;
                $push->position = $position;
                $push->gender = $gender;
                $push->email_confirm = 1;
                $push->email = $email;
                $push->L1 = $l1;

                $push->save(false);

            } catch (CException $e) {
                throw new CException($e->getMessage());
            }
        }

    }

    public function actionMail()
    {
        if (mail('myroslav.zozulia@eleks.com', 'Test', 'Hello')) {
            echo 'yes';
        } else echo 'no';
    }

    public function actionHash()
    {
        echo CPasswordHelper::hashPassword('123456789');
    }

    public function actionTest()
    {
        echo 11 == 11 && 11 != 11 ? 'yes' : 'no';


    }
}