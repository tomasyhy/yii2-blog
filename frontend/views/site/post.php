<?php

use frontend\assets\HighlightAsset;
use yii\helpers\{
    Html, StringHelper, Url
};
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Comment */
HighlightAsset::register($this);
$this->title = StringHelper::truncateWords(strip_tags($model->title), 3);
// TO DO Comments and paddings
?>
<div class="post-content">
    <h1 class="page-header"><?= Html::encode($model->title) ?>
        <small class="text-right"><?= Yii::$app->formatter->asDate($model->created_at); ?></small>
    </h1>

    <div class="panel">

        <div class="panel-body">
            <p><?= $model->content ?></p>
        </div>
    </div>

    <p>
        <?php foreach ($model->getTagsName() as $tag) { ?>
            <span class="label label-primary"><?= $tag ?></span>
        <?php } ?>

    </p>
    <hr>
    <?= $this->render('_comment-form', ['comment' => $comment, 'commentTree' => $commentTree, 'postId' => $model->id, 'ancestorId' => null]); ?>
    <hr>
    <?= $this->render('_comments', ['comments' => $comments, 'postId' => $model->id]); ?>
</div>
