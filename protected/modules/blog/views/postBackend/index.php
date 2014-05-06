<?php
/**
 * Отображение для postBackend/index:
 * 
 *   @category YupeView
 *   @package  yupe
 *   @author   Yupe Team <team@yupe.ru>
 *   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 *   @link     http://yupe.ru
 **/
$this->breadcrumbs = array(   
    Yii::t('BlogModule.blog', 'Plans') => array('/blog/postBackend/index'),
    Yii::t('BlogModule.blog', 'Administration'),
);

$this->pageTitle = Yii::t('BlogModule.blog', 'Posts - administration');

$this->menu = array(

    array('label' => Yii::t('BlogModule.blog', 'Posts'), 'items' => array(
        array('icon' => 'list-alt', 'label' => Yii::t('BlogModule.blog', 'Manage Plans'), 'url' => array('/blog/postBackend/index')),
        array('icon' => 'plus-sign', 'label' => Yii::t('BlogModule.blog', 'Add a Plan'), 'url' => array('/blog/postBackend/create')),
    )),
);
?>
<div class="page-header">
    <h1>
        <?php echo Yii::t('BlogModule.blog', 'User Plans'); ?>
        <small><?php echo Yii::t('BlogModule.blog', 'administration'); ?></small>
    </h1>
</div>

<br/>

<?php $this->widget(
    'yupe\widgets\CustomGridView', array(
        'id'           => 'post-grid',
        'type'         => 'condensed',
        'dataProvider' => $model->search(),
        'filter'       => $model,
        'bulkActions'      => array(
            'actionButtons' => array(
                array(
                    'id'         => 'delete-comment',
                    'buttonType' => 'button',
                    'type'       => 'danger',
                    'size'       => 'small',
                    'label'      => Yii::t('BlogModule.blog', 'Remove'),
                    'click'      => 'js:function(values){ if(!confirm("' . Yii::t('BlogModule.blog', 'Do you really want to delete selected items?') . '")) return false; multiaction("delete", values); }',
                ),
            ),
            'checkBoxColumnConfig' => array(
                'name' => 'id'
            ),
        ),
        'columns' => array( 
            array(
                'name'  => 'id',
                'value' => 'CHtml::link($data->id, array("/blog/postBackend/update","id" => $data->id))',
                'type'  => 'html',
                'htmlOptions' => array(
                    'style' => 'width:10px;'
                )
            ),



            array(
                'class' => 'bootstrap.widgets.TbEditableColumn',                
                'name'  => 'publish_date',
                'editable' => array(   
                    'url'  => $this->createUrl('/blog/postBackend/inline'),
                    'mode' => 'inline',
                    'type' => 'datetime',
                    'options' => array(
                        'datetimepicker' => array(
                           'format' => 'dd-mm-yyyy hh:ii'
                        ),
                        'datepicker' => array(
                            'format' => 'dd-mm-yyyy hh:ii'
                        ),
                    ),
                    'params' => array(
                        Yii::app()->request->csrfTokenName => Yii::app()->request->csrfToken
                    )                                 
                )                           
            ),

            array(
                'name'   => 'create_user_id',
                'type'   => 'raw',
                'value'  => 'CHtml::link($data->createUser->getFullName(), array("/user/userBackend/view", "id" => $data->createUser->id))',
                'filter' => CHtml::listData(User::model()->cache($this->yupe->coreCacheTime)->findAll(),'id','nick_name')
            ),

            array(
                'name'   => 'content',
                'type'   => 'raw',
                'value'  => '$data->content',
            ),

            array(
                'name'   => 'progress',
                'type'   => 'raw',
                'value'  => 'Post::model()->getProgressAsString($data->progress)',
            ),


            array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'template' => '{update} {delete}'
            ),
        ),
    )
); ?>