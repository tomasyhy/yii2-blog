<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $name;
?>

<div class="row">
    <div class="col-md-12 page-500">
        <div class=" number font-red"><?= $exception->statusCode ?></div>
        <div class=" details">
            <h3><?= Yii::t('app', 'The below error occurred while the Web server was processing your request.') ?></h3>
            <p> <?= nl2br(Html::encode($exception->getMessage())) ?>
                <br> </p>
            <p>
                <a href="<?= Url::home(true) ?>" class="btn red btn-outline"><?= Yii::t('app', 'Return home') ?></a>
                <br> </p>
        </div>
    </div>
</div>