<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 26.03.19
 * Time: 13:45
 */

namespace app\components\behaviors;

use app\models\Category;
use app\models\Item;
use app\models\News;
use app\models\Page;
use app\models\Seo;

class SeoBehavior extends \yii\base\Behavior
{
    /**
     * @var Category|Item|Page|News
     */
    public $model;

    /**
     * @return Seo|null
     */
    public function getSeo()
    {
        return Seo::findOne([
            'entity_id' => $this->model->id,
            'entity_type' => $this->model::className(),
        ]);
    }
}
