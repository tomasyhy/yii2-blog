<?php
use frontend\components\CommentTree;

?>

<?= CommentTree::widget(['comments' => $comments, 'postId' => $postId]) ?>

