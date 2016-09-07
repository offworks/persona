<?php
namespace Persona\Wizard;

class Wizard extends \Exedra\Wizard\Wizardry
{
	/**
	 * @description initiate install sequence
	 */
	public function executeInstall($opts)
	{
		// migrate up
		$this->manager->command('model:migrate');

		$setting = \Persona\Entity\Settings::first();

		if($setting)
		{
			$this->say('Persona already installed.');
			$this->say();
			exit;
		}

		$setting = new \Persona\Entity\Settings;
		$setting->save();
	}
}