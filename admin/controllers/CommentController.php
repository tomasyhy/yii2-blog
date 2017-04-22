<?php

namespace admin\controllers;

use admin\components\{
    Confirmation
};
use common\models\{
    Comment, CommentSearch
};
use dektrium\user\filters\AccessRule;
use yii\web\{
    NotFoundHttpException, Controller
};
use yii\filters\{
    VerbFilter, AccessControl
};
use Yii;

/**
 * CommentController implements the CRUD actions for Comment model.
 */
class CommentController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'rules' => [
                    [
                        'actions' => ['index', 'delete', 'change-status', 'view'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Comment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CommentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Deletes an existing Comment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if ($this->findModel($id)->delete()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Comment has been deleted successfully'));
            return 'success';
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'An error occurred during deleting comment'));
            return 'error';
        }
    }

    public function actionChangeStatus($id)
    {
        $comment = $this->findModel($id);
        if ($comment->isPublished()) {
            $comment->status = Comment::NOT_PUBLISHED;
            $successMessage = 'Comment has been removed successfully';
            $errorMessage = 'An error occurred during removing comment';
        } else {
            $comment->status = Comment::PUBLISHED;
            $successMessage = 'Comment has been published successfully';
            $errorMessage = 'An error occurred during publication comment';
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if ($comment->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', $successMessage));
            return 'success';
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', $errorMessage));
            return 'error';
        }

    }

    /**
     * Finds the Comment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Comment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Comment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
}
