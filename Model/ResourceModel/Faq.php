<?php

declare(strict_types=1);

namespace InfoBase\FAQ\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use InfoBase\FAQ\Api\Data\FaqInterface;

/**
* Class Faq
* @package InfoBase\FAQ\Model\ResourceModel
*/
class Faq extends AbstractDb
{
    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(FaqInterface::TABLE_NAME, FaqInterface::ID);
    }

    /**
     * Get stores this FAQ belongs
     *
     * @param int $faqId
     * @return array
     */
    public function getLinkedStoreIds($faqId): array 
    {
        if (!$faqId) {
            return [];
        }

        $linkTableName = $this->getTable('infobase_faq_store');        

        $queryLinks = $this->getConnection()->select()->from($linkTableName, ['store_id'])->where('faq_id = :faq_id');

        $storeLinks = $this->getConnection()->fetchCol($queryLinks, [ ':faq_id' => $faqId ]);

        return $storeLinks;
    }
}