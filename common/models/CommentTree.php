<?php

namespace common\models;

use yii\db\Expression;
use Yii;

/**
 * This is the model class for table "comment_tree".
 *
 * @property integer $ancestor
 * @property integer $descendant
 * @property integer $depth
 *
 * @property Comment $ancestor0
 * @property Comment $descendant0
 */
class CommentTree extends \yii\db\ActiveRecord
{
    /**
     * Depth to element in tree comment which is ancestor and descendant simultaneously
     */
    const DISTANCE_TO_SELF_NODE = 0;

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
            [['ancestor', 'descendant', 'depth'], 'required'],
            [['ancestor', 'descendant', 'depth'], 'integer'],
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
    public function getAncestor()
    {
        return $this->hasOne(Comment::className(), ['id' => 'ancestor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDescendant()
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

    /**
     * @param int $commentId
     * @return bool
     */
    public function saveTree(int $commentId): bool
    {
        try {
            if ($this->commentHasAncestors()) {
                $this->saveNodes($commentId);
            } else {
                $this->saveSelfNode($commentId);
            }

            return true;
        } catch (\Throwable $e) {
            Yii::error($e->getMessage());
            return false;
        }

    }

    /**
     * @return bool
     */
    private function commentHasAncestors(): bool
    {
        return !empty($this->ancestor);
    }

    /**
     * @param int $commentId
     * @return bool
     */
    private function saveNodes(int $commentId): bool {
        $selfTreeElement = sprintf('SELECT %1$d, %1$d, %2$d', $commentId, self::DISTANCE_TO_SELF_NODE);
        $newCommentAncestors = self::find()->select(['ancestor', 'descendant' => new Expression($commentId), 'depth' => new Expression('depth + 1')])->where(['descendant' => $this->ancestor])->union($selfTreeElement)->asArray()->all();

        foreach ($newCommentAncestors as $newCommentAncestor) {
            $commentTree = new self();
            $commentTree->setAttributes($newCommentAncestor, false);
            if(!$commentTree->save()) return false;
        }

        return true;
    }

    /**
     * @param $commentId
     * @return bool
     */
    private function saveSelfNode($commentId): bool {
        $commentTree = new self();
        $commentTree->ancestor = $commentId;
        $commentTree->descendant = $commentId;
        $commentTree->depth = self::DISTANCE_TO_SELF_NODE;
        return $commentTree->save();
    }
}
