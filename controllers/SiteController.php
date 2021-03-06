<?php

namespace app\controllers;

use app\components\Controller;
use app\models\Category;
use app\models\Hash;
use app\models\Item;
use app\models\ItemCategory;
use app\models\User;
use Yii;
use yii\data\Pagination;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            /*'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],*/
        ];
    }

    /**
     * {@inheritdoc}
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
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSignUp()
    {
        $model = new \app\models\SignUpForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                User::create(
                    $model->username,
                    $model->password1,
                    $model->email
                );
                Yii::$app->session->setFlash('success', Yii::t('app', 'A letter with account activation link has been sent to your email address'));

                return $this->redirect(Yii::$app->urlManager->createUrl('/login'));
            }
        }

        return $this->render('sign-up', [
            'model' => $model,
        ]);
    }

    public function actionActivate($hash)
    {
        $model = Hash::findByHash($hash);
        if (!$model || $model->type != Hash::TYPE_ACTIVATE) {
            throw new NotFoundHttpException(Yii::t('app', 'Activate code not found or expired'));
        }

        $model->used = 1;
        $model->save();

        $user = $model->user;
        $user->active = 1;
        $user->save();

        Yii::$app->session->setFlash('success', Yii::t('app', 'Your account has been activated successfully. Now you can sign in'));

        return $this->redirect(Yii::$app->urlManager->createUrl('/login'));
    }

    public function actionCategory($id)
    {
        $category = Category::findOne($id);

        if (!$category || !$category->published) {
            throw new NotFoundHttpException(Yii::t('app', 'Category not found'));
        }

        $query = Item::find()
            ->from(Item::tableName() . ' i')
            ->innerJoin(ItemCategory::tableName() . ' ic', 'ic.item_id = i.id')
            ->innerJoin(Category::tableName() . ' c', 'c.id = ic.category_id')
            ->where('c.published = 1')
            ->groupBy('i.id');
        $countQuery = clone $query;

        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('category', [
            'models' => $models,
            'pages' => $pages,
        ]);
    }
}
