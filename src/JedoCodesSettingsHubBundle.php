<?php

declare(strict_types=1);

/**
 * Contao SettingsHub bundle for Contao Open Source CMS
 * Copyright (c) 2024 jedo.Codes
 *
 * @category ContaoBundle
 * @package  jedocodes/contao-settings-hub-bundle
 * @author   jedo.Codes <dev@jedo.codes>
 * @link     https://github.com/jedocodes/contao-settings-hub-bundle
 */

namespace JedoCodes\SettingsHubBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class JedoCodesSettingsHubBundle extends Bundle
{
    public const VERSION = '1.0.2';

    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
