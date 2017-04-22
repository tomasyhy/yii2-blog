<?php

use admin\assets\ErrorAsset;
use yii\helpers\Html;


ErrorAsset::register($this);

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

    <body class="page-500-full-page">
    <?php $this->beginBody() ?>
    <div class="content">
        <?= $content ?>
    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>




