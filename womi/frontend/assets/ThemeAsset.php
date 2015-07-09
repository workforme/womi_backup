<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;
use components\LuLu;
use common\includes\CommonUtility;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ThemeAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css','css_2/index.css','css_2/base.css','css_2/ucenter.css','css_2/guide.css',
    ];
    public $js = [
	'js_2/valicode.js','js_2/ucenter.js','js_2/about.js','js/js.js','js_2/index.js','js_2/common.js',//'js_2/jquery-1.8.2.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    
    public function init()
    {
    	$this->baseUrl='@web/static/themes/'.CommonUtility::getCurrentTheme();
    	parent::init();
    }
}
