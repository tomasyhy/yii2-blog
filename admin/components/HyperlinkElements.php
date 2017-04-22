<?php

namespace admin\components;

use common\models\Post;
use yii\base\Component;
use Yii;
use yii\db\ActiveRecord;

/**
 * Generates confirmations messages for acton models
 */
class HyperlinkElements extends Component
{
    public function getChangeStatusConfirmation(ActiveRecord $model): string
    {
        if ($model->isPublished()) {
            $text = 'Are you sure you don\'t want to publish {0}?';
        } else {
            $text = 'Are you sure you want to publish {0}?';
        }
        return Yii::t('app', $text, [$model::SUBJECT_NAME]);
    }

    public function getStatusIcon(ActiveRecord $model): string
    {
        if ($model->isPublished()) {
            return 'icon-check';
        } else {
            return 'icon-ban';
        }
    }

    public function getStatusTitle(ActiveRecord $model): string
    {
        if ($model->isPublished()) {
            $text = 'Published';
        } else {
            $text = 'Not published';
        }
        return Yii::t('app', $text);
    }

    public function getStatusColor(ActiveRecord $model): string
    {
        if ($model->isPublished()) {
            return 'green';
        } else {
            return 'dark';
        }
    }

    public function getDeleteConfirmation(ActiveRecord $model): string
    {
        return Yii::t('app', 'Are you sure you want to delete {0}?', [$model::SUBJECT_NAME]);
    }

}