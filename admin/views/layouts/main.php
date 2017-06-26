<?php

/* @var $this \yii\web\View */
/* @var $content string */

use admin\components\FlashMessage;


use common\assets\CommonAsset;
use admin\assets\{
    AdminAsset
};
use kartik\dialog\Dialog;
use lo\modules\noty\Wrapper;
use yii\helpers\ArrayHelper;

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;


CommonAsset::register($this);
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
<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-md">
<?php $this->beginBody() ?>

<?= Wrapper::widget([
    'layerClass' => 'lo\modules\noty\layers\Toastr',
]); ?>

<?= Dialog::widget(
    [
        'options' => [
            'closable' => true,
            'type' => Dialog::DIALOG_PROMPT, // bootstrap contextual color
            'btnOKClass' => 'btn green',
            'btnCancelClass' => 'btn dark btn-outline',
        ]
    ]
); ?>
<?= $this->render('//layouts/_header'); ?>

<div class="clearfix"></div>

<div class="page-container">

    <?= $this->render('//layouts/_side-menu'); ?>

    <div class="page-content-wrapper">
        <div class="page-content">
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

<?= $this->render('//layouts/_footer'); ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
