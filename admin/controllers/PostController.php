<?php

namespace admin\controllers;

use admin\components\{
    Confirmation
};
use common\models\{
    Post, PostSearch, PostTag
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
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{

    const PAGE_SIZE = 10;
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
                        'actions' => ['index', 'create', 'update', 'delete', 'change-status'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'change-status' => ['POST'],
                ],
            ],
        ];

    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = self::PAGE_SIZE;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $postTagModel = new PostTag();
        $model = new Post();
        $dataPOST = Yii::$app->request->post();
        if ($model->load($dataPOST) && $postTagModel->load($dataPOST)) {
            if ($model->save() && $postTagModel->saveTags($model->id, $dataPOST)) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Post has been created successfully'));
                return $this->redirect(['/post']);
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'An error occurred during creating post'));
            }
        } else {

            return $this->render('create', [
                'model' => $model,
                'postTagModel' => $postTagModel
            ]);
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $postTagModel = new PostTag();
        $postTagModel->tags = $model->getTagsId();
        $dataPOST = Yii::$app->request->post();
        if ($model->load($dataPOST) && $postTagModel->load($dataPOST)) {
            if ($model->save() && $postTagModel->saveTags($id, $dataPOST)) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Post has been updated successfully'));
                return $this->redirect(['/post']);
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'An error occurred during updating post'));
            }

        } else {
            return $this->render('update', [
                'model' => $model,
                'postTagModel' => $postTagModel
            ]);
        }
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if ($this->findModel($id)->delete()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Post has been deleted successfully'));
            return 'success';
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'An error occurred during deleting post'));
            return 'error';
        }
    }

    public function actionChangeStatus($id)
    {
        $post = $this->findModel($id);
        if ($post->isPublished()) {
            $post->status = Post::NOT_PUBLISHED;
            $successMessage = 'Post has been removed successfully';
            $errorMessage = 'An error occurred during removing post';
        } else {
            $post->status = Post::PUBLISHED;
            $successMessage = 'Post has been published successfully';
            $errorMessage = 'An error occurred during publication post';
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if ($post->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', $successMessage));
            return 'success';
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', $errorMessage));
            return 'error';
        }

    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
