<?php

namespace common\models;

use admin\components\HyperlinkElements;
use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property integer $post_id
 * @property string $content
 * @property string $author
 * @property string $email
 * @property string $created_at
 * @property integer $enabled
 *
 * @property Post $post
 * @property CommentTree[] $commentTrees
 * @property CommentTree[] $commentTrees0
 * @property Comment[] $descendants
 * @property Comment[] $ancestors
 */
class Comment extends \yii\db\ActiveRecord
{
    const NOT_PUBLISHED = 0;
    const PUBLISHED = 1;
    const SUBJECT_NAME = 'comment';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'content', 'author', 'email', 'created_at'], 'required'],
            [['post_id', 'enabled'], 'integer'],
            [['content'], 'string'],
            [['created_at'], 'safe'],
            [['author', 'email'], 'string', 'max' => 45],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'post_id' => Yii::t('app', 'Post ID'),
            'content' => Yii::t('app', 'Content'),
            'author' => Yii::t('app', 'Author'),
            'email' => Yii::t('app', 'Email'),
            'created_at' => Yii::t('app', 'Created At'),
            'enabled' => Yii::t('app', 'Enabled'),
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

    public function isPublished(): bool
    {
        if ($this->enabled === self::PUBLISHED) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommentTrees()
    {
        return $this->hasMany(CommentTree::className(), ['ancestor' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommentTrees0()
    {
        return $this->hasMany(CommentTree::className(), ['descendant' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDescendants()
    {
        return $this->hasMany(Comment::className(), ['id' => 'descendant'])->viaTable('comment_tree', ['ancestor' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAncestors()
    {
        return $this->hasMany(Comment::className(), ['id' => 'ancestor'])->viaTable('comment_tree', ['descendant' => 'id']);
    }

    /**
     * @inheritdoc
     * @return CommentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CommentQuery(get_called_class());
    }
}
