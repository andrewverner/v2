<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 17.02.2019
 * Time: 17:39
 */

namespace app\modules\panel\models;

use yii\base\Model;

class UploadModel extends Model
{
    public $files;

    public function rules()
    {
        return [
            [['files'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'files' => 'Files',
        ];
    }
}
