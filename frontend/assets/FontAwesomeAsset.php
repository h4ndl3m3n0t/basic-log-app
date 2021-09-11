<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Font Awesome asset bundle.
 */
class FontAwesomeAsset extends AssetBundle
{
    public $sourcePath = '@bower/font-awesome';
    public $css = [
        'css/all.min.css',
    ];
}
