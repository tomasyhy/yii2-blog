<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'About Me');

?>
<h1 class="page-header"><?= Html::encode($this->title) ?></h1>

<div class="panel">
    <div class="panel-body">
        <div class="row">
                <?= $model->about_me ?>
        </div>
    </div>
</div>