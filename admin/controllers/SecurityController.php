<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace admin\controllers;

use dektrium\user\controllers\SecurityController as BaseSecurityController;
use dektrium\user\Module;
use dektrium\user\models\LoginForm;
use yii\web\Response;
use Yii;

class SecurityController extends BaseSecurityController
{
//    public function actionLogin()
//    {
//        if (!Yii::$app->user->isGuest) {
//            $this->goHome();
//        }
//
//        /** @var LoginForm $model */
//        $model = Yii::createObject(LoginForm::className());
//        $event = $this->getFormEvent($model);
//
//        $this->performAjaxValidation($model);
//        $this->trigger(self::EVENT_BEFORE_LOGIN, $event);
//
//        if ($model->load(Yii::$app->getRequest()->post()) && $model->login()) {
//            $this->trigger(self::EVENT_AFTER_LOGIN, $event);
//
//            if (Yii::$app->user->identity->getIsAdmin()) {
//                return $this->redirect('site');
//            }
//        }
//
//        return $this->render('login', [
//            'model' => $model,
//            'module' => $this->module,
//        ]);
//    }
}