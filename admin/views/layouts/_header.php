<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

?>


<?php
NavBar::begin([
    'options' => [
        'class' => 'navbar-inverse navbar',
    ],
]);
?>
<div class="container-fluid">
    <div class="navbar-header">
        <a class="navbar-brand" href="<?= \yii\helpers\Url::to(['/']) ?>">Administration Panel</a>
    </div>
    <div>

        <?php echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-left'],
            'items' => [
                ['label' => 'Blog', 'url' => \Yii::$app->urlManagerFrontEnd->createUrl('')]
            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Log Out', 'url' => ['/logout'], 'linkOptions' => ['data-method' => 'post']]
            ],
        ]);
        ?>

    </div>
</div>
<?php
NavBar::end();
?>

