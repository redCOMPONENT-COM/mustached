<?php
/**
 * @package     mustached
 * @subpackage  Step Class
 * @copyright   Copyright (C) 2014 mustached.org All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace AcceptanceTester;

/**
 * Class InstallExtensionJoomla3Steps
 *
 * @package  AcceptanceTester
 *
 * @since    2.1
 *
 * @link     http://codeception.com/docs/07-AdvancedUsage#StepObjects
 */
class InstallExtensionJoomla3Steps extends \AcceptanceTester
{
	/**
	 * Function to Install redMember2, inside Joomla 3
	 *
	 * @return void
	 */
	public function installExtension()
	{
		$I = $this;
		$this->acceptanceTester = $I;
		$I->wantTo('install Extension');
		$I->amOnPage(\ExtensionManagerPage::$URL);
		$config = $I->getConfig();
		$I->click('Install from Directory');
		$I->fillField(\ExtensionManagerPage::$extensionDirectoryPath, $config['folder']);
		$I->click(\ExtensionManagerPage::$installButton);
		$I->waitForText('Installing component was successful');  //This text Should be moved to Page Object for Extension Manager
		$I->see(\ExtensionManagerPage::$installSuccessMessage);
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
