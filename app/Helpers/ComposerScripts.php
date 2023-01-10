<?php

namespace App\Helpers;

use Composer\Script\Event;
use GemaDigital\Framework\app\Helpers\Composer\ComposerScripts as DefaultComposerScripts;

class ComposerScripts extends DefaultComposerScripts
{
    /**
     * Handle the post-install Composer event.
     *
     * @return void
     */
    public static function postInstall()
    {
        parent::postInstall();

        switch (DIRECTORY_SEPARATOR) {
            case '/':
                // unix
                break;
            case '\\':
                // windows
                break;
        }
    }
}
