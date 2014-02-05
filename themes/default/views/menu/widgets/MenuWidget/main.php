<?php
$this->widget('bootstrap.widgets.TbNavbar', array(
    'collapse' => true,
    'brand' => CHtml::image(
            Yii::app()->baseUrl . '/web/images/eleks.png',
            'Education Reports',
            array(
                'width' => '40',
                'height' => '40',
                'title' => Yii::app()->name,
            )
        ),
    'brandUrl' => array('/' . Yii::app()->defaultController . '/index/'),
    'items' => array(
        array(
            'class' => 'bootstrap.widgets.TbMenu',
            'items' => $this->params['items'],
        ),
        array(
            'class' => 'bootstrap.widgets.TbMenu',
            'items' => $this->controller->yupe->getLanguageSelectorArray(),
            'htmlOptions' => array(
                'class' => 'pull-right',
            ),
        )
    ),
));