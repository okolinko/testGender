<?php

namespace Hunters\GenderToppik\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

/**
 * Class InstallSchema
 * @package Hunters\GenderToppik\Setup
 */
class InstallSchema implements InstallSchemaInterface
{

    const COLUMN_GENDER_TOPPIK    =   'gender_toppik';
    const SALES_ORDER_TABLE         =   'sales_order';
    const QUOTE_TABLE               =   'quote';

    /**
     * @param SchemaSetupInterface   $setup
     * @param ModuleContextInterface $context
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup->startSetup();

        $installer->getConnection()->addColumn(
          $installer->getTable(self::QUOTE_TABLE),
          self::COLUMN_GENDER_TOPPIK,
          [
              'type'        =>  Table::TYPE_TEXT,
			  'length' => 255,
			  'nullable' => true,
			  'default' => 'prefer not to say',
              'comment'     =>  'Gender Toppik'
          ]
        );

        $installer->getConnection()->addColumn(
            $installer->getTable(self::SALES_ORDER_TABLE),
            self::COLUMN_GENDER_TOPPIK,
            [
                'type'      =>  Table::TYPE_TEXT,
				'length' => 255,
				'nullable' => true,
				'default' => 'prefer not to say',
                'comment'   =>  'Gender Toppik'
            ]
        );

        $setup->endSetup();
    }
}
