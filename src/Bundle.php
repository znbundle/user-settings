<?php

namespace ZnBundle\UserSettings;

use ZnCore\Base\Libs\App\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function i18next(): array
    {
        return [
            'settings' => 'vendor/znbundle/user-settings/src/Domain/i18next/__lng__/__ns__.json',
        ];
    }
}
