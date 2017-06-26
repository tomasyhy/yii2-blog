<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\{StringHelper, Url};

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
        <p><?= StringHelper::truncateWords(HtmlPurifier::process(preg_replace('#<pre>.*</pre>#s', '', $model->content)), \Yii::$app->params['numberOfWordsInBrief']); ?></p>

        <p><a class="btn btn-default" href="<?= Url::to(['post', 'id' => $model->id]); ?>"><?= Yii::t('app', 'Read more'); ?> &raquo;</a></p>
    </div>
</div>






