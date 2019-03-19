<?php

namespace app\modules\panel\controllers;

use app\models\Category;
use app\models\ItemCategory;
use app\models\ItemImage;
use app\models\ItemPropertyValueRel;
use app\models\ItemSize;
use app\models\Size;
use app\modules\panel\models\UploadModel;
use Yii;
use app\models\Item;
use app\modules\panel\models\ItemSearch;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\imagine\Image;

/**
 * ItemController implements the CRUD actions for Item model.
 */
class ItemController extends Controller
{
    public function init()
    {
        Yii::$app->getView()->params['breadcrumbs'] = [
            'Panel' => '/panel',
            'Items' => '/panel/item',
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
                    'drop' => ['POST'],
                    'add-category' => ['POST', 'AJAX'],
                    'drop-category' => ['POST', 'AJAX'],
                    'add-size' => ['POST', 'AJAX'],
                    'drop-size' => ['POST', 'AJAX'],
                    'drop-property' => ['POST', 'AJAX'],
                ],
            ],
        ];
    }

    /**
     * Lists all Item models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Item model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->view->registerJsVar('itemId', $id);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'uploadModel' => new UploadModel(),
        ]);
    }

    /**
     * Creates a new Item model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Item();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Item model.
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
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDrop($id)
    {
        $this->findModel($id)->delete();

        if (!Yii::$app->request->isAjax) {
            return $this->redirect(Yii::$app->urlManager->createUrl('/panel/item'));
        }
    }

    /**
     * Finds the Item model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Item the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Item::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * @return bool
     */
    public function actionAddCategory()
    {
        $itemId = Yii::$app->request->post('itemId');
        $categories = Yii::$app->request->post('categories');

        if (!$categories || !$itemId) {
            return false;
        }

        $item = Item::findOne($itemId);
        if (!$item) {
            return false;
        }

        foreach ($categories as $categoryId) {
            $category = Category::findOne($categoryId);

            if (!$category) {
                continue;
            }

            $item->addToCategory($category);
        }

        return true;
    }

    public function actionDropCategory($id)
    {
        if (!$rel = ItemCategory::findOne($id)) {
            return false;
        }

        return $rel->delete();
    }

    public function actionAddSize()
    {
        $itemId = Yii::$app->request->post('itemId');
        $sizeIds = Yii::$app->request->post('sizes');

        if (!$sizeIds || !$itemId) {
            return false;
        }

        $item = Item::findOne($itemId);
        if (!$item) {
            return false;
        }

        foreach ($sizeIds as $sizeId) {
            $size = Size::findOne($sizeId);

            if (!$size) {
                continue;
            }

            $item->addSize($size);
        }

        return true;
    }

    public function actionDropSize($id)
    {
        if (!$rel = ItemSize::findOne($id)) {
            return false;
        }

        return $rel->delete();
    }

    public function actionAddImage($id)
    {
        $item = Item::findOne($id);
        if (!$item) {
            return false;
        }

        $uploadModel = new UploadModel();
        $uploadedFile = UploadedFile::getInstance($uploadModel, 'files');

        $directory = Yii::getAlias('@item-images-dir') . DIRECTORY_SEPARATOR;
        if (!is_dir($directory)) {
            FileHelper::createDirectory($directory);
        }

        if ($uploadedFile) {
            $uid = uniqid(time(), true);
            $fileName = $uid . '.' . $uploadedFile->extension;
            $filePath = $directory . $fileName;
            $thumbFile = $directory . "tn-{$fileName}";
            if ($uploadedFile->saveAs($filePath)) {
                Image::thumbnail($filePath, 200, 200)->save($thumbFile, ['quality' => 80]);
                $path = '/uploads/items/tn-' . $fileName;

                $imageModel = new \app\models\Image();
                $imageModel->path = '/uploads/items/';
                $imageModel->name = $fileName;
                $imageModel->size = $uploadedFile->size;
                $imageModel->tags = $item->title;
                $imageModel->save();

                $itemImage = new ItemImage();
                $itemImage->item_id = $item->id;
                $itemImage->image_id = $imageModel->id;
                $itemImage->save();

                return Json::encode([
                    'files' => [
                        [
                            'name' => $fileName,
                            'size' => $uploadedFile->size,
                            'url' => $path,
                            'thumbnailUrl' => $path,
                            'deleteUrl' => 'image-delete?id=' . $imageModel->id,
                            'deleteType' => 'POST',
                        ],
                    ],
                ]);
            }
        }

        return '';
    }

    public function actionCategoriesForm($id)
    {
        if (!$model = Item::findOne($id)) {
            throw new NotFoundHttpException(Yii::t('app', 'Item not found'));
        }

        return $this->renderPartial('_categories-form', ['model' => $model]);
    }

    public function actionSavePropertyList($id)
    {
        if (!$model = Item::findOne($id)) {
            throw new NotFoundHttpException(Yii::t('app', 'Item not found'));
        }

        if (!$values = Yii::$app->request->post('values', [])) {
            throw new BadRequestHttpException(Yii::t('app', 'Values list is empty'));
        }

        foreach ($values as $valueId) {
            if (!ItemPropertyValueRel::find()->where(['item_id' => $id, 'property_value_id' => $valueId])->exists()) {
                $model = new ItemPropertyValueRel();
                $model->property_value_id = $valueId;
                $model->item_id = $id;
                $model->save();
            }
        }
    }

    public function actionDropProperty($id)
    {
        ItemPropertyValueRel::deleteAll(['id' => $id]);
    }
}
