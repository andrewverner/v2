<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 08.04.19
 * Time: 16:03
 */

namespace app\modules\panel\widgets;

use yii\base\Widget;

class YMapWidget extends Widget
{
    /**
     * @var YMapPlacemark[]
     */
    public $placemarks = [];

    /**
     * @var int
     */
    public $zoom = 15;

    /**
     * @var array
     */
    public $center;

    public function run()
    {
        if (!$this->center) {
            if (!$this->placemarks) {
                $this->center = [0, 0];
            }

            $this->center = [
                $this->placemarks[0]->lat,
                $this->placemarks[0]->lng,
            ];
        }

        return $this->render('y-map', [
            'zoom' => $this->zoom,
            'center' => $this->center,
            'placemarks' => $this->placemarks,
        ]);
    }

    public function addPlacemark(YMapPlacemark $placemark)
    {
        $this->placemarks[] = $placemark;
    }
}
