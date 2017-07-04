<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\{
    StringHelper, Url
};

?>
    <div class="timeline-info">
        <span><?= Yii::$app->formatter->asDate($model->created_at, 'MMMM d, Y'); ?></span>
    </div>
    <div class="timeline-marker"></div>


    <div class="timeline-content">
        <a href="<?= Url::to(['post', 'id' => $model->id]); ?>">
        <h3 class="timeline-title"><?= Html::encode($model->title) ?></h3>
        </a>

        <p><?= StringHelper::truncateWords(HtmlPurifier::process(preg_replace('#<pre>.*</pre>#s', '', $model->content)), \Yii::$app->params['numberOfWordsInBrief']); ?></p>
        <div>
            <?php foreach ($model->getTagsName() as $tag) { ?>
                <span class="label label-primary"><?= $tag ?></span>
            <?php } ?>
        </div>
    </div>