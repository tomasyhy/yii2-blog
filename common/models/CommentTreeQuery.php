<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CommentTree]].
 *
 * @see CommentTree
 */
class CommentTreeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CommentTree[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CommentTree|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
