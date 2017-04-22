<?php

use yii\widgets\Menu;

?>

<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">

        <?=
        Menu::widget([
            'encodeLabels' => false,
            'items' => [
                ['label' => '<i class="icon-docs"></i>&nbsp;<span class="title">' . Yii::t('app', 'Posts') . '</span>', 'url' => ['/post/index'], 'options' => ['class' => 'nav-item start'], 'icon' => 'icon-home'],
                ['label' => '<i class="icon-note"></i>&nbsp;<span class="title">' . Yii::t('app', 'Comments') . '</span>', 'url' => ['comment/index'], 'options' => ['class' => 'nav-item']],
                ['label' => '<i class="icon-pin"></i>&nbsp;<span class="title">' . Yii::t('app', 'Tags') . '</span>', 'url' => ['tag/index'], 'options' => ['class' => 'nav-item']],
            ],
            'options' => ['class' => 'page-sidebar-menu', 'data-keep-expanded' => 'false', 'data-auto-scroll' => 'true', 'data-slide-speed'=> 200],
            'linkTemplate' => '<a href="{url}" class="nav-link">{label}</a>',
        ]);
        ?>

    </div>
</div>

            