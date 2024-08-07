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

use Contao\ArrayUtil;
use Contao\System;
use Symfony\Component\HttpFoundation\Request;
use JedoCodes\SettingsHubBundle\Classes\SettingsHubClass;

/*
 * Backend Module
 */
if (!\is_array($GLOBALS['BE_MOD']['jedocodes'] ?? null))
{
    ArrayUtil::arrayInsert($GLOBALS['BE_MOD'], 1, array('jedocodes' => array()));
}

ArrayUtil::arrayInsert($GLOBALS['BE_MOD']['jedocodes'], 999, [
	'settings_hub' => [
        'callback'          => SettingsHubClass::class,
        'stylesheet'        => ['bundles/jedocodessettingshub/css/settingshub.css'],

    ],
]);

/**
 *  Business Setup Module
 */
$GLOBALS['JEDOCODES_SETUPMODS'] = [
    'addons' => [
        'addon_catalog',
        'addon_documentations',
        'addon_issues',
        'addon_support',
    ]
];

// Style sheet
if (System::getContainer()->get('contao.routing.scope_matcher')->isBackendRequest(System::getContainer()->get('request_stack')->getCurrentRequest() ?? Request::create('')))
{
	//$GLOBALS['TL_CSS'][] = 'bundles/contaoextensionsconfiguration/backend.css|static';

}

// Add permissions
$GLOBALS['TL_PERMISSIONS'][] = 'config_modules';

