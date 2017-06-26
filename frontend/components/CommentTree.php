<?php
namespace frontend\components;

use yii\base\Widget;
/**
 * Created by PhpStorm.
 * User: tomaszh
 * Date: 23.06.2017
 * Time: 11:28
 */
class CommentTree extends Widget
{
    /**
     * @var
     */
    public $comments;
    /**
     * @var
     */
    public $postId;

    public function init(){
        parent::init();
    }

    /**
     * @return string
     */
    public function run(){
        return $this->render('comments/comments-tree', ['comments' => $this->comments, 'postId' => $this->postId]);
    }
}