<div class="row">
    <div class="span8">
        <p></p>
        <p>
            <?php echo CHtml::image($post->createUser->getAvatar(16));?> <?php echo CHtml::link($post->createUser->nick_name, array('/user/people/userInfo', 'username' => $post->createUser->nick_name)); ?>
            | <i class="icon-pencil"></i> <?php echo CHtml::link($post->blog->name, array('/blog/blog/show/', 'slug' => $post->blog->slug)); ?>
            | <i class="icon-calendar"></i> <?php echo Yii::app()->getDateFormatter()->formatDateTime($post->publish_date, "long", "short"); ?>
            | <i class="icon-comment"></i>  <?php echo CHtml::link(($post->commentsCount>0)? $post->commentsCount-1 : 0 , array('/blog/post/show/', 'slug' => $post->slug, '#' => 'comments'));?>
hnbhjbhj
        </p>
    </div>
</div>