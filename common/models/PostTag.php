<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "post_tag".
 *
 * @property integer $post_id
 * @property integer $tag_id
 *
 * @property Post $post
 * @property Tag $tag
 */
class PostTag extends \yii\db\ActiveRecord
{
    public $tags;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'tag_id'], 'required'],
            [['post_id', 'tag_id'], 'integer'],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['tag_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'post_id' => Yii::t('app', 'Post ID'),
            'tag_id' => Yii::t('app', 'Tag ID'),
        ];
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
    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tag_id']);
    }

    /**
     * @inheritdoc
     * @return PostTagQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PostTagQuery(get_called_class());
    }

    public function updateTags(int $postId) {
        Yii::$app
            ->db
            ->createCommand()
            ->delete('post_tag', ['post_id' => $postId])
            ->execute();

        return $this->save();
    }
}
