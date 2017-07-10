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
<h2><?= Html::encode($this->title) ?></h2>
<hr>
<div class="panel-body">
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
                    return Html::a($comment->post->title, ['/post/update', 'id' => $comment->post_id], ['data-pjax' => '0']);
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
                            'class' => 'ajax-action',
                            'data-element' => 'comment-grid',
                            'data-confirmation' => $comment->hyperlinkElements->getChangeStatusConfirmation($comment)
                        ]);
                    },
                    'view' => function ($url) {
                        return Html::a('<span class="glyphicon glyphicon-zoom-in"></span>', $url, [
                            'title' => Yii::t('app', 'Details'),
                            'data-pjax' => '0',
                        ]);
                    },
                    'delete' => function ($url, $comment) {
                        return Html::a('<span class="glyphicon glyphicon-trash"</span>', $url, [
                            'title' => Yii::t('yii', 'Delete'),
                            'class' => 'ajax-action',
                            'data-element' => 'comment-grid',
                            'data-confirmation' => $comment->hyperlinkElements->getDeleteConfirmation($comment)
                        ]);
                    },
                ],

            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

