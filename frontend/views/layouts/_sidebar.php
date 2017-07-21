<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use common\models\Tag;

?>


<?php

NavBar::begin([
    'brandLabel' => (Yii::$app->params['appName'] ?? Yii::$app->name) . '</br><small>' . Yii::$app->params['author'] . '</small>',
        'options' => [
    'class' => 'navbar navbar-inverse navbar-fixed-side',
]]);
?>
        <?php
        $menuItems = [];
        foreach (Tag::getAllWithQuantity() as $tag) {
            $menuItems[] = ['label' => $tag['name'] . " ({$tag['quantity']})", 'url' => ['site/index', 'tag' => strtolower($tag['name'])]];
        }

        echo Nav::widget([
            'encodeLabels' => false,
            'items' =>
                [
                    ['label' => '<span class="glyphicon glyphicon-home" aria-hidden="true"></span> &nbsp' . Yii::t('app', 'Home') , 'url' => '/', 'options' => ['title' => 'Home']],
                    ['label' => '<span class="glyphicon glyphicon-user" aria-hidden="true"></span> &nbsp' . Yii::t('app', 'About Me') , 'url' => ['about-me'], 'options' => ['title' => 'About Me']],
                    ['label' => '<span class="glyphicon glyphicon-tags" aria-hidden="true"></span> &nbsp' . Yii::t('app', ' Categories'),
                    'items' => $menuItems
                        ],
                    ['label' => '<span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> &nbsp' . Yii::t('app', 'Contact') , 'url' => ['contact'], 'options' => ['title' => 'Contact']],
                ],

            'options' => ['class' => 'nav navbar-nav'],
        ]);

        ?>


    <div class="footer">
        <div class="container">
            <p class="pull-left"> Copyright ©
                <?php echo date('Y') . ' ' . Yii::$app->params['owner']; ?> </p>
        </div>
    </div>
<?php NavBar::end(); ?>