<?php

Yii::import('application.modules.blog.BlogModule');

$mainAssets = Yii::app()->AssetManager->publish(
    Yii::app()->theme->basePath . "/web/"
);

Yii::app()->clientScript->registerCssFile($mainAssets . '/css/last-posts.css');

if (is_string($posts)) {
    echo json_encode(array('status' => 200, 'data' => $posts));
    Yii::app()->end();
}
?>

<div class="posts">
    <p class="posts-header">
        <b>OUR PLANS IN THIS MONTH</b>
    </p>

    <div class="posts-list">
        <?php foreach ($posts as $post):
            $status = $post->progress == 5
                ? array('class' => 'btn-success', 'text' => 'COMPLETED',
                    'state' => array('disabled' => 'disabled', 'class' => 'btn btn-warning btn-large'))
                : array('class' => 'btn-danger', 'text' => 'IN PROGRESS',
                    'state' => array('disabled' => 'disabled', 'class' => 'btn btn-warning btn-large'));
            ?>
            <div class="panel panel-default posts-list-block">
                                    <span class="pull-right" style="padding: 10px">
                        <span class="label <?php echo $status['class']; ?>"><?php echo $model->getProgressAsString($post->progress); ?></span>
                    </span>
                <div class="posts-list-block-meta panel-body">
                    <span>
                        <i class="icon-user"></i>
                        <?php $user = User::model()->findByPk($post->create_user_id); echo $user->first_name, ' ', $user->last_name; ?>
                    </span>


                    <span>
                        <i class="icon-calendar"></i>

                        <?php echo Yii::app()->getDateFormatter()->formatDateTime(
                            $post->publish_date, 'medium','short'
                        ); ?>
                    </span>

                    <?php if(Yii::app()->user->id == $post->create_user_id): ?>
                    <span><?php echo CHtml::link('<i class="icon-pencil"></i> [Edit]', array('post/update', 'id' => $post->id)); ?></span>
            <?php endif; ?>


                </div>

                <div class="posts-list-block-text" style="word-break: break-all">
                    <?php echo $post->content; ?>
                </div>
            </div>
            <hr>
        <?php endforeach; ?>
    </div>
</div>