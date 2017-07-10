<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>        <?= Yii::$app->params['appName'] ?? Yii::$app->name ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2 col-lg-2">
            <?= $this->render('//layouts/_sidebar'); ?>
        </div>

        <div class="col-sm-10 col-lg-10">
            <div class="col-lg-10 col-lg-offset-1 site-view">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= $content ?>
            </div>
        </div>
    </div>
</div>




<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
