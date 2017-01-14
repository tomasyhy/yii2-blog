<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comment_tree".
 *
 * @property integer $ancestor
 * @property integer $descendant
 *
 * @property Comment $ancestor0
 * @property Comment $descendant0
 */
class CommentTree extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment_tree';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ancestor', 'descendant'], 'required'],
            [['ancestor', 'descendant'], 'integer'],
            [['ancestor'], 'exist', 'skipOnError' => true, 'targetClass' => Comment::className(), 'targetAttribute' => ['ancestor' => 'id']],
            [['descendant'], 'exist', 'skipOnError' => true, 'targetClass' => Comment::className(), 'targetAttribute' => ['descendant' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ancestor' => Yii::t('app', 'Ancestor'),
            'descendant' => Yii::t('app', 'Descendant'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAncestor0()
    {
        return $this->hasOne(Comment::className(), ['id' => 'ancestor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDescendant0()
    {
        return $this->hasOne(Comment::className(), ['id' => 'descendant']);
    }

    /**
     * @inheritdoc
     * @return CommentTreeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CommentTreeQuery(get_called_class());
    }
}
