<?php
/**
 * Twig Extras plugin for Craft CMS
 *
 * Twig Extras Twig Extension
 *
 * --snip--
 * Twig can be extended in many ways; you can add extra tags, filters, tests, operators, global variables, and
 * functions. You can even extend the parser itself with node visitors.
 *
 * http://twig.sensiolabs.org/doc/advanced.html
 * --snip--
 *
 * @author    Dries Hooghe
 * @copyright Copyright (c) 2018 Dries Hooghe
 * @link      https://github.com/drieshooghe
 * @package   CraftTwigExtras
 * @since     1.0.0
 */

namespace Craft;

use Twig_Extension;
use Twig_Filter_Method;

class TwigExtrasTwigExtension extends \Twig_Extension
{
	/**
	 * @return string The extension name
	 */
	public function getName()
	{
		return 'DasCraftFilters';
	}

	/**
	 * @return array
	 */
	public function getFilters()
	{
		$returnArray = array();
		$methods = array(
			'phoneLink',
			'mediaLink',
			'mediaLinkCheck'
		);
		foreach ($methods as $methodName) {
			$returnArray[$methodName] = new \Twig_SimpleFilter($methodName, array($this, $methodName));
		}

		return $returnArray;
	}

	/**
	 * @param $number
	 *
	 * @return string
	 */
	public function phoneLink($number)
	{
		return craft()->twigExtras_credentialLinks->formatPhoneNumber($number);
	}

	/**
	 * @param $url
	 *
	 * @return string
	 */
	public function mediaLink($url, $platform)
	{
		return craft()->twigExtras_mediaLinks->getEmbeddedLink($url, $platform);
	}

}
