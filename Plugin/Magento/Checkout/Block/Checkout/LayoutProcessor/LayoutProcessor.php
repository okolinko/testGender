<?php
namespace Hunters\GenderToppik\Plugin\Magento\Checkout\Block\Checkout\LayoutProcessor;

class LayoutProcessor {

	/**
	 * @var \Hunters\GenderToppik\Model\Filter\AvailableCountries
	 */
	private $availableCountries;

	public function __construct(
		\Hunters\GenderToppik\Model\Filter\AvailableCountries $availableCountries
	) {
		$this->availableCountries = $availableCountries;
	}

	/**
	 * @param \Magento\Checkout\Block\Checkout\LayoutProcessor $subject
	 * @param array $result
	 * @return array
	 */
	public function afterProcess(\Magento\Checkout\Block\Checkout\LayoutProcessor $subject, $result) {
		$customAttributeCode = 'gender_toppik';
		$customField = [
			'component' => 'Magento_Ui/js/form/element/abstract',
			'config' => [
				'customScope' => 'shippingAddress',
				'customEntry' => null,
				'template' => 'ui/form/field',
				'additionalClasses' => $customAttributeCode,
				'elementTmpl' => 'ui/form/element/checkbox-set',
				'id' => $customAttributeCode
			],
			'dataScope' => 'shippingAddress.' . $customAttributeCode,
			'label' => 'WHO WILL BE USING THE PRODUCT? (OPTIONAL)',
			'provider' => 'checkoutProvider',
			'sortOrder' => 10,
			'visible' => true,
			'validation' => ['required-entry' => false],
			'filterBy' => null,
			'customEntry' => null,
			'id' => $customAttributeCode,
			'options' =>[
				[
					'value' => 'male',
					'label' => 'Male',
				],
				[
					'value' => 'female',
					'label' => 'Female',
				]

			]

		];
		$result['components']['checkout']['children']['steps']['children']
		['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']
		['children'][$customAttributeCode] = $customField;

		return $result;
	}

}
