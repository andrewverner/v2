<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 14.03.19
 * Time: 15:36
 */

namespace app\modules\panel\widgets;

class MenuItem
{
    /**
     * @var string
     */
    public $label;

    /**
     * @var string
     */
    public $icon;

    /**
     * @var string
     */
    public $url;

    /**
     * @var MenuItem[]
     */
    public $items = [];

    /**
     * MenuItem constructor.
     * @param $label
     * @param $icon
     * @param $url
     * @param $items
     */
    public function __construct($label, $icon, $url, $items = null)
    {
        $this->label = $label;
        $this->icon = $icon;
        $this->url = $url;
        $this->items = $items;
    }

    /**
     * @return bool
     */
    public function hasChildren()
    {
        return !empty($this->items);
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return $this->icon ? '<i class="' . $this->icon . '"></i> ' : '';
    }

    public function getClass()
    {
        $classes = [];

        if ($this->items) {
            $classes[] = 'treeview';

            foreach (array_column($this->items, 'url') as $url) {
                if (strstr(\Yii::$app->request->url, $url)) {
                    $classes[] = 'menu-open';
                    continue;
                }
            }
        }

        if (strstr(\Yii::$app->request->url, $this->url)) {
            $classes[] = 'active';
        }

        return implode(' ', $classes);
    }
}
