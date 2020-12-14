<?php

namespace Hunters\GenderToppik\Model\ResourceModel\Order\Grid;

use Toppik\Adminhtml\Model\ResourceModel\Order\Grid\Collection as OrderCollection;

/**
 * Class Collection
 * @package Hunters\GenderToppik\Model\ResourceModel\Order\Grid
 */
class Collection extends OrderCollection
{
    /**
     * @return Collection|OrderCollection|void
     */
    public function _initSelect()
    {

        $this->getSelect()
            ->joinLeft(
                ['kek' => 'sales_order'],
                "(main_table.entity_id = kek.entity_id)",
                [
                    'kek.gender_toppik as gender_toppik'
                ]
            );
        parent::_initSelect();

    }
}
