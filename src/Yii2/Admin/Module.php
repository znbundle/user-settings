<?php

namespace ZnBundle\UserSettings\Yii2\Admin;

use yii\base\Module as YiiModule;
use yii\helpers\Url;
use ZnCore\Base\Libs\I18Next\Facades\I18Next;
use ZnLib\Web\Widgets\BreadcrumbWidget;

class Module extends YiiModule
{

    public $layout = 'main';
    public $defaultRoute;
    public $controllerNamespace = __NAMESPACE__ . '\Controllers';
    public $navItems = [];

    private $breadcrumbWidget;

    public function __construct(
        $id, $parent = null,
        BreadcrumbWidget $breadcrumbWidget,
        $config = []
    )
    {
        parent::__construct($id, $parent, $config);
        $breadcrumbWidget->add(I18Next::t('settings', 'main.title'), Url::to(['/settings']));
    }
}
