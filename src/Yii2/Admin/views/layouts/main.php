<?php

/**
 * @var View $this
 * @var Request $request
 * @var DataProvider $dataProvider
 * @var ValidateEntityByMetadataInterface $filterModel
 * @var $content
 */

use yii\web\Request;
use yii\web\View;
use ZnCore\Domain\Interfaces\Entity\ValidateEntityByMetadataInterface;
use ZnCore\Domain\Libs\DataProvider;

//$this->title = I18Next::t('settings', 'main.title');

?>

<?php $this->beginContent('@app/views/layouts/main.php'); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="mb-3">
            <?= $this->render('_nav', [

            ]) ?>
        </div>
        <?= $content ?>
    </div>
</div>

<?php $this->endContent(); ?>
