<?php

namespace Hunters\GenderToppik\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\DataObject\Copy;

/**
 * Class SaveOrderBeforeSalesModelQuoteObserver
 * @package Hunters\GenderToppik\Observer
 */
class SaveOrderBeforeSalesModelQuoteObserver implements ObserverInterface
{
    /**
     * @var Copy
     */
    protected $objectCopyService;

    /**
     * SaveOrderBeforeSalesModelQuoteObserver constructor.
     * @param Copy $objectCopyService
     */
    public function __construct(
        Copy $objectCopyService
    )
    {
        $this->objectCopyService = $objectCopyService;
    }

    /**
     * @param Observer $observer
     * @return $this|void
     */
    public function execute(Observer $observer)
    {
        $order  =   $observer->getEvent()->getData('order');
        $quote  =   $observer->getEvent()->getData('quote');

        $this->objectCopyService->copyFieldsetToTarget('sales_convert_quote', 'to_order', $quote, $order);

        return $this;
    }
}
