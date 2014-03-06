<?php if (Yii::app()->user->isAuthenticated()): ?>
    <?php $this->widget('blog.widgets.ActivePlanWidget', array('userId' => Yii::app()->user->getId())); ?>
<?php endif; ?>

<div class="post_content">
<?php $this->widget('blog.widgets.LastPostsOfBlogWidget', array('blogId' => 1)); ?>
</div>

<div class="panel panel-default">
    <div class="panel-body">

        <select id="reports_year" disabled="disabled" class="pull-left">
            <option value="2014">2014</option>
        </select>

        <select id="reports_month" class="pull-right">
            <?php $i=0; foreach (Yii::app()->params->months as $key => $value) :  if($i>=12)break; ?>
                <option <?php echo date('F') !== $value ? '' : 'selected="selected"'; ?>
                    value="<?php echo $key; ?>"><?php echo $value; ?></option>
            <?php $i++; endforeach; ?>
        </select>
    </div>
</div>