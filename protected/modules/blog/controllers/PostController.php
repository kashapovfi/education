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

        if ($model->canUserCreatePlan(Yii::app()->user->getId()) || Yii::app()->user->getState('isAdmin')) {

            $model->publish_date_tmp = date('d-m-Y');
            $model->publish_time_tmp = date('h:i');
            //Set
            $model->blog_id = 1;
            $model->status = POST::STATUS_PUBLISHED;

            if (Yii::app()->getRequest()->getIsPostRequest() && Yii::app()->getRequest()->getPost('Post')) {
                $model->setAttributes(
                    Yii::app()->getRequest()->getPost('Post')
                );
                $model->setTags(
                    Yii::app()->getRequest()->getPost('tags')
                );

                if ($model->save()) {
                    Yii::app()->user->setFlash(
                        YFlashMessages::SUCCESS_MESSAGE,
                        Yii::t('BlogModule.blog', 'Plan successfully created')
                    );
                    $this->redirect('/');
                }
            }
        } else {
            Yii::app()->user->setFlash(
                YFlashMessages::ERROR_MESSAGE,
                Yii::t('BlogModule.blog', 'Only one plan per month!')
            );
            $this->redirect('/');
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
                YFlashMessages::ERROR_MESSAGE,
                Yii::t('BlogModule.blog', 'You can edit only own plan')
            );

            $this->redirect('/');
        }

        if ($model->progress == 5 AND !Yii::app()->user->getState('isAdmin')) {
            Yii::app()->user->setFlash(
                YFlashMessages::ERROR_MESSAGE,
                Yii::t('BlogModule.blog', 'You can\'t edit the completed plan!')
            );

            $this->redirect('/');
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
                    YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('BlogModule.blog', 'Plan was successfully updated')
                );

                $this->redirect('/');
            }
        }

        $this->render('crud/update', array('model' => $model));
    }

    /**
     * Показываем пост по урлу
     *
     * @param string $slug - урл поста
     * @throws CHttpException
     * @return void
     */
    public function actionShow($slug)
    {
        $post = Post::model()->get($slug, array('blog', 'createUser', 'comments.author'));

        if (null === $post) {
            throw new CHttpException(404, Yii::t('BlogModule.blog', 'Post was not found!'));
        }

        $this->render('show', array('post' => $post));
    }

    /**
     * Показываем посты по тегу
     *
     * @param string $tag - Tag поста
     *
     * @return void
     */
    public function actionList($tag)
    {
        $tag = CHtml::encode($tag);

        $posts = Post::model()->getByTag($tag);

        if (empty($posts)) {
            throw new CHttpException(404, Yii::t('BlogModule.blog', 'Posts not found!'));
        }

        $this->render(
            'list', array(
                'posts' => $posts,
                'tag' => $tag,
            )
        );
    }

    public function actionBlog($slug)
    {
        $blog = Blog::model()->getByUrl($slug)->find();

        if (null === $blog) {
            throw new CHttpException(404);
        }

        $posts = new Post('search');
        $posts->unsetAttributes();
        $posts->blog_id = $blog->id;
        $posts->status = Post::STATUS_PUBLISHED;
        $posts->access_type = Post::ACCESS_PUBLIC;

        $this->render('blog-post', array('target' => $blog, 'posts' => $posts));
    }


    public function actionCategory($alias)
    {
        $category = Category::model()->cache($this->yupe->coreCacheTime)->find('alias = :alias', array(
            ':alias' => $alias
        ));

        if (null === $category) {
            throw new CHttpException(404, Yii::t('BlogModule.blog', 'Page was not found!'));
        }

        $posts = new Post('search');
        $posts->unsetAttributes();
        $posts->category_id = $category->id;

        $this->render('blog-post', array('target' => $category, 'posts' => $posts));
    }

    public function actionView($id)
    {
        $id = (int)$id;

        if (!$id) {
            throw new CHttpException(404, Yii::t('BlogModule.blog', 'Page was not found!'));
        }

        $post = Post::model()->get($id);

        if (null === $post) {
            throw new CHttpException(404, Yii::t('BlogModule.blog', 'Page was not found!'));
        }

        $this->redirect(array('/blog/post/show', 'slug' => $post->slug), true, 301);
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

            $data = $this->renderPartial('//blog/widgets/LastPostsOfBlogWidget/lastpostsofblog', array('posts' => $posts_content), true);

            Yii::app()->ajax->raw(array('status' => 200, 'data' => $data));

        } else echo json_encode(array('status' => 500, 'message' => 'Bad Request'));
    }
}