<?php

use frontend\assets\HighlightAsset;
use yii\helpers\{Html, StringHelper, Url};
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Comment */
HighlightAsset::register($this);
$this->title = StringHelper::truncateWords(strip_tags($model->title), 3);

?>

<p><small class="text-right"><?= Yii::$app->formatter->asDate($model->created_at); ?></small></p>
<div class="panel panel-default">
    <div class="panel-heading"><h3><?= Html::encode($model->title) ?>
            <?php foreach ($model->getTagsName() as $tag) { ?>
                <small><span class="label label-default"><?= $tag ?></span></small>
            <?php } ?>
        </h3>
    </div>
    <div class="panel-body">
        <p><?= $model->content ?></p>
    </div>
</div>

<hr>
<?= $this->render('_comment-form', ['comment' => $comment, 'commentTree' => $commentTree, 'postId' => $model->id, 'ancestorId' => null]); ?>
<hr>
<?= $this->render('_comments', ['comments' => $comments, 'postId' => $model->id]); ?>
