<?php

namespace common\models;

use yii\helpers\ArrayHelper;
use admin\components\HyperlinkElements;
use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property integer $id
 * @property string $title
 *
 * @property PostTag[] $postTags
 * @property Post[] $posts
 */
class Tag extends \yii\db\ActiveRecord
{
    const SUBJECT_NAME = 'tag';

    public $quantity;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostTags()
    {
        return $this->hasMany(PostTag::className(), ['tag_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['id' => 'post_id'])->viaTable('post_tag', ['tag_id' => 'id']);
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
     * @return array
     */
    public function getAllWithQuantity(): array
    {
        return self::find()
            ->select(['COUNT(*) AS quantity', 'name'])
            ->from('tag')
            ->join('join','post_tag', 'post_tag.tag_id = tag.id')
            ->groupBy('tag.id')
            ->all();
    }

    /**
     * @return array
     */
    public function getAllTagsName() {
        return ArrayHelper::map(self::find()->all(), 'id', 'name');
    }

    /**
     * @inheritdoc
     * @return TagQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TagQuery(get_called_class());
    }
}
