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

namespace JedoCodes\SettingsHubBundle\Classes;

use Contao\BackendModule;
use Contao\BackendUser;
use Contao\StringUtil;
use Contao\System;
use JedoCodes\SettingsHubBundle\JedoCodesSettingsHubBundle;

class SettingsHubClass extends BackendModule
{
	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'be_settings_hub';

	/**
	 * Generate the module
	 *
	 * @throws \Exception
	 */
	protected function compile()
	{
        $this->import(BackendUser::class, 'User');

		System::loadLanguageFile('tl_settings_hub');

        $this->Template->content = '';
		$this->Template->href = $this->getReferer(true);
		$this->Template->title = StringUtil::specialchars($GLOBALS['TL_LANG']['MSC']['backBTTitle'] ?? '');
		$this->Template->button = $GLOBALS['TL_LANG']['MSC']['backBT'] ?? null;

        //$this->Template->headline = $GLOBALS['TL_LANG']['tl_settings_hub']['title'] ?? null;
        $this->Template->version = $GLOBALS['TL_LANG']['MSC']['version'] . ': ' . JedoCodesSettingsHubBundle::VERSION;
        $this->Template->description = sprintf($GLOBALS['TL_LANG']['MSC']['settings_hub_description'] ?? '', '<a href="https://jedo.codes/" target="_blank">' . ($GLOBALS['TL_LANG']['MSC']['settings_hub_company'] ?? null) . '</a>');

        $groups = array();

        foreach ($GLOBALS['JEDOCODES_SETUPMODS'] as $group => $modules)
        {
            $gp = array(
                'alias'   => $group,
                'group'   => ($GLOBALS['TL_LANG']['tl_settings_hub'][ 'group_' . $group ] ?? ''),
                'modules' => array()
            );

            foreach ($modules as $module)
            {
                if($module === 'addon_catalog')
                {
                    $link = 'https://jedo.codes/solutions';
                }
                elseif($module === 'addon_issues') {
                    $link = 'https://github.com/jedoCodes?tab=repositories';
                }
                elseif ($module === 'addon_documentations') {
                     $link = 'https://docs.jedo.codes/';
                }
                elseif ($module === 'addon_support') {
                    $link = 'https://jedo.codes/support.html';
                }
                else
                {
                    $link = 'contao?do=' . $module;
                }

                $gp['modules'][] = array(
                    'title' => ($GLOBALS['TL_LANG']['tl_settings_hub'][ $module ][0] ?? ''),
                    'desc'  => ($GLOBALS['TL_LANG']['tl_settings_hub'][ $module ][1] ?? ''),
                    'link'  => $link,
                    'denied' => !$this->User->hasAccess($module, 'modules')
                );
            }

            $groups[] = $gp;
        }

		$this->Template->groups = $groups;
	}
}
