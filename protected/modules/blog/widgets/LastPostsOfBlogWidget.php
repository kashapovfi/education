<?php

/**
 * LastPostsOfBlogWidget виджет для вывода последних записей блога
 *
 * @author yupe team <team@yupe.ru>
 * @link http://yupe.ru
 * @copyright 2009-2013 amyLabs && Yupe! team
 * @package yupe.modules.blog.widgets
 * @since 0.1
 *
 */
Yii::import('application.modules.blog.models.*');

class LastPostsOfBlogWidget extends yupe\widgets\YWidget
{
    public $blogId;
    public $view = 'lastpostsofblog';
    public $customPosts = false;

    public function run()
    {
        $usersCount = User::model()->findAll();

        if ($this->customPosts === false) {
            $posts = Post::model()->getByMonth(date('m'), date('Y'));
            $this->render($this->view, array('posts' => $posts, 'model' => Post::model()));
        } else {
            $this->render($this->view, array('posts' => $this->customPosts));
        }

    }
}