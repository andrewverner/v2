<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 08.04.19
 * Time: 16:05
 */

namespace app\modules\panel\widgets;

class YMapPlacemark
{
    /**
     * @var float
     */
    public $lat;

    /**
     * @var float
     */
    public $lng;

    /**
     * @var string
     */
    public $title;

    public function __construct($lat, $lng, $title = null)
    {
        $this->lat = $lat;
        $this->lng = $lng;

        $this->title = $title;
    }
}
