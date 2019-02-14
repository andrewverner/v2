<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 14.02.2019
 * Time: 21:58
 */

namespace app\modules\panel\models;

use app\models\Category;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class CategoryForm extends Model
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $parent;

    /**
     * @var string
     */
    public $url;

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'url'], 'filter', 'filter' => 'trim'],
            [['parent'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => \Yii::t('app', 'Category name'),
            'parent' => \Yii::t('app', 'Parent category'),
            'url' => \Yii::t('app', 'Category URL'),
        ];
    }

    public function parentCategories()
    {
        return ArrayHelper::map(Category::find()->all(), 'id', 'name');
    }
}
