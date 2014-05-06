<?php

$mainAssets = Yii::app()->AssetManager->publish(
    Yii::app()->theme->basePath . "/web/"
);

Yii::app()->clientScript->registerCssFile($mainAssets . '/css/last-posts.css');

    $this->breadcrumbs = array(Yii::t('UserModule.user', 'Users') => array('/user/userBackend/index'), $model->first_name . ' ' . $model->last_name,
    );

    $this->pageTitle = Yii::t('UserModule.user', 'Users - show');

//    $this->menu = array(
//        array('label' => Yii::t('UserModule.user', 'Users'), 'items' => array(
//            array('icon' => 'list-alt', 'label' => Yii::t('UserModule.user', 'Manage users'), 'url' => array('/user/userBackend/index')),
//            array('icon' => 'plus-sign', 'label' => Yii::t('UserModule.user', 'Create user'), 'url' => array('/user/userBackend/create')),
//            array('label' => Yii::t('UserModule.user', 'User') . ' «' . $model->nick_name . '»'),
//            array('icon' => 'pencil', 'label' => Yii::t('UserModule.user', 'Edit user'), 'url' => array(
//                '/user/userBackend/update',
//                'id' => $model->id
//            )),
//            array('icon' => 'eye-open', 'label' => Yii::t('UserModule.user', 'Show user'), 'url' => array(
//                '/user/userBackend/view',
//                'id' => $model->id
//            )),
//            array('icon' => 'lock', 'label' => Yii::t('UserModule.user', 'Change user password'), 'url' => array(
//                '/user/userBackend/changepassword',
//                'id' => $model->id
//            )),
//            array('icon' => 'trash', 'label' => Yii::t('UserModule.user', 'Remove user'), 'url' => '#', 'linkOptions' => array(
//                'submit' => array('/user/userBackend/delete', 'id' => $model->id),
//                'params' => array(Yii::app()->getRequest()->csrfTokenName => Yii::app()->getRequest()->csrfToken),
//                'confirm' => Yii::t('UserModule.user', 'Do you really want to remove user?')),
//            ),
//        )),
//        array('label' => Yii::t('UserModule.user', 'Tokens'), 'items' => array(
//            array('icon' => 'list-alt', 'label' => Yii::t('UserModule.user', 'Token list'), 'url' => array('/user/tokensBackend/index')),
//        )),
//    );
?>
<div class="page-header">
    <h1 style="text-align: center">
        <?php echo Yii::t('UserModule.user', 'Show user history'); ?><br />
        <small>&laquo;<?php echo $model->first_name, ' ', $model->last_name; ?>&raquo;</small>
    </h1>
</div>



<div class="alert alert-info"><h4 style="text-align: center; text-transform: uppercase">Latest reports: </h4></div>

<?php $posts = Post::model()->getByUser($model->id); ?>
<div class="posts">

    <div class="posts-list">
        <?php
        if(!empty($posts)) :

        foreach ($posts as $post):
            $status = $post->progress == 5
                ? array('state' => array('disabled' => 'disabled', 'class' => 'btn btn-warning btn-large'))
                : array('class' => 'btn-danger', 'state' => array('disabled' => 'disabled', 'class' => 'btn btn-warning btn-large'));
            ?>

            <div class="panel panel-default posts-list-block">
                                    <span class="pull-right" style="padding: 10px">
                        <span class="label <?php echo $status['class']; ?>"><?php echo Post::model()->getProgressAsString($post->progress); ?></span>
                    </span>
                <div class="posts-list-block-meta panel-body">
                    <span>
                        <i class="icon-calendar"></i>

                        <b>
                        <?php echo Yii::app()->getDateFormatter()->formatDateTime(
                            $post->publish_date, 'full','short'
                        ); ?>
                            </b>
                    </span>
                </div>

                <div class="posts-list-block-text" style="word-break: break-all">
                    <?php echo $post->content; ?>
                </div>
            </div>
            <hr>
        <?php endforeach; ?>

        <?php else: ?>
        <div class=""
        <?php endif; ?>

    </div>
</div>


<div class="alert alert-error"><h4 style="text-align: center; text-transform: uppercase">Nonexistents reports: </h4></div>

