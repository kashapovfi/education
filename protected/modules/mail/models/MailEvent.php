<?php

/**
 * This is the model class for table "mail_event".
 *
 * The followings are the available columns in table 'mail_event':
 *
 * @property string $id
 * @property string $name
 * @property string $every_month
 * @property string $date
 *
 * The followings are the available model relations:
 * @property MailTemplate[] $mailTemplates
 *
 * MailEvent model class
 * Класс модели MailEvent
 *
 * @category YupeModel
 * @package  yupe.modules.models
 * @author   YupeTeam <team@yupe.ru>
 * @license  BSD https://raw.github.com/yupe/yupe/master/LICENSE
 * @link     http://yupe.ru
 **/
class MailEvent extends yupe\models\YModel
{
    /**
     * Returns the static model of the specified AR class.
     *
     * @param string $className active record class name.
     *
     * @return MailEvent the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * Получаем название таблицы:
     *
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{mail_mail_event}}';
    }

    /**
     * Получаем правила валидации:
     *
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name', 'filter', 'filter' => array($obj = new CHtmlPurifier(), 'purify')),
            array('name, date, every_month', 'required'),
            array('every_month', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 300),
            // Please remove those attributes that should not be searched.
            array('id, name, date', 'safe', 'on' => 'search'),
        );
    }

    /**
     * Получаем свзи данной таблицы:
     *
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'templates' => array(self::HAS_MANY, 'MailTemplate', 'event_id'),
        );
    }

    /**
     * Получаем атрибуты меток полей таблицы:
     *
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('MailModule.mail', 'ID'),
            'date' => Yii::t('MailModule.mail', 'Event Date'),
            'every_month' => Yii::t('MailModule.mail', 'Do event every month?'),
            'name' => Yii::t('MailModule.mail', 'Title'),
        );
    }

    /**
     * Получение короткого описания:
     *
     * @return string short decription
     **/
    public function getShortDescription()
    {
        if (strlen($this->description) <= 100)
            return $this->description;
        else
            return substr($this->description, 0, 100) . " ...";
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('name', $this->name, true);

        return new CActiveDataProvider(get_class($this), array('criteria' => $criteria));
    }
}