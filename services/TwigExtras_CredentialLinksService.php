<?php

namespace Craft;

class TwigExtras_CredentialLinksService extends BaseApplicationComponent{

	/**
	 * @param $number
	 *
	 * @return string
	 */
	public function formatPhoneNumber($number)
	{
		$formattedString = preg_replace('/\(.*\)/', '', $number);
		$formattedString = preg_replace('/[^0-9+]/', '', $formattedString);

		return $formattedString;
	}


}
