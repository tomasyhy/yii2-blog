<?php

use yii\helpers\{Html, Url};
use yii\widgets\Pjax;

?>
<div class="panel-default">
    <?php Pjax::begin(['enablePushState' => false, 'id' => 'comments-pjax']); ?>
    <ul class="media-list">
        <?php tree($comments, $postId); ?>

        <?php function tree($comments, $postId)
        { ?>
            <?php
            foreach ($comments as $comment): ?>
            <div class="media">
                <div class="media-left">
                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                </div>
                <div class="media-body">
                    <h4 class="media-heading"><?= $comment->author ?>
                        <small><?= Yii::$app->formatter->asDate($comment->created_at); ?></small>
                    </h4>
                    <p><?= $comment->content; ?>
                        <small><?= Html::a(Yii::t('app', 'Reply'), '#', ['class' => 'show-form nounderline']) ?></small>
                    </p>
                    <div class="replay-form hide">
                        <?= Yii::$app->controller->renderPartial('_comment-form', ['comment' => new \common\models\Comment(), 'commentTree' => new \common\models\CommentTree(), 'postId' => $postId, 'ancestorId' => $comment->id]); ?>
                    </div>
                    <?php if ($comments = $comment->getFirstLevelDescendants()) tree($comments, $postId); ?>
                </div>
            </div>
        <?php endforeach; ?>
        <?php }; ?>
    </ul>
    <?php Pjax::end(); ?>

</div>

<?php $this->registerJsFile(
    '@web/js/comment/add-comment-form.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
); ?>