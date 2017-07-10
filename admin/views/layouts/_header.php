<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

?>


<?php
NavBar::begin([
    'options' => [
        'class' => 'navbar navbar-inverse text-center navbar-static-top',
    ],
    'renderInnerContainer' => false,
]);
?>
<div class="container-fluid">
    <div class="navbar-header">
        <a class="navbar-brand" href="<?= \yii\helpers\Url::to(['/']) ?>">Administration Panel</a>
    </div>
    <div>
        <?php
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Blog', 'url' => \Yii::$app->urlManagerFrontEnd->createUrl('')],
                ['label' => 'Log Out', 'url' => ['/logout'], 'linkOptions' => ['data-method' => 'post']],
            ],
        ]);
        ?>

    </div>
</div>
<?php
NavBar::end();
?>

