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
<div class="tag-index">


    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="fa fa-list-ul font-dark"></i>
                        <span class="caption-subject bold uppercase"><?= Yii::t('app', 'Tags list'); ?></span>
                    </div>

                    <div class="actions">
                        <a href="<?= Url::to(['create']); ?>" class="btn blue btn-sm show-modal" data-action="backup"><i
                                    class="fa fa-plus"></i><?= Yii::t('app', 'Create') ?></a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="todo-project-list">
                        <div class="table-responsive">

                            <?php Pjax::begin(
                                ['enablePushState' => false, 'id' => 'tag-grid-pjax']
                            ); ?>    <?= GridView::widget([
                                'dataProvider' => $dataProvider,

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
                                                return Html::a('<span class="fa fa-edit"></span>', $url, [
                                                    'title' => Yii::t('app', 'Details'),
                                                    'class' => 'btn btn-icon-only purple',
                                                    'data-pjax' => '0',
                                                ]);
                                            },
                                            'delete' => function ($url, $tag) {
                                                return Html::a('<span class="fa fa-trash-o"></span>', $url, [
                                                    'title' => Yii::t('yii', 'Delete'),
                                                    'class' => 'btn btn-icon-only red hidden-xs hidden-sm ajax-action',
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
                    </div>
                </div>
            </div>
        </div>
    </div>
