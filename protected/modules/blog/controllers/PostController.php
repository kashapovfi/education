<?php

/**
 * PostController контроллер для постов на публичной части сайта
 *
 * @author yupe team <team@yupe.ru>
 * @link http://yupe.ru
 * @copyright 2009-2013 amyLabs && Yupe! team
 * @package yupe.modules.blog.controllers
 * @since 0.1
 *
 */
class PostController extends yupe\components\controllers\FrontController
{

    public function actionIndex()
    {
        $this->render('index', array('model' => Post::model()));
    }


    /**
     * Создает новую модель записи.
     * Если создание прошло успешно - перенаправляет на просмотр.
     *
     * @return void
     */
    public function actionCreate()
    {
        $model = new Post;

        $postData = Yii::app()->getRequest()->getPost('Post');

        if (isset($postData['publish_date']) && $postData['publish_date'] !== ''
            && $postData['publish_date'] !== date('d-m-Y h:i')) {
            $monthforPreg = date('m', strtotime($postData['publish_date']));

            if (strpos($monthforPreg, '0') === 0) {
                $monthforPreg = str_replace('0', '', $monthforPreg);
            }

            $model->progress = Post::PROGRESS_NOT_DONE;

        } else {
            $monthforPreg = $model->publish_date = date('d-m-Y h:i');
        }

        if ($model->userHaveMonthPlan(Yii::app()->user->getId(), $monthforPreg)) {

            $model->blog_id = 1;
            $model->status = POST::STATUS_PUBLISHED;


            if (Yii::app()->getRequest()->getIsPostRequest() && Yii::app()->getRequest()->getPost('Post')) {
                $model->setAttributes(
                    Yii::app()->getRequest()->getPost('Post')
                );


                if ($model->save()) {
                    Yii::app()->user->setFlash(
                        yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                        Yii::t('BlogModule.blog', 'Plan successfully created')
                    );

                    $this->redirect(Yii::app()->baseUrl);
                }
            }
        } else {
            Yii::app()->user->setFlash(
                yupe\widgets\YFlashMessages::ERROR_MESSAGE,
                Yii::t('BlogModule.blog', 'You can create plan. Plan already exist!')
            );
            $this->redirect(Yii::app()->baseUrl);
        }

        $this->render('crud/create', array('model' => $model));
    }

    /**
     * Редактирование записи.
     *
     * @param integer $id the ID of the model to be updated
     * @throws CHttpException
     * @return void
     */
    public function actionUpdate($id)
    {
        if (($model = Post::model()->loadModel($id)) === null) {
            throw new CHttpException(404, Yii::t('BlogModule.blog', 'Requested page was not found!'));
        }

        //Не даєм редагувати чужий план, Адмін тільки може так робити :)
        if (Yii::app()->user->getId() !== $model->create_user_id AND !Yii::app()->user->isSuperUser()) {
            Yii::app()->user->setFlash(
                yupe\widgets\YFlashMessages::ERROR_MESSAGE,
                Yii::t('BlogModule.blog', 'You can edit only own plan')
            );

            $this->redirect(Yii::app()->baseUrl);
        }

        if ($model->progress == 5 AND !Yii::app()->user->getState('isAdmin')) {
            Yii::app()->user->setFlash(
                yupe\widgets\YFlashMessages::ERROR_MESSAGE,
                Yii::t('BlogModule.blog', 'You can\'t edit the completed plan!')
            );

            $this->redirect(Yii::app()->baseUrl);
        }

        if (Yii::app()->getRequest()->getIsPostRequest() && Yii::app()->getRequest()->getPost('Post')) {
            $model->setAttributes(
                Yii::app()->getRequest()->getPost('Post')
            );
            $model->setTags(
                Yii::app()->getRequest()->getPost('tags')
            );

            if ($model->save()) {
                Yii::app()->user->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('BlogModule.blog', 'Plan was successfully updated')
                );

                $this->redirect(Yii::app()->baseUrl);
            }
        }

        $this->render('crud/update', array('model' => $model));
    }

    public function actionMonth()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $year = Yii::app()->request->getPost('year', 0);
            $month = Yii::app()->request->getPost('month', 0);

            $error = '<div class="alert alert-error alert-block">
            <h4 style="text-align: center">Reports not found</h4></div>';

            $posts = Post::model()->getByMonth($month, $year);
            $posts_content = count($posts) > 0 ? $posts : $error;

            $data = $this->renderPartial(
                '//blog/widgets/LastPostsOfBlogWidget/lastpostsofblog',
                array('posts' => $posts_content, 'model' => Post::model()),
                true
            );

            Yii::app()->ajax->raw(array('status' => 200, 'data' => $data));

        } else {
            echo json_encode(array('status' => 500, 'message' => 'Bad Request'));
        }
    }
}