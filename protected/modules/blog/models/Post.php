<?php
/**
 * Post
 *
 * Модель для работы с постами
 *
 * @author yupe team <team@yupe.ru>
 * @link http://yupe.ru
 * @copyright 2009-2013 amyLabs && Yupe! team
 * @package yupe.modules.blog.models
 * @since 0.1
 *
 */

/**
 * This is the model class for table "post".
 *
 * The followings are the available columns in table 'post':
 * @property string $id
 * @property string $blog_id
 * @property string $create_user_id
 * @property string $update_user_id
 * @property integer $create_date
 * @property integer $update_date
 * @property string $slug
 * @property string $publish_date
 * @property string $title
 * @property string $quote
 * @property string $content
 * @property string $link
 * @property integer $status
 * @property integer $comment_status
 * @property integer $access_type
 * @property string $keywords
 * @property string $description
 * @property string $lang
 * @property string $create_user_ip
 * @property string $image
 * @property integer $category_id
<<<<<<< HEAD
 * @property integer $progress
=======
>>>>>>> 882a53f9cfa014a21be8fc828efa50a76758b123
 *
 * The followings are the available model relations:
 * @property User $createUser
 * @property User $updateUser
 * @property Blog $blog
 */
Yii::import('application.modules.blog.models.Blog');
<<<<<<< HEAD

class Post extends YModel
{
    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED = 1;
    const STATUS_SHEDULED = 2;

    //Plan progress
    const STATUS_CREATED = 1;
    const STATUS_POOR_DONE = 2;
    const STATUS_REGULAR_DONE = 3;
    const STATUS_ALMOST_DONE = 4;
    const STATUS_DONE = 5;

    const ACCESS_PUBLIC = 1;
    const ACCESS_PRIVATE = 2;

    public $publish_date_tmp;
    public $publish_time_tmp;

=======
 
class Post extends yupe\models\YModel
{
    const STATUS_DRAFT     = 0;
    const STATUS_PUBLISHED = 1;
    const STATUS_SHEDULED  = 2;

    const ACCESS_PUBLIC  = 1;
    const ACCESS_PRIVATE = 2;

>>>>>>> 882a53f9cfa014a21be8fc828efa50a76758b123
    /**
     * Returns the static model of the specified AR class.
     * @param string $className
     * @return Post the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{blog_post}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
<<<<<<< HEAD
            array('blog_id, publish_date_tmp, publish_time_tmp, content', 'required', 'except' => 'search'),
            array('blog_id, create_user_id, update_user_id, status, comment_status, access_type, create_date, update_date, category_id', 'numerical', 'integerOnly' => true),
            array('blog_id, progress, create_user_id, update_user_id, create_date, update_date, publish_date, status, comment_status, access_type', 'length', 'max' => 11),
            array('lang', 'length', 'max' => 2),
=======
            array('blog_id, slug,  title, content, status, publish_date', 'required', 'except' => 'search'),
            array('blog_id, create_user_id, update_user_id, status, comment_status, access_type, create_date, update_date, category_id', 'numerical', 'integerOnly' => true),
            array('blog_id, create_user_id, update_user_id, create_date, update_date, status, comment_status, access_type', 'length', 'max' => 11),
            array('lang', 'length', 'max' => 2),
            array('publish_date', 'length', 'max' => 16),
>>>>>>> 882a53f9cfa014a21be8fc828efa50a76758b123
            array('slug', 'length', 'max' => 150),
            array('image', 'length', 'max' => 300),
            array('create_user_ip', 'length', 'max' => 20),
            array('quote, description, title, link, keywords', 'length', 'max' => 250),
<<<<<<< HEAD
            array('publish_date_tmp', 'type', 'type' => 'date', 'dateFormat' => 'dd-mm-yyyy'),
            array('publish_time_tmp', 'type', 'type' => 'time', 'timeFormat' => 'hh:mm'),
            array('link', 'YUrlValidator'),
            array('comment_status', 'in', 'range' => array(0, 1)),
            array('access_type', 'in', 'range' => array_keys($this->getAccessTypeList())),
            array('status', 'in', 'range' => array_keys($this->getStatusList())),
            array('slug', 'YSLugValidator', 'message' => Yii::t('BlogModule.blog', 'Forbidden symbols in {attribute}')),
            array('title, slug, link, keywords, description, publish_date', 'filter', 'filter' => array($obj = new CHtmlPurifier(), 'purify')),
            array('slug', 'unique'),
            array('id, progress, blog_id, create_user_id, update_user_id, create_date, update_date, slug, publish_date, title, quote, content, link, status, comment_status, access_type, keywords, description, lang', 'safe', 'on' => 'search'),
=======
            array('link', 'yupe\components\validators\YUrlValidator'),
            array('comment_status', 'in', 'range' => array(0, 1)),
            array('access_type', 'in', 'range' => array_keys($this->getAccessTypeList())),
            array('status', 'in', 'range' => array_keys($this->getStatusList())),
            array('slug', 'yupe\components\validators\YSLugValidator', 'message' => Yii::t('BlogModule.blog', 'Forbidden symbols in {attribute}')),
            array('title, slug, link, keywords, description, publish_date', 'filter', 'filter' => array($obj = new CHtmlPurifier(), 'purify')),
            array('slug', 'unique'),
            array('id, blog_id, create_user_id, update_user_id, create_date, update_date, slug, publish_date, title, quote, content, link, status, comment_status, access_type, keywords, description, lang', 'safe', 'on' => 'search'),
>>>>>>> 882a53f9cfa014a21be8fc828efa50a76758b123
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'createUser' => array(self::BELONGS_TO, 'User', 'create_user_id'),
            'updateUser' => array(self::BELONGS_TO, 'User', 'update_user_id'),
<<<<<<< HEAD
            'blog' => array(self::BELONGS_TO, 'Blog', 'blog_id'),
            'comments' => array(self::HAS_MANY, 'Comment', 'model_id',
                'on' => 'model = :model AND comments.status = :status', 'params' => array(
=======
            'blog'       => array(self::BELONGS_TO, 'Blog', 'blog_id'),
            'comments'   => array(self::HAS_MANY,'Comment','model_id',
                'on' => 'model = :model AND comments.status = :status','params' => array(
>>>>>>> 882a53f9cfa014a21be8fc828efa50a76758b123
                    ':model' => 'Post',
                    ':status' => Comment::STATUS_APPROVED
                ),
                'order' => 'comments.id'
            ),
<<<<<<< HEAD
            'commentsCount' => array(self::STAT, 'Comment', 'model_id',
                'condition' => 'model = :model AND status = :status', 'params' => array(
=======
            'commentsCount' => array(self::STAT,'Comment','model_id',
                'condition' => 'model = :model AND status = :status','params' => array(
>>>>>>> 882a53f9cfa014a21be8fc828efa50a76758b123
                    ':model' => 'Post',
                    ':status' => Comment::STATUS_APPROVED
                )
            ),
<<<<<<< HEAD
            'category' => array(self::BELONGS_TO, 'Category', 'category_id')
=======
            'category' => array(self::BELONGS_TO,'Category','category_id')
>>>>>>> 882a53f9cfa014a21be8fc828efa50a76758b123
        );
    }

    public function scopes()
    {
        return array(
            'published' => array(
                'condition' => 't.status = :status',
<<<<<<< HEAD
                'params' => array(':status' => self::STATUS_PUBLISHED),
            ),
            'public' => array(
                'condition' => 't.access_type = :access_type',
                'params' => array(':access_type' => self::ACCESS_PUBLIC),
=======
                'params'    => array(':status' => self::STATUS_PUBLISHED),
            ),
            'public' => array(
                'condition' => 't.access_type = :access_type',
                'params'    => array(':access_type' => self::ACCESS_PUBLIC),
>>>>>>> 882a53f9cfa014a21be8fc828efa50a76758b123
            ),
            'recent' => array(
                'order' => 'publish_date DESC'
            )
        );
    }

    /**
     * Условие для получения определённого количества записей:
<<<<<<< HEAD
     *
     * @param integer $count - количество записей
     *
=======
     * 
     * @param integer $count - количество записей
     * 
>>>>>>> 882a53f9cfa014a21be8fc828efa50a76758b123
     * @return self
     */
    public function limit($count = null)
    {
        $this->getDbCriteria()->mergeWith(
            array(
                'limit' => $count,
            )
        );
        return $this;
    }

    /**
     * Условие для сортировки по дате
     *
     * @param string $typeSort - типо сортировки
     *
     * @return self
     **/
    public function sortByPubDate($typeSort = 'ASC')
    {
        $this->getDbCriteria()->mergeWith(
            array(
                'order' => $this->getTableAlias() . '.publish_date ' . $typeSort,
            )
        );
        return $this;
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
<<<<<<< HEAD
            'id' => Yii::t('BlogModule.blog', 'id'),
            'blog_id' => Yii::t('BlogModule.blog', 'Blog'),
            'create_user_id' => Yii::t('BlogModule.blog', 'Created'),
            'update_user_id' => Yii::t('BlogModule.blog', 'Update user'),
            'create_date' => Yii::t('BlogModule.blog', 'Created at'),
            'update_date' => Yii::t('BlogModule.blog', 'Updated at'),
            'publish_date' => Yii::t('BlogModule.blog', 'Date'),
            'publish_date_tmp' => Yii::t('BlogModule.blog', 'Publish date'),
            'publish_time_tmp' => Yii::t('BlogModule.blog', 'Publish time'),
            'slug' => Yii::t('BlogModule.blog', 'Url'),
            'title' => Yii::t('BlogModule.blog', 'Title'),
            'quote' => Yii::t('BlogModule.blog', 'Quote'),
            'content' => Yii::t('BlogModule.blog', 'Content'),
            'link' => Yii::t('BlogModule.blog', 'Link'),
            'status' => Yii::t('BlogModule.blog', 'Status'),
            'comment_status' => Yii::t('BlogModule.blog', 'Comments'),
            'access_type' => Yii::t('BlogModule.blog', 'Access'),
            'keywords' => Yii::t('BlogModule.blog', 'Keywords'),
            'description' => Yii::t('BlogModule.blog', 'description'),
            'tags' => Yii::t('BlogModule.blog', 'Tags'),
            'image' => Yii::t('BlogModule.blog', 'Image'),
            'category_id' => Yii::t('BlogModule.blog', 'Category'),
            'progress' => 'Progress'
=======
            'id'               => Yii::t('BlogModule.blog', 'id'),
            'blog_id'          => Yii::t('BlogModule.blog', 'Blog'),
            'create_user_id'   => Yii::t('BlogModule.blog', 'Created'),
            'update_user_id'   => Yii::t('BlogModule.blog', 'Update user'),
            'create_date'      => Yii::t('BlogModule.blog', 'Created at'),
            'update_date'      => Yii::t('BlogModule.blog', 'Updated at'),
            'publish_date'     => Yii::t('BlogModule.blog', 'Date'),
            'slug'             => Yii::t('BlogModule.blog', 'Url'),
            'title'            => Yii::t('BlogModule.blog', 'Title'),
            'quote'            => Yii::t('BlogModule.blog', 'Quote'),
            'content'          => Yii::t('BlogModule.blog', 'Content'),
            'link'             => Yii::t('BlogModule.blog', 'Link'),
            'status'           => Yii::t('BlogModule.blog', 'Status'),
            'comment_status'   => Yii::t('BlogModule.blog', 'Comments'),
            'access_type'      => Yii::t('BlogModule.blog', 'Access'),
            'keywords'         => Yii::t('BlogModule.blog', 'Keywords'),
            'description'      => Yii::t('BlogModule.blog', 'description'),
            'tags'             => Yii::t('BlogModule.blog', 'Tags'),
            'image'            => Yii::t('BlogModule.blog', 'Image'),
            'category_id'      => Yii::t('BlogModule.blog', 'Category')
>>>>>>> 882a53f9cfa014a21be8fc828efa50a76758b123
        );
    }

    /**
     * @return array customized attribute descriptions (name=>description)
     */
    public function attributeDescriptions()
    {
        return array(
<<<<<<< HEAD
            'id' => Yii::t('BlogModule.blog', 'Post id.'),
            'blog_id' => Yii::t('BlogModule.blog', 'Choose a blog you want to add the record to'),
            'slug' => Yii::t('BlogModule.blog', 'URL-friendly name of the blog.<br /><br /> For example: <br /><br /><pre>http://site.ru/blogs/my/<br /><span class="label">my-na-more</span>/</pre> It you don\'t know what is it you can leave this field empty.'),
            'publish_date' => Yii::t('BlogModule.blog', 'Publish date'),
            'publish_date_tmp' => Yii::t('BlogModule.blog', 'Publish date, formatted as:<br /><span class="label">05-09-2012</span>'),
            'publish_time_tmp' => Yii::t('BlogModule.blog', 'Publish time, formatted as:<br /><span class="label">12:00</span>'),
            'title' => Yii::t('BlogModule.blog', 'Post title, for example:<br /><span class="label">Our seaside vacation.</span>'),
            'quote' => Yii::t('BlogModule.blog', 'Please enter announcement text. A couple of sentences is enough. The text will be used, for example, at the main page or in the posts list.'),
            'content' => Yii::t('BlogModule.blog', 'Full text of the post which is displayed when you click on &laquo;More&raquo; link'),
            'link' => Yii::t('BlogModule.blog', 'Source link of the post. Source website or an article which you have used to write the post.'),
            'status' => Yii::t('BlogModule.blog', 'Post status:<br /><br /><span class="label label-success">published</span> &ndash;Visible for everyone.<br /><br /><span class="label label-warning">draft</span> &ndash; Visible for admins.<br /><br /><span class="label label-info">scheduled</span> &ndash; Will be published at a publish date.'),
            'comment_status' => Yii::t('BlogModule.blog', 'If checked &ndash; Users are able to leave comments on the post'),
            'access_type' => Yii::t('BlogModule.blog', 'Post access<br /><br /><span class="label label-success">public</span> &ndash; Everyone can read this post<br /><br /><span class="label label-warning">private</span> &ndash; only you can read this post'),
            'keywords' => Yii::t('BlogModule.blog', 'SEO keywords separated by comma. For example, if your post is about your seaside vacation keyword would be: <pre>sea, travel, sun, etc.</pre>'),
            'description' => Yii::t('BlogModule.blog', 'Short post description. Should not be more than one or two sentences. Should reflect the main points of the post. For example: <pre>The story of how we were almost eaten by sharks.</pre>This text is often used in search engine <a href="http://help.yandex.ru/webmaster/?id=111131">snippet</a>.'),
            'tags' => Yii::t('BlogModule.blog', 'Keywords for post categorization, for example:<br /><span class="label">sea</span>'),
=======
            'id'               => Yii::t('BlogModule.blog', 'Post id.'),
            'blog_id'          => Yii::t('BlogModule.blog', 'Choose a blog you want to add the record to'),
            'slug'             => Yii::t('BlogModule.blog', 'URL-friendly name of the blog.<br /><br /> For example: <br /><br /><pre>http://site.ru/blogs/my/<br /><span class="label">my-na-more</span>/</pre> It you don\'t know what is it you can leave this field empty.'),
            'publish_date'     => Yii::t('BlogModule.blog', 'Publish date'),
            'title'            => Yii::t('BlogModule.blog', 'Post title, for example:<br /><span class="label">Our seaside vacation.</span>'),
            'quote'            => Yii::t('BlogModule.blog', 'Please enter announcement text. A couple of sentences is enough. The text will be used, for example, at the main page or in the posts list.'),
            'content'          => Yii::t('BlogModule.blog', 'Full text of the post which is displayed when you click on &laquo;More&raquo; link'),
            'link'             => Yii::t('BlogModule.blog', 'Source link of the post. Source website or an article which you have used to write the post.'),
            'status'           => Yii::t('BlogModule.blog', 'Post status:<br /><br /><span class="label label-success">published</span> &ndash;Visible for everyone.<br /><br /><span class="label label-warning">draft</span> &ndash; Visible for admins.<br /><br /><span class="label label-info">scheduled</span> &ndash; Will be published at a publish date.'),
            'comment_status'   => Yii::t('BlogModule.blog', 'If checked &ndash; Users are able to leave comments on the post'),
            'access_type'      => Yii::t('BlogModule.blog', 'Post access<br /><br /><span class="label label-success">public</span> &ndash; Everyone can read this post<br /><br /><span class="label label-warning">private</span> &ndash; only you can read this post'),
            'keywords'         => Yii::t('BlogModule.blog', 'SEO keywords separated by comma. For example, if your post is about your seaside vacation keyword would be: <pre>sea, travel, sun, etc.</pre>'),
            'description'      => Yii::t('BlogModule.blog', 'Short post description. Should not be more than one or two sentences. Should reflect the main points of the post. For example: <pre>The story of how we were almost eaten by sharks.</pre>This text is often used in search engine <a href="http://help.yandex.ru/webmaster/?id=111131">snippet</a>.'),
            'tags'             => Yii::t('BlogModule.blog', 'Keywords for post categorization, for example:<br /><span class="label">sea</span>'),
>>>>>>> 882a53f9cfa014a21be8fc828efa50a76758b123
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('t.id', $this->id, true);
        $criteria->compare('blog_id', $this->blog_id);
<<<<<<< HEAD
        $criteria->compare('progress', $this->progress);
=======
>>>>>>> 882a53f9cfa014a21be8fc828efa50a76758b123
        $criteria->compare('t.create_user_id', $this->create_user_id, true);
        $criteria->compare('t.update_user_id', $this->update_user_id, true);
        $criteria->compare('t.create_date', $this->create_date);
        $criteria->compare('t.update_date', $this->update_date);
<<<<<<< HEAD
        $criteria->compare('slug', $this->slug, true);
=======
        $criteria->compare('t.slug', $this->slug, true);
>>>>>>> 882a53f9cfa014a21be8fc828efa50a76758b123
        $criteria->compare('publish_date', $this->publish_date, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('quote', $this->quote, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('link', $this->link, true);
        $criteria->compare('t.status', $this->status);
        $criteria->compare('comment_status', $this->comment_status);
        $criteria->compare('access_type', $this->access_type);
        $criteria->compare('t.category_id', $this->category_id, true);

<<<<<<< HEAD
        $criteria->order = 'publish_date DESC';
        $criteria->with = array('createUser', 'updateUser', 'blog');

        return new CActiveDataProvider('Post', array('criteria' => $criteria));
=======
        $criteria->with  = array('createUser', 'updateUser', 'blog');

        return new CActiveDataProvider('Post', array(
            'criteria' => $criteria,
            'sort'=>array(
                'defaultOrder'=>'publish_date ASC',
            )
        ));
>>>>>>> 882a53f9cfa014a21be8fc828efa50a76758b123
    }

    public function allPosts()
    {
        $criteria = new CDbCriteria;
        $criteria->addCondition('t.status = :status');
        $criteria->addCondition('t.access_type = :access_type');
        $criteria->params = array(
<<<<<<< HEAD
            ':status' => self::STATUS_PUBLISHED,
            ':access_type' => self::ACCESS_PUBLIC
        );
        $criteria->with = array('blog', 'createUser');
=======
            ':status'      => self::STATUS_PUBLISHED,
            ':access_type' => self::ACCESS_PUBLIC
        );
        $criteria->with  = array('blog', 'createUser','commentsCount');
>>>>>>> 882a53f9cfa014a21be8fc828efa50a76758b123
        $criteria->order = 'publish_date DESC';

        return new CActiveDataProvider(
            'Post', array('criteria' => $criteria)
        );
    }

    public function behaviors()
    {
        $module = Yii::app()->getModule('blog');
        return array(
            'CTimestampBehavior' => array(
<<<<<<< HEAD
                'class' => 'zii.behaviors.CTimestampBehavior',
                'setUpdateOnCreate' => true,
                'createAttribute' => 'create_date',
                'updateAttribute' => 'update_date',
            ),
            'tags' => array(
                'class' => 'application.modules.yupe.extensions.taggable.EARTaggableBehavior',
                'tagTable' => Yii::app()->db->tablePrefix . 'blog_tag',
                'tagBindingTable' => Yii::app()->db->tablePrefix . 'blog_post_to_tag',
                'tagModel' => 'Tag',
                'modelTableFk' => 'post_id',
                'tagBindingTableTagId' => 'tag_id',
                'cacheID' => 'cache',
            ),
            'imageUpload' => array(
                'class' => 'application.modules.yupe.components.behaviors.ImageUploadBehavior',
                'scenarios' => array('insert', 'update'),
                'attributeName' => 'image',
                'minSize' => $module->minSize,
                'maxSize' => $module->maxSize,
                'types' => $module->allowedExtensions,
                'uploadPath' => $module->getUploadPath(),
=======
                'class'             => 'zii.behaviors.CTimestampBehavior',
                'setUpdateOnCreate' => true,
                'createAttribute'   => 'create_date',
                'updateAttribute'   => 'update_date',
            ),
            'tags' => array(
                'class'                => 'application.modules.yupe.extensions.taggable.EARTaggableBehavior',
                'tagTable'             => Yii::app()->db->tablePrefix . 'blog_tag',
                'tagBindingTable'      => Yii::app()->db->tablePrefix . 'blog_post_to_tag',
                'tagModel'             => 'Tag',
                'modelTableFk'         => 'post_id',
                'tagBindingTableTagId' => 'tag_id',
                'cacheID'              => 'cache',
            ),
            'imageUpload' => array(
                'class'             =>'yupe\components\behaviors\ImageUploadBehavior',
                'scenarios'         => array('insert','update'),
                'attributeName'     => 'image',
                'minSize'           => $module->minSize,
                'maxSize'           => $module->maxSize,
                'types'             => $module->allowedExtensions,
                'uploadPath'        => $module->getUploadPath(),
>>>>>>> 882a53f9cfa014a21be8fc828efa50a76758b123
                'imageNameCallback' => array($this, 'generateFileName'),
            ),
        );
    }

    public function generateFileName()
    {
        return md5($this->slug . microtime(true) . rand());
    }

    public function getImageUrl()
    {
<<<<<<< HEAD
        if ($this->image) {
            return Yii::app()->baseUrl . '/' . Yii::app()->getModule('yupe')->uploadPath . '/' .
            Yii::app()->getModule('blog')->uploadPath . '/' . $this->image;
=======
        if($this->image) {
            return Yii::app()->baseUrl . '/' . Yii::app()->getModule('yupe')->uploadPath . '/' .
                Yii::app()->getModule('blog')->uploadPath . '/' . $this->image;
>>>>>>> 882a53f9cfa014a21be8fc828efa50a76758b123
        }

        return false;
    }

    public function beforeSave()
    {
<<<<<<< HEAD
        $this->publish_date = strtotime($this->publish_date_tmp . ' ' . $this->publish_time_tmp);
=======
        $this->publish_date = strtotime($this->publish_date);

>>>>>>> 882a53f9cfa014a21be8fc828efa50a76758b123
        $this->update_user_id = Yii::app()->user->getId();

        if ($this->isNewRecord) {
            $this->create_user_id = $this->update_user_id;
            $this->create_user_ip = Yii::app()->getRequest()->userHostAddress;
        }

        return parent::beforeSave();
    }

    public function afterDelete()
    {
        Comment::model()->deleteAll(
            'model = :model AND model_id = :model_id', array(
                ':model' => 'Post',
                ':model_id' => $this->id
            )
        );

        return parent::afterDelete();
    }

    public function beforeValidate()
    {
        if (!$this->slug) {
<<<<<<< HEAD
            $this->slug = YText::translit($this->title);
=======
            $this->slug = yupe\helpers\YText::translit($this->title);
>>>>>>> 882a53f9cfa014a21be8fc828efa50a76758b123
        }

        return parent::beforeValidate();
    }

    public function getStatusList()
    {
        return array(
<<<<<<< HEAD
            self::STATUS_DRAFT => Yii::t('BlogModule.blog', 'Draft'),
            self::STATUS_PUBLISHED => Yii::t('BlogModule.blog', 'Published'),
            self::STATUS_SHEDULED => Yii::t('BlogModule.blog', 'Scheduled'),
=======
            self::STATUS_DRAFT     => Yii::t('BlogModule.blog', 'Draft'),
            self::STATUS_PUBLISHED => Yii::t('BlogModule.blog', 'Published'),
            self::STATUS_SHEDULED  => Yii::t('BlogModule.blog', 'Scheduled'),
>>>>>>> 882a53f9cfa014a21be8fc828efa50a76758b123
        );
    }

    public function getStatus()
    {
        $data = $this->getStatusList();
        return isset($data[$this->status]) ? $data[$this->status] : Yii::t('BlogModule.blog', '*unknown*');
    }

    public function getAccessTypeList()
    {
        return array(
            self::ACCESS_PRIVATE => Yii::t('BlogModule.blog', 'Private'),
<<<<<<< HEAD
            self::ACCESS_PUBLIC => Yii::t('BlogModule.blog', 'Public'),
=======
            self::ACCESS_PUBLIC  => Yii::t('BlogModule.blog', 'Public'),
>>>>>>> 882a53f9cfa014a21be8fc828efa50a76758b123
        );
    }

    public function getAccessType()
    {
        $data = $this->getAccessTypeList();
        return isset($data[$this->access_type]) ? $data[$this->access_type] : Yii::t('BlogModule.blog', '*unknown*');
    }

    public function getCommentStatus()
    {
        $data = $this->getCommentStatusList();
        return isset($data[$this->comment_status]) ? $data[$this->comment_status] : Yii::t('BlogModule.blog', '*unknown*');
    }

    public function getCommentStatusList()
    {
        return array(
            self::ACCESS_PRIVATE => Yii::t('BlogModule.blog', 'Forbidden'),
<<<<<<< HEAD
            self::ACCESS_PUBLIC => Yii::t('BlogModule.blog', 'Allowed'),
=======
            self::ACCESS_PUBLIC  => Yii::t('BlogModule.blog', 'Allowed'),
>>>>>>> 882a53f9cfa014a21be8fc828efa50a76758b123
        );
    }

    /**
     * after find event:
     *
     * @return parent::afterFind()
     **/
    public function afterFind()
    {
<<<<<<< HEAD
        $this->publish_date_tmp = date('d-m-Y', $this->publish_date);
        $this->publish_time_tmp = date('H:i', $this->publish_date);
=======
        $this->publish_date = date('d-m-Y H:i', $this->publish_date);
>>>>>>> 882a53f9cfa014a21be8fc828efa50a76758b123

        return parent::afterFind();
    }

    public function getQuote($limit = 500)
    {
        return $this->quote
<<<<<<< HEAD
            ? : YText::characterLimiter(
                $this->content, (int)$limit
            );
    }

    public function getArchive($blogId = null)
    {
        $criteria = new CDbCriteria();

        if ($blogId) {
            $criteria->condition = 'blog_id = :blog_id';
            $criteria->params = array(
                ':blog_id' => (int)$blogId
            );
        }

        $models = $this->public()->published()->recent()->findAll($criteria);

        $data = array();

        foreach ($models as $model) {
            list($year, $month) = split('-', date('Y-m', $model->publish_date));
            $data[$year][$month][] = $model;
=======
            ?: yupe\helpers\YText::characterLimiter(
                $this->content, (int) $limit
            );
    }

    public function getArchive($blogId = null, $cache = 3600)
    {
        $criteria = new CDbCriteria();

        if($blogId) {
            $criteria->condition = 'blog_id = :blog_id';
            $criteria->params = array(
                ':blog_id' =>  (int)$blogId
            );
        }

        $models = $this->cache((int)$cache)->public()->published()->recent()->findAll($criteria);

        $data = array();

        foreach($models as $model) {            
            list($day, $month, $year) = explode('-', $model->publish_date);
            $data[$year][$month][] = $model;            
>>>>>>> 882a53f9cfa014a21be8fc828efa50a76758b123
        }

        return $data;
    }

    public function getStream($limit = 10, $cacheTime)
    {
        $data = Yii::app()->cache->get('Blog::Post::Stream');

<<<<<<< HEAD
        if (false === $data) {
            $data = Yii::app()->db->createCommand()
                ->select('p.title, p.slug, max(c.creation_date) comment_date, count(c.id) commentsCount')
                ->from('{{comment_comment}} c')
                ->join('{{blog_post}} p', 'c.model_id = p.id')
                ->where('c.model = :model AND p.status = :status AND c.status = :commentstatus', array(
                    ':model' => 'Post',
                    ':status' => Post::STATUS_PUBLISHED,
                    ':commentstatus' => Comment::STATUS_APPROVED
                ))
                ->group('c.model, c.model_id')
                ->order('comment_date DESC')
                ->having('commentsCount > 1')
                ->limit((int)$limit)
                ->queryAll();

            Yii::app()->cache->set('Blog::Post::Stream', $data, $cacheTime);
=======
        if(false === $data) {
            $data = Yii::app()->db->createCommand()
            ->select('p.title, p.slug, max(c.creation_date) comment_date, count(c.id) as commentsCount')
            ->from('{{comment_comment}} c')
            ->join('{{blog_post}} p', 'c.model_id = p.id')
               ->where('c.model = :model AND p.status = :status AND c.status = :commentstatus', array(
                        ':model'  => 'Post',
                        ':status' => Post::STATUS_PUBLISHED,
                        ':commentstatus' => Comment::STATUS_APPROVED
                 ))
                ->group('c.model, c.model_id, p.title, p.slug')
                ->order('comment_date DESC')
            ->having('count(c.id) > 1')
            ->limit((int)$limit)          
            ->queryAll();

            Yii::app()->cache->set('Blog::Post::Stream', $data, $cacheTime);     
>>>>>>> 882a53f9cfa014a21be8fc828efa50a76758b123
        }

        return $data;
    }

    public function get($id, array $with = array())
    {
<<<<<<< HEAD
        if (is_int($id)) {
=======
        if(is_int($id)) {            
>>>>>>> 882a53f9cfa014a21be8fc828efa50a76758b123
            return Post::model()->public()->published()->with($with)->findByPk($id);
        }

        return Post::model()->public()->published()->with($with)->find(
            't.slug = :slug', array(
                ':slug' => $id
            )
        );
    }

<<<<<<< HEAD
    public function getByTag($tag)
    {
        return Post::model()->with('blog', 'createUser')
            ->published()
            ->public()
            ->sortByPubDate('DESC')
            ->taggedWith($tag)->findAll();
    }

    /**
     * Метод вибирає остані записи користувача
     * і повертає там результат чи можна створювати новий план
     */
    public function canUserCreatePlan($userId)
    {
        if ($userId) {
            $res = Yii::app()->db->createCommand()
                ->select('create_date, create_user_id')
                ->from('{{blog_post}}')
                ->where('FROM_UNIXTIME(create_date) >= CURRENT_DATE')
                ->andWhere('create_user_id = :id', array(':id' => $userId))
                ->queryRow();

            return ($res) ? false : true;
        }

        return false;
    }

    public function getByMonth($month = false, $year = false)
    {
        if ($month && $year) {
            $res = Yii::app()->db->createCommand()
                ->select('*')
                ->from('{{blog_post}}')
                ->where('year(FROM_UNIXTIME(create_date)) = :year and month(FROM_UNIXTIME(create_date)) = :month',
                    array(':year' => $year, ':month' => $month))
                ->order('progress ASC')
                ->setFetchMode(PDO::FETCH_OBJ)
                ->queryAll();
            return $res;
        }
        return false;
=======
    public function getByTag($tag, array $with = array('blog','createUser', 'commentsCount'))
    {
        return Post::model()->with($with)
         ->published()
         ->public()
         ->sortByPubDate('DESC')
         ->taggedWith($tag)->findAll(); 
    }

    public function getForBlog($blogId)
    {
        $posts = new Post('search');
        $posts->unsetAttributes();
        $posts->blog_id = (int)$blogId;
        $posts->status  = Post::STATUS_PUBLISHED;
        $posts->access_type = Post::ACCESS_PUBLIC;
        return $posts;
    }

    public function getForCategory($categoryId)
    {
        $posts = new Post('search');
        $posts->unsetAttributes();
        $posts->category_id = (int)$categoryId;
        $posts->status  = Post::STATUS_PUBLISHED;
        $posts->access_type = Post::ACCESS_PUBLIC;
        return $posts;
    }

    public function getCategorys()
    {
        return Yii::app()->db->createCommand()
        ->select('cc.name, bp.category_id, count(bp.id) cnt, cc.alias, cc.description')
            ->from('yupe_blog_post bp')
            ->join('yupe_category_category cc','bp.category_id = cc.id')
        ->where('bp.category_id IS NOT NULL')
            ->group('bp.category_id')
            ->having('cnt > 0')
            ->order('cnt DESC')
        ->queryAll();
    }

    public function getCommentCount()
    {
        return $this->commentsCount > 0 ? $this->commentsCount - 1 : 0;
>>>>>>> 882a53f9cfa014a21be8fc828efa50a76758b123
    }
}
