<?php

use frontend\assets\TimelineAsset;
use yii\widgets\ListView;

/* @var $this yii\web\View */
TimelineAsset::register($this);

$this->title = 'My Yii Application';
?>
<div class="blog-main">
    <?php

    echo ListView::widget([
        'dataProvider' => $dataProvider,
        'summary' => '',
        'itemView' => '_post-brief',
        'pager' => [
            'firstPageLabel' => 'first',
            'lastPageLabel' => 'last',
            'prevPageLabel' => 'previous',
            'nextPageLabel' => 'next',
        ],
        'itemOptions' => [
            'tag' => false,
        ],
    ])
    ?>

</div>