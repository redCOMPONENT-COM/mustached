<?php
/**
 * @package     mustached
 * @subpackage  Step Class
 * @copyright   Copyright (C) 2014 mustached.org All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace AcceptanceTester;
/**
 * Class InstallExtensionJoomla2Steps
 *
 * @package  AcceptanceTester
 *
 * @since    1.4
 *
 * @link     http://codeception.com/docs/07-AdvancedUsage#StepObjects
 */
class InstallExtensionJoomla2Steps extends \AcceptanceTester
{
	/**
	 * Function to Install RedShop1, inside Joomla 2.5
	 *
	 * @return void
	 */
	public function installExtension()
	{
		$I = $this;
		$this->acceptanceTester = $I;
		$I->amOnPage(\ExtensionManagerPage::$URL);
		$config = $I->getConfig();
		$I->wantTo('Install redCORE framework before installing the extension');
		$I->fillField(\ExtensionManagerPage::$extensionDirectoryPath, $config['folder'] . $config['redcore_folder']);
		$I->click(\ExtensionManagerPage::$installButton);
		$I->waitForText('Installing component was successful.');

		$I->wantTo('Install the extension');
		$I->amOnPage(\ExtensionManagerPage::$URL);
		$I->fillField(\ExtensionManagerPage::$extensionDirectoryPath, $config['folder']);
		$I->click(\ExtensionManagerPage::$installButton);
		$I->waitForText(\ExtensionManagerPage::$installSuccessMessage, 60);
	}

	/**
	 * Function to Install Demo Data for the Extension
	 *
	 * @return void
	 */
	public function installSampleData()
	{
		$I = $this;
		$config = $I->getConfig();

		if ($config['install_extension_demo_data'] == 'yes')
		{
			$I->click(\ExtensionManagerPage::$installDemoContent);
			$I->waitForText(\ExtensionManagerPage::$demoDataInstallSuccessMessage, 30);
		}
	}
}
