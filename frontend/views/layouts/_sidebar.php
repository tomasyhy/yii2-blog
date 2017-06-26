<?php
use yii\widgets\Menu;
use common\models\Tag;
?>
<div class="sidebar-module">
    <h4><?= Yii::t('app', 'Tags') ?></h4>
    <?php

    foreach (Tag::getAllWithQuantity() as $tag) {
        $menuItems[] = ['label' => $tag['name'] . " ({$tag['quantity']})", 'url' => ['site/index', 'tag' => strtolower($tag['name'])], 'options' => ['role' => 'presentation']];
    }

    echo Menu::widget([
        'encodeLabels' => false,
        'items' =>
            $menuItems,
        'options' => ['class' => 'nav nav-pills nav-stacked'],
//        'linkTemplate' => '<a href="{url}" class="nav-link">{label}</a>',
    ]);
    ?>
</div>
            