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

class LastPostsOfBlogWidget extends YWidget
{
    public $blogId;
    public $view = 'lastpostsofblog';
    public $customPosts = false;

    public function run()
    {
        $usersCount = User::model()->findAll();

        if ($this->customPosts === false) {
            $posts = Yii::app()->db->createCommand()
                ->select('*')
                ->from('{{blog_post}}')
                ->where('year(FROM_UNIXTIME(create_date)) = :year and month(FROM_UNIXTIME(create_date)) = :month',
                    array(':year' => date('Y'), ':month' => date('m')))
                ->andWhere('blog_id=:blog_id', array(':blog_id' => $this->blogId))
                ->setFetchMode(PDO::FETCH_OBJ)
                ->order('progress ASC')
                ->limit(count($usersCount))
                ->queryAll();
            $this->render($this->view, array('posts' => $posts));
        } else {
            $this->render($this->view, array('posts' => $this->customPosts));
        }

    }
}