<?php

use admin\assets\{AdminAsset};
use yii\helpers\Html;

AdminAsset::register($this);

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <link rel="icon" type="image/x-icon" href="<?php echo Yii::$app->urlManager->baseUrl; ?>/images/test/favicon.ico"/>
    <title><?= Html::encode($this->title) ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <meta name="MobileOptimized" content="320">

    <?php $this->head() ?>
</head>

<body>

<?php $this->beginBody() ?>
<div class="content">
    <div class="col-lg-5"></div>
    <div class="col-lg-2">
    <?= $content ?>
    </div>
    <div class="col-lg-5"></div>
</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

