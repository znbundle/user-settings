<?php

/**
 * @var View $this
 * @var array $navMenuItems
 */

use yii\helpers\Url;
use yii\web\View;
use ZnCore\Base\Libs\I18Next\Facades\I18Next;
use ZnLib\Web\Widgets\NavbarMenuWidget;

$navMenuItems = Yii::$app->modules['settings']->navItems;
$subMenuItems = Yii::$app->controller->navItems ?? null;

function normalizeMenu(array $navMenuItems): array
{
    $action = Yii::$app->requestedAction;
    $route = $action->controller->module->id . '/' . $action->controller->id . '/' . $action->id;
    $route = trim($route, '/');

    foreach ($navMenuItems as &$item) {
        if (is_array($item['label'])) {
            $item['label'] = I18Next::translateFromArray($item['label']);
        }
        $url = trim($item['url'], '/');
        //dump("{$url}, $route");
        $item['active'] = strpos($url, $route) === 0 || strpos($route, $url) === 0;
        $item['url'] = Url::to([$item['url']]);
    }
    return $navMenuItems;
}

$navMenuItems = normalizeMenu($navMenuItems);

$nav = new NavbarMenuWidget($navMenuItems);
$nav->itemOptions = [
    'class' => 'nav-item',
    'tag' => 'li',
];
$nav->linkTemplate = '
    <a href="{url}" class="nav-link {class}">
        {icon}
        {label}
            {treeViewIcon}
            {badge}
    </a>';

if ($subMenuItems) {
    $subMenuItems = normalizeMenu($subMenuItems);
    $subNav = new NavbarMenuWidget($subMenuItems);
    $subNav->itemOptions = [
        'class' => 'nav-item',
        'tag' => 'li',
    ];
    $subNav->linkTemplate = '
    <a href="{url}" class="nav-link {class}">
        {icon}
        {label}
            {treeViewIcon}
            {badge}
    </a>';
}

?>

<ul class="nav nav-tabs">
    <?= $nav->render() ?>
</ul>

<?php if($subMenuItems): ?>
    <ul class="nav nav-pills mt-3">
        <?= $subNav->render() ?>
    </ul>
<?php endif; ?>
