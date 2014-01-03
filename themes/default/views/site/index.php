<?php if (Yii::app()->user->isAuthenticated()): ?>
    <?php $this->widget('blog.widgets.ActivePlanWidget', array('userId' => Yii::app()->user->getId())); ?>
<?php endif; ?>


<?php $this->widget('blog.widgets.LastPostsOfBlogWidget', array('blogId' => 1, 'limit' => 10)); ?>