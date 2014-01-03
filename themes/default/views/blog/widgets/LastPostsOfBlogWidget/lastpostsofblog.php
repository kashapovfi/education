<?php

Yii::import('application.modules.blog.BlogModule');

$mainAssets = Yii::app()->AssetManager->publish(
    Yii::app()->theme->basePath . "/web/"
);

Yii::app()->clientScript->registerCssFile($mainAssets . '/css/last-posts.css'); ?>

<div class="posts">
    <p class="posts-header">
    </p>

    <div class="posts-list">
        <?php foreach ($posts as $post): ?>
            <div class="posts-list-block" style="margin-bottom: -10px">
                <div class="posts-list-block-header">
                    <?php echo CHtml::link(
                        CHtml::encode($post->title), array(
                            '/blog/post/show/',
                            'slug' => $post->slug
                        )
                    ); ?>
                </div>

                <div class="posts-list-block-meta">
                    <span>
                        <i class="icon-user"></i>

                        <?php $this->widget(
                            'application.modules.user.widgets.UserPopupInfoWidget', array(
                                'model' => $post->createUser
                            )
                        ); ?>
                    </span>


                    <span>
                        <i class="icon-calendar"></i>

                        <?php echo Yii::app()->getDateFormatter()->formatDateTime(
                            $post->publish_date
                        ); ?>
                    </span>
                </div>

                <div class="posts-list-block-text">
                    <?php echo $post->content; ?>
                </div>
            </div>
            <hr>
        <?php endforeach; ?>
    </div>
</div>