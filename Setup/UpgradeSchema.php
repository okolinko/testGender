<?php

namespace Hunters\GenderToppik\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class UpgradeSchema implements UpgradeSchemaInterface
{
	/**
	 * @param SchemaSetupInterface   $setup
	 * @param ModuleContextInterface $context
	 */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if(version_compare($context->getVersion(), '0.0.2') < 0) {

            $installer = $setup->startSetup();
			$installer->getConnection()->changeColumn(
				$installer->getTable('sales_order'),
				'gender_toppik',
				'custom_gender',
				[
					'type' => Table::TYPE_TEXT,
					'length' => 255,
				]
			);

			$installer->getConnection()->changeColumn(
				$installer->getTable('quote'),
				'gender_toppik',
				'custom_gender',
				[
					'type' => Table::TYPE_TEXT,
					'length' => 255,
				]
			);
        }
        $setup->endSetup();
    }
}