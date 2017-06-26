<?php

namespace common\models;

use yii\helpers\ArrayHelper;
use admin\components\HyperlinkElements;
use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $created_at
 * @property integer $status
 *
 * @property Comment[] $comments
 * @property PostTag[] $postTags
 * @property Tag[] $tags
 */
class Post extends \yii\db\ActiveRecord
{
    const NOT_PUBLISHED = 0;
    const PUBLISHED = 1;
    const SUBJECT_NAME = 'post';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['content'], 'string'],
            [['status'], 'integer'],
            [['title'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'content' => Yii::t('app', 'Content'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /** @inheritdoc */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @return HyperlinkElements
     * @throws \yii\base\InvalidConfigException
     */
    protected function getHyperlinkElements()
    {
        return Yii::$container->get(HyperlinkElements::className());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostTags()
    {
        return $this->hasMany(PostTag::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])->viaTable('post_tag', ['post_id' => 'id']);
    }

    /**
     * @return array
     */
    public function getTagsId(): array {
        return array_map(function($tag) {
            return $tag->id;
        }, $this->tags);
    }

    /**
     * @return array
     */
    public function getTagsName(): array {
        return array_map(function($tag) {
            return $tag->name;
        }, $this->tags);
    }

    /**
     * @inheritdoc
     * @return PostQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PostQuery(get_called_class());
    }

    /**
     * @return bool
     */
    public function isPublished(): bool
    {
        if ($this->status === self::PUBLISHED) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return array
     */
    public function getStatusesDropDownList(): array
    {
        return [self::PUBLISHED => 'Published', self::NOT_PUBLISHED => 'Not published'];
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getRootPostComments() {
        return $this->getComments()->select(['id', 'content', 'author', 'email', 'created_at', 'count' => 'count(*)'])->joinWith('commentTreesByDescendant', false, 'INNER JOIN')->where(['enabled' => Comment::PUBLISHED])->groupBy('comment.id')->having('count = 1')->all();
    }


}
