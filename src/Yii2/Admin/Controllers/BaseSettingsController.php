<?php

namespace ZnBundle\UserSettings\Yii2\Admin\Controllers;

use yii\helpers\Url;
use yii\web\Controller;
use ZnCore\Base\Libs\I18Next\Facades\I18Next;
use ZnLib\Web\Widgets\BreadcrumbWidget;

abstract class BaseSettingsController extends Controller
{

    public $navItems = [];
    protected $viewAlias;

    /** @var BreadcrumbWidget */
    protected $breadcrumbWidget;

    protected $toastrService;

    protected $service;

    public function beforeAction($action)
    {
        if($this->navItems) {
            $actionId = $action->id;
            $title = I18Next::t('member', $actionId . '.title');
            $url = Url::to(['/settings/security/' . $actionId]);
            $this->breadcrumbWidget->add($title, $url);
        }
        return parent::beforeAction($action);
    }

    public function render($view, $params = [])
    {
        if($this->viewAlias) {
            $view = $this->viewAlias;
        } else {
            $controllerClassName = get_called_class();
            $moduleViewsPath = str_replace(['Controllers', '\\'], ['views', '/'], $controllerClassName);
            $moduleViewsPath = dirname($moduleViewsPath);
            $controllerViewsPath = $moduleViewsPath . '/' . $this->id;
            $view = '@'.$controllerViewsPath.'/' . $view;
        }
        return parent::render($view, $params);
    }
}
