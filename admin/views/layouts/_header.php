<?php

use yii\helpers\Url;

?>

<div class="page-header navbar navbar-fixed-top">
    <div class="page-header-inner ">
        <div class="page-logo">
            <a href="<?= Url::to(['/post']) ?>">
                Administration panel
            </a>
        </div>
        <div class="page-top">
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <li class="link">
                        <a href="<?= Url::to(['/logout']) ?>" data-method="post" >Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>