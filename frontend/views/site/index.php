<?php

use frontend\assets\TimelineAsset;
use yii\widgets\ListView;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
TimelineAsset::register($this);
$this->title = Yii::t('app', 'Posts');

?>
<div class="blog-main">
    <div class="col-lg-10 col-lg-offset-1">
        <?php Pjax::begin(['enablePushState' => false]); ?>
        <?php
        echo ListView::widget([
            'dataProvider' => $dataProvider,
            'summary' => '',
            'itemView' => '_post-brief',
            'pager' => [
                'firstPageLabel' => '<<',
                'lastPageLabel' => '>>',
                'prevPageLabel' => '<',
                'nextPageLabel' => '>',
            ],
            'itemOptions' => [
                'tag' => 'li',
                'class' => 'timeline-item'
            ],
            'options' => [
                'tag' => 'ul',
                'class' => 'timeline timeline-centered text-center'
            ],
        ])
        ?>
        <?php Pjax::end(); ?>

    </div>
</div>


