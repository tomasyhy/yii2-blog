<?php
use yii\helpers\{
    Url, StringHelper, Html
};
use yii\grid\GridView;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= Html::encode($this->title) ?>
    <div class="pull-right">
        <a href="<?= Url::to(['create']); ?>"
           class="btn btn-success show-modal"><?= Yii::t('app', 'Create') ?></a>

    </div>
</h2>
<hr>
    <div class="panel-body">



            <?php Pjax::begin(['enablePushState' => false, 'id' => 'post-grid-pjax']); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'id' => 'post-grid',
                'tableOptions' => [
                    'class' => 'table table-hover',
                ],
                'layout' => "\n{items}\n{summary}\n{pager}",
                'columns' => [
                    [
                        'attribute' => 'title',
                        'contentOptions' => [
                            'class' => 'col-md-2'
                        ]
                    ],
                    [
                        'attribute' => 'content',
                        'contentOptions' => [
                            'class' => 'col-md-6'
                        ],
                        'content' => function ($post) {
                            return StringHelper::truncateWords(strip_tags($post->content), 5);
                        },

                    ],
                    [
                        'attribute' => 'created_at',
                        'contentOptions' => [
                            'class' => 'col-md-2'
                        ],
                        'content' => function ($post) {
                            return Yii::$app->formatter->asDate($post->created_at);
                        },
                    ],
                    ['class' => 'yii\grid\ActionColumn',
                        'visible' => true, 'template' => '{change-status}{update}{delete}',
                        'buttons' => [
                            'change-status' => function ($url, $post) {
                                return Html::a('<span class="' . $post->hyperlinkElements->getStatusIcon($post) . '"></span>', $url, [
                                    'title' => $post->hyperlinkElements->getStatusTitle($post),
                                    'class' => 'ajax-action',
                                    'data-element' => 'post-grid',
                                    'data-confirmation' => $post->hyperlinkElements->getChangeStatusConfirmation($post)
                                ]);
                            },
                            'update' => function ($url) {
                                return Html::a('<span class="glyphicon glyphicon-edit">', $url, [
                                    'title' => Yii::t('app', 'Details'),
                                    'data-pjax' => '0',
                                ]);
                            },
                            'delete' => function ($url, $post) {
                                return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                    'title' => Yii::t('yii', 'Delete'),
                                    'class' => 'ajax-action',
                                    'data-element' => 'post-grid',
                                    'data-confirmation' => $post->hyperlinkElements->getDeleteConfirmation($post)
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