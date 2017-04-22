<?php
namespace admin\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use dektrium\user\models\LoginForm;
use yii\web\Response;
use dektrium\user\controllers\SecurityController;

/**
 * Site controller
 */
class SiteController extends SecurityController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['error'],
                        'allow' => true,
                    ],
                ],
            ],
        ];
    }
    
    public function actionError()
    {
        $this->layout = 'error';
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            return $this->render('error', ['exception' => $exception]);
        }
    }

}
