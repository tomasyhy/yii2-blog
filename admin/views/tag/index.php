<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tags');
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= Html::encode($this->title) ?>
    <div class="pull-right">
        <a href="<?= Url::to(['create']); ?>"
           class="btn btn-success"><?= Yii::t('app', 'Create') ?></a>

    </div>
</h2>
<hr>
<div class="panel-body">


    <?php Pjax::begin(
        ['enablePushState' => false, 'id' => 'tag-grid-pjax']
    ); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "\n{items}\n{summary}\n{pager}",
        'tableOptions' => [
            'class' => 'table table-hover',
        ],
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'visible' => false
            ],
            [
                'attribute' => 'name',
                'contentOptions' => [
                    'class' => 'col-md-10'
                ],
                'value' => function ($data) {
                    return '<span class="label label-sm label-info">' . $data->name . '</span>';
                },
                'format' => 'raw'
            ],
            ['class' => 'yii\grid\ActionColumn',
                'visible' => true, 'template' => '{update}{delete}',
                'buttons' => [
                    'update' => function ($url) {
                        return Html::a('<span class="glyphicon glyphicon-edit"></span>', $url, [
                            'title' => Yii::t('app', 'Details'),
                            'data-pjax' => '0',
                        ]);
                    },
                    'delete' => function ($url, $tag) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => Yii::t('yii', 'Delete'),
                            'class' => 'ajax-action',
                            'data-element' => 'tag-grid',
                            'data-confirmation' => $tag->hyperlinkElements->getDeleteConfirmation($tag)
                        ]);
                    },
                ],
                'contentOptions' => [
                    'class' => 'text-right actions col-md-2'
                ]
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

