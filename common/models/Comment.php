<?php

namespace common\models;

use admin\components\HyperlinkElements;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
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
    const FIRST_LEVEL_DESCENDANT = 1;

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
            [['post_id', 'content', 'author', 'email'], 'required'],
            [['post_id', 'enabled'], 'integer'],
            [['content'], 'string'],
            [['created_at'], 'safe'],
            ['email', 'email'],
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

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => false,
                'value' => new Expression('NOW()'),
            ]
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
     * @return bool
     */
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
    public function getCommentTreesByAncestor()
    {
        return $this->hasMany(CommentTree::className(), ['ancestor' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommentTreesByDescendant()
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
     * @return array|Comment[]
     */
    public function getFirstLevelDescendants()
    {
        return $this->find()->select('*')->joinWith('commentTreesByDescendant')->where(['comment_tree.ancestor' => $this->id, 'comment_tree.depth' => Comment::FIRST_LEVEL_DESCENDANT, 'enabled' => Comment::PUBLISHED])->all();

    }

    /**
     * @inheritdoc
     * @return CommentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CommentQuery(get_called_class());
    }

    /**
     * @param CommentTree $commentTree
     * @return bool
     */
    public function saveCommentWithTree(CommentTree $commentTree): bool
    {
        $transaction = Yii::$app->getDb()->beginTransaction();
        try {
            $this->enabled = Comment::PUBLISHED;
            if (!$this->save()) {
                return false;
            }

            if (!$commentTree->saveTree($this->id)) {
                return false;
            }

            $transaction->commit();
            return true;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            Yii::error($e->getMessage());
            return false;
        }

    }

}
