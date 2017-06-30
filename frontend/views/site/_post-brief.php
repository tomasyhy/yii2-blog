<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\{
    StringHelper, Url
};

?>


<div class="timeline-item" date-is="<?= Yii::$app->formatter->asDate($model->created_at); ?>">

    <a href="<?= Url::to(['post', 'id' => $model->id]); ?>">
        <h1><?= Html::encode($model->title) ?>
        </h1>
    </a>
    <p><?= StringHelper::truncateWords(HtmlPurifier::process(preg_replace('#<pre>.*</pre>#s', '', $model->content)), \Yii::$app->params['numberOfWordsInBrief']); ?></p>
    <div>
        <?php foreach ($model->getTagsName() as $tag) { ?>
            <span class="label label-primary"><?= $tag ?></span>
        <?php } ?>
    </div>
</div>






