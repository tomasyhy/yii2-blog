<?php

use yii\widgets\Menu;

?>



        <?=
        Menu::widget([
            'encodeLabels' => false,
            'items' => [
                ['label' => '<i class="icon-docs"></i>&nbsp;<span class="title">' . Yii::t('app', 'Posts') . '</span>', 'url' => ['/post/index'], 'options' => ['class' => 'nav-item start'], 'icon' => 'icon-home'],
                ['label' => '<i class="icon-note"></i>&nbsp;<span class="title">' . Yii::t('app', 'Comments') . '</span>', 'url' => ['/comment/index'], 'options' => ['class' => 'nav-item']],
                ['label' => '<i class="icon-pin"></i>&nbsp;<span class="title">' . Yii::t('app', 'Tags') . '</span>', 'url' => ['/tag/index'], 'options' => ['class' => 'nav-item']],
                ['label' => '<i class="icon-user"></i>&nbsp;<span class="title">' . Yii::t('app', 'Users') . '</span>', 'url' => ['/users'], 'options' => ['class' => 'nav-item']],

            ],
            'options' => ['class' => 'nav nav-pills nav-stacked'],
            'linkTemplate' => '<a href="{url}">{label}</a>',
        ]);
        ?>


            