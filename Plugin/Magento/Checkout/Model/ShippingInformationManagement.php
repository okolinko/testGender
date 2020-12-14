<?php

namespace Hunters\GenderToppik\Plugin\Magento\Checkout\Model;

use Magento\Quote\Model\QuoteRepository;
use Magento\Checkout\Model\ShippingInformationManagement as Subject;
use Magento\Checkout\Api\Data\ShippingInformationInterface;

/**
 * Class ShippingInformationManagement
 * @package Hunters\GenderToppik\Plugin\Magento\Checkout\Model
 */
class ShippingInformationManagement
{
    /**
     * @var QuoteRepository
     */
    protected $_quoteRepository;

    /**
     * ShippingInformationManagement constructor.
     * @param QuoteRepository $quoteRepository
     */
    public function __construct(
        QuoteRepository $quoteRepository
    )
    {
        $this->_quoteRepository = $quoteRepository;
    }

    /**
     * @param Subject                      $subject
     * @param                              $cartId
     * @param ShippingInformationInterface $addressInformation
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function beforeSaveAddressInformation(
        Subject $subject,
        $cartId,
        ShippingInformationInterface $addressInformation
    ) {
        $extensionAttribute = $addressInformation->getShippingAddress()->getExtensionAttributes();
        $genderToppik = $extensionAttribute->getGenderToppik();
        $quote = $this->_quoteRepository->getActive($cartId);
        $quote->setGenderToppik($genderToppik);
    }

}
