<?php

use yii\helpers\{Html, StringHelper};
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Comment */

$this->title = StringHelper::truncateWords(strip_tags($model->content), 3);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-search font-dark"></i>
                    <span class="caption-subject font-dark bold uppercase"><?= Html::encode($this->title) ?></span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="comment-view">

                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            [
                                'label' => Yii::t('app', 'Post'),
                                'format' => 'raw',
                                'value' => function ($comment) {
                                    return Html::a($comment->post->title,['/post/update', 'id' => $comment->post_id]);
                                },
                            ],
                            'content:ntext',
                            'author',
                            'email:email',
                            'created_at',
                            [
                                'label' => Yii::t('app', 'Is Published'),
                                'value' => $model->isPublished() ? Yii::t('app', 'Yes') : Yii::t('app', 'No'),
                            ],
                        ],
                    ]) ?>
                    <?= Html::a('Back', ['index'], ['class'=>'btn btn-default']) ?>
                </div>
            </div>

        </div>
    </div>
</div>

