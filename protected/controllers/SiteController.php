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
}