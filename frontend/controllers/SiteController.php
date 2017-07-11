<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\bootstrap\ActiveForm;
use yii\web\Response;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\{
    Comment, CommentTree, PostSearch, Post
};
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
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
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
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
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionPost($id)
    {
        $post = $this->findModel($id);

        return $this->render('post', [
            'model' => $post,
            'comment' => new Comment(),
            'comments' => $post->getRootPostComments(),
            'commentTree' => new CommentTree(),
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting me. I will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }
            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * @param $id
     * @return static
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @return array
     */
    public function actionAddComment()
    {
        $comment = new Comment();
        $commentTree = new CommentTree();
        $post = Yii::$app->request->post();
        Yii::$app->response->format = Response::FORMAT_JSON;

        if (Yii::$app->request->isAjax && $comment->load($post) && $commentTree->load($post) && $comment->validate() && $comment->saveCommentWithTree($commentTree)) {
            Yii::$app->mailer->compose()
                ->setTo(Yii::$app->params['adminEmail'])
                ->setFrom([$post['Comment']['email'] => $post['Comment']['author']])
                ->setSubject('Comment')
                ->setTextBody($post['Comment']['content'])
                ->send();
            return ['status' => 'success'];
        }

        return ['status' => 'error'];

    }

    /**
     * @return array
     */
    public function actionValidateComment()
    {
        $comment = new Comment();
        $request = \Yii::$app->getRequest();

        if (Yii::$app->request->isAjax && $request->isPost && $comment->load($request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($comment);
        }
    }

    /**
     * @return string
     */
    public function actionAddCommentForm()
    {

        $comment = new Comment();
        $commentTree = new CommentTree();
        return $this->renderPartial('_comment-form', ['comment' => $comment, 'commentTree' => $commentTree, 'postId' => null, 'ancestorId' => null]);
    }

}
