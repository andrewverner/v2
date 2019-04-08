<?php

namespace app\modules\panel\controllers;

use app\models\SignUpForm;
use app\models\UserAddress;
use Yii;
use app\models\User;
use app\modules\panel\models\UserSearch;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotAcceptableHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    public function init()
    {
        Yii::$app->getView()->params['breadcrumbs'] = [
            'Panel' => '/panel',
            'Users' => '/panel/user',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionForm()
    {
        $model = new SignUpForm();

        return $this->renderPartial('_form', ['model' => $model]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * @throws BadRequestHttpException
     */
    public function actionCreate()
    {
        $model = new SignUpForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = User::create(
                $model->username,
                $model->password1,
                $model->email
            );

            return $this->redirect(Yii::$app->urlManager->createUrl([
                '/panel/user/view',
                'id' => $user->id,
            ]));
        }

        throw new BadRequestHttpException(Html::ul($model->getErrorSummary(true)));
    }

    public function actionBlock($id)
    {
        $user = User::findOne($id);

        if (!$user) {
            throw new  NotFoundHttpException(Yii::t('app', 'User not found'));
        }

        if ($user->id == Yii::$app->user->id) {
            throw new NotAcceptableHttpException(Yii::t('app', 'You can not block yourself'));
        }

        $user->blocked = $user->blocked ? 0 : 1;
        if (!$user->save()) {
            throw new  NotFoundHttpException(Html::ul($user->getErrorSummary(true)));
        }
    }

    public function actionAddressForm($userId, $id = null)
    {
        $model = $id ? UserAddress::findOne($id) : new UserAddress();
        $model->user_id = $userId;

        return $this->renderPartial('_address-form', ['model' => $model, 'userId' => $userId]);
    }

    public function actionSaveAddress()
    {
        $id = ArrayHelper::getValue(Yii::$app->request->post('UserAddress'), 'id', null);

        $model = $id ? UserAddress::findOne($id) : new UserAddress();
        $model->load(Yii::$app->request->post());
        if (!$model->validate()) {
            throw new  BadRequestHttpException(Html::ul($model->getErrorSummary(true)));
        }

        $model->save();
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
