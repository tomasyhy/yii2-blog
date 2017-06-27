<?php

namespace admin\components;

use common\models\Post;
use yii\base\Component;
use Yii;
use yii\db\ActiveRecord;

/**
 * Generates confirmations messages for action models using $model $model::SUBJECT_NAME
 */
class HyperlinkElements extends Component
{
    /**
     * @param ActiveRecord $model
     * @return string
     */
    public function getChangeStatusConfirmation(ActiveRecord $model): string
    {
        if ($model->isPublished()) {
            $text = 'Are you sure you don\'t want to publish {0}?';
        } else {
            $text = 'Are you sure you want to publish {0}?';
        }
        return Yii::t('app', $text, [$model::SUBJECT_NAME]);
    }

    /**
     * @param ActiveRecord $model
     * @return string
     */
    public function getStatusIcon(ActiveRecord $model): string
    {
        if ($model->isPublished()) {
            return 'glyphicon glyphicon-ok-circle';
        } else {
            return 'glyphicon glyphicon-remove-circle';
        }
    }

    /**
     * @param ActiveRecord $model
     * @return string
     */
    public function getStatusTitle(ActiveRecord $model): string
    {
        if ($model->isPublished()) {
            $text = 'Published';
        } else {
            $text = 'Not published';
        }
        return Yii::t('app', $text);
    }

    /**
     * @param ActiveRecord $model
     * @return string
     */
    public function getStatusColor(ActiveRecord $model): string
    {
        if ($model->isPublished()) {
            return 'green';
        } else {
            return 'dark';
        }
    }

    /**
     * @param ActiveRecord $model
     * @return string
     */
    public function getDeleteConfirmation(ActiveRecord $model): string
    {
        return Yii::t('app', 'Are you sure you want to delete {0}?', [$model::SUBJECT_NAME]);
    }

}