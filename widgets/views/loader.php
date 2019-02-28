<?php
/**
 * @var \yii\web\View $this
 */
use app\assets\LoaderAsset;
LoaderAsset::register($this);
?>
<div id="loader-container" class="center-container">
    <svg class="rotate-1">
        <path id="arc1" fill="none" stroke="#fff" stroke-width="3" d="M 100 190 A 90 90 0 0 0 100 10"></path>
    </svg>
    <svg class="rotate-2">
        <path id="arc2" fill="none" stroke="#aaa" stroke-width="3" d="M 170 100 A 70 70 0 0 0 30 100"></path>
    </svg>
    <svg class="rotate-3">
        <path id="arc3" fill="none" stroke="#555" stroke-width="3" d="M 100 50 A 50 50 0 0 0 100 150"></path>
    </svg>
</div>
