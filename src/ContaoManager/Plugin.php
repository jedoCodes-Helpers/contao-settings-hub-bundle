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

namespace JedoCodes\SettingsHubBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use JedoCodes\SettingsHubBundle\JedoCodesSettingsHubBundle;
use Plenta\ContaoEncryptionBundle\Classes\Encryption;

/**
 * @internal
 */
class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(JedoCodesSettingsHubBundle::class)
                ->setLoadAfter([
                    ContaoCoreBundle::class,
                    Encryption::class
                ])
                ->setReplace(['settings_hub']),
        ];
    }
}
