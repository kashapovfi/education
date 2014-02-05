<?php
/**
 * Виводить активний план
 *
 * Created by PhpStorm.
 * User: Myroslav.Zozulia
 * Date: 03.01.14
 * Time: 16:10
 */

Yii::import('application.modules.blog.models.*');

class ActivePlanWidget extends yupe\widgets\YWidget
{
    public $userId;
    public $view = 'activeplan';

    public function run()
    {
        $plan = Post::model()->public()->sortByPubDate('DESC')->with('commentsCount', 'createUser', 'blog')->findAll(array(
            'condition' => 't.create_user_id = :create_user_id AND t.blog_id = 1',
            'order' => 't.id DESC',
            'limit' => 1,
            'params' => array(
//                ':blog_id' => 1,
                ':create_user_id' => (int)$this->userId
            )
        ));

        $this->render($this->view, array('plan' => $plan));
    }
}