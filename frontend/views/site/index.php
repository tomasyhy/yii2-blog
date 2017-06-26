<?php

use yii\widgets\ListView;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

<!--    <div class="jumbotron">-->
<!--        <h1>Web developing </h1>-->
<!---->
<!--    </div>-->

    <div class="body-content">

                    <?php

            echo ListView::widget([
                'dataProvider' => $dataProvider,
                'summary'=>'',
                'itemView' => '_post-brief',
                'pager' => [
                    'firstPageLabel' => 'first',
                    'lastPageLabel' => 'last',
                    'prevPageLabel' => 'previous',
                    'nextPageLabel' => 'next',
                ],
            ])
            ?>


    </div>
</div>
