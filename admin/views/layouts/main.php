<?php

/* @var $this \yii\web\View */
/* @var $content string */

use admin\components\FlashMessage;


use admin\assets\{
    AdminAsset
};
use kartik\dialog\Dialog;
use lo\modules\noty\Wrapper;

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;


AdminAsset::register($this);


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <link rel="icon" type="image/x-icon" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/test/favicon.ico"/>
    <title>
        <?php echo Yii::$app->name . ' - ' . $this->title; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <meta name="MobileOptimized" content="320">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <?= Wrapper::widget([
        'layerClass' => 'lo\modules\noty\layers\Toastr',
    ]); ?>

    <?= Dialog::widget(
        [
            'options' => [
                'closable' => true,
                'type' => Dialog::TYPE_DEFAULT,
                'btnOKClass' => 'btn btn-success',
                'btnCancelClass' => 'btn btn-default',
            ]
        ]
    ); ?>

    <?= $this->render('//layouts/_header'); ?>

    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-2 sidenav">
                <?= $this->render('//layouts/_side-menu'); ?>
            </div>

            <div class="col-sm-10">
                <?=
                Breadcrumbs::widget([
                    'itemTemplate' => "<li>{link}\n<i class=\"fa fa-circle\"></i></li>\n",
                    'options' => ['class' => 'page-breadcrumb breadcrumb'],
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]);
                ?>
                <?= $content ?>
            </div>
        </div>
    </div>
</div>
<?= $this->render('//layouts/_footer'); ?>

<?php $this->endBody() ?>
</html>
<?php $this->endPage() ?>
