<?php

namespace Hunters\GenderToppik\Model\Filter;

use Magento\Shipping\Model\Config;
use Magento\Directory\Model\Config\Source\Country;

class AvailableCountries
{

	/**
	 * @var Config
	 */
	private $shippingConfig;
	/**
	 * @var Country
	 */
	private $country;
	/**
	 * @var array
	 */
	private $availableCountries;

	public function __construct(
		Country $country,
		Config $shippingConfig
	)
	{
		$this->shippingConfig = $shippingConfig;
		$this->country = $country;
		$allCountries = [];
		foreach($this->country->toOptionArray() as $country) {
			if($country['value']) {
				$allCountries[] = $country['value'];
			}
		}
		$availableMethods = $this->shippingConfig->getActiveCarriers();
		$this->availableCountries = [];
		if(! empty($availableMethods)) {
			foreach($availableMethods as $availableMethod) {
				/* @var \Magento\Shipping\Model\Carrier\AbstractCarrier $availableMethod */
				$countries = [];
				$speCountriesAllow = $availableMethod->getConfigData('sallowspecific');
				if ($speCountriesAllow && $speCountriesAllow == 1) {
					if ($availableMethod->getConfigData('specificcountry')) {
						$countries = explode(',', $availableMethod->getConfigData('specificcountry'));
					}
				} else {
					$countries = $allCountries;
				}
				$this->availableCountries = array_unique(
					array_merge($this->availableCountries, $countries)
				);
			}
		}
	}

	public function getIds() {
		return $this->availableCountries;
	}

	public function isAllowedCountry($country) {
		if(is_array($country) && isset($country['value'])) {
			$country = $country['value'];
		}
		if(! is_string($country) || empty($country)) {
			return true;
		}
		return in_array($country, $this->availableCountries);
	}

	public function filterOptionArray(& $options) {
		$options = array_filter($options, [$this, 'isAllowedCountry']);
	}

}
