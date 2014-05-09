<?php

$mainAssets = Yii::app()->AssetManager->publish(
    Yii::app()->theme->basePath . "/web/"
);

Yii::app()->clientScript->registerCssFile($mainAssets . '/css/last-posts.css');

    $this->breadcrumbs = array(Yii::t('UserModule.user', 'Users') => array('/user/userBackend/index'), $model->first_name . ' ' . $model->last_name,
    );

    $this->pageTitle = Yii::t('UserModule.user', 'Users - show'); ?>
<div class="page-header">
    <h1 style="text-align: center">
        <?php echo Yii::t('UserModule.user', 'Show user history'); ?><br />
        <small>&laquo;<?php echo $model->first_name, ' ', $model->last_name; ?>&raquo;</small>
    </h1>
</div>



<div class="alert alert-info"><h4 style="text-align: center; text-transform: uppercase">Latest reports: </h4></div>

<?php $posts = Post::model()->getByUser($model->id); ?>
    <div class="posts well">

        <?php if(!empty($posts)) : ?>

        <div class="posts-list">
    <?php foreach ($posts as $post):
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
        <h4 style="text-align: center">User doesn't have any reports yet</h4>
        <?php endif; ?>

    </div>
</div>


<div class="alert alert-error alert-block"><h4 style="text-align: center; text-transform: uppercase">Nonexistents reports: </h4></div>

<?php foreach(Yii::app()->params->realMonths as $monthDig => $monthName): ?>
    <?php $post = Post::model()->getByMonth($monthDig,  date('Y'), $model->id); if(!$post): ?>

        <div class="well">
            <p>Report for <strong><?php echo $monthName, ' ', date('Y'); ?> </strong> does't exist</p>
        </div>
    <?php endif; ?>
<?php endforeach; ?>