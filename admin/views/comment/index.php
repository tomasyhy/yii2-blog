<?php

use yii\helpers\{
    Url, StringHelper, Html
};
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Comments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="fa fa-list-ul font-dark"></i>
                        <span class="caption-subject bold uppercase"><?= Yii::t('app', 'Comments list'); ?></span>
                    </div>

                    <div class="actions">
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="todo-project-list">
                        <div class="table-responsive">
                            <?php Pjax::begin(
                                ['enablePushState' => false, 'id' => 'comment-grid-pjax']
                            ); ?>    <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                'id' => 'comment-grid',
                                'tableOptions' => [
                                    'class' => 'table table-hover',
                                ],
                                'layout' => "\n{items}\n{summary}\n{pager}",
                                'columns' => [
                                    [
                                        'header' => Yii::t('app', 'Post'),
                                        'attribute' => 'post_id',
                                        'contentOptions' => [
                                            'class' => 'col-md-1'
                                        ],
                                        'format' => 'raw',
                                        'content' => function ($comment) {
                                            return Html::a($comment->post->title,['/post/update', 'id' => $comment->post_id]);
                                        },
                                    ],
                                    [
                                        'attribute' => 'content',
                                        'contentOptions' => [
                                            'class' => 'col-md-6'
                                        ],
                                        'content' => function ($comment) {
                                            return StringHelper::truncateWords(strip_tags($comment->content), 10);
                                        },
                                    ],
                                    [
                                        'attribute' => 'author',
                                        'contentOptions' => [
                                            'class' => 'col-md-1'
                                        ],
                                    ],
                                    [
                                        'attribute' => 'email',
                                        'contentOptions' => [
                                            'class' => 'col-md-1'
                                        ],
                                    ],
                                    [
                                        'attribute' => 'created_at',
                                        'contentOptions' => [
                                            'class' => 'col-md-1'
                                        ],
                                    ],
                                    ['class' => 'yii\grid\ActionColumn',
                                        'visible' => true, 'template' => '{change-status}{view}{delete}',
                                        'buttons' => [
                                            'change-status' => function ($url, $comment) {
                                                return Html::a('<span class="' . $comment->hyperlinkElements->getStatusIcon($comment) . '"></span>', $url, [
                                                    'title' => $comment->hyperlinkElements->getStatusTitle($comment),
                                                    'class' => 'btn btn-icon-only hidden-xs hidden-sm ajax-action ' . $comment->hyperlinkElements->getStatusColor($comment),
                                                    'data-element' => 'comment-grid',
                                                    'data-confirmation' => $comment->hyperlinkElements->getChangeStatusConfirmation($comment)
                                                ]);
                                            },
                                            'view' => function ($url) {
                                                return Html::a('<span class="fa fa-search"></span>', $url, [
                                                    'title' => Yii::t('app', 'Details'),
                                                    'class' => 'btn btn-icon-only purple',
                                                    'data-pjax' => '0',
                                                ]);
                                            },
                                            'delete' => function ($url, $comment) {
                                                return Html::a('<span class="fa fa-trash-o"></span>', $url, [
                                                    'title' => Yii::t('yii', 'Delete'),
                                                    'class' => 'btn btn-icon-only red hidden-xs hidden-sm ajax-action',
                                                    'data-element' => 'comment-grid',
                                                    'data-confirmation' => $comment->hyperlinkElements->getDeleteConfirmation($comment)
                                                ]);
                                            },
                                        ],
                                        'contentOptions' => [
                                            'class' => 'text-right actions col-md-1'
                                        ]
                                    ],
                                ],
                            ]); ?>
                            <?php Pjax::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
