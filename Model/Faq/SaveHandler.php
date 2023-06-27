<?php

declare(strict_types=1);

namespace InfoBase\FAQ\Model\Faq;

use InfoBase\FAQ\Api\Data\FaqInterface;
use Magento\Framework\App\ResourceConnection;

/**
* Class SaveHandler
* @package InfoBase\FAQ\Model\Faq
*/
class SaveHandler
{
    /**
     * @var ResourceConnection
     */
    protected $resourceConnection;

    public function __construct(ResourceConnection $resourceConnection)
    {
        $this->resourceConnection = $resourceConnection;
    }

    /**
     * Perform the link between FAQ and Store Views
     *
     * @param FaqInterface $faq
     * @param array $newStoreLinks
     * @return null|FaqInterface
     */
    public function linkStoreIds(FaqInterface $faq, array $newStoreLinks)
    {
        if ($faq && $faq->getId()) {
            $con = $this->resourceConnection->getConnection();
            $tableName = $this->resourceConnection->getTableName('infobase_faq_store');
            $queryCurrentLinks = $con->select()
                ->from($tableName)
                ->where('faq_id = :faq_id');

            $currentLinks = $con->fetchAll($queryCurrentLinks, [ ':faq_id' => $faq->getId() ]);
            
            $currentStoreLinks = [];

            foreach ($currentLinks as $currentLink) {
                $currentStoreLinks[] = $currentLink['store_id'];
            }

            $storeLinksToDelete = array_diff($currentStoreLinks, $newStoreLinks);

            if ($storeLinksToDelete) {
                $con->delete($tableName, [
                    'faq_id  = ?' => (int) $faq->getId(),
                    'store_id IN (?)' => $storeLinksToDelete
                ]);
            }

            $storeLinksToInsert = array_diff($newStoreLinks, $currentStoreLinks);

            if ($storeLinksToInsert) {
                $data = [];
                foreach ($storeLinksToInsert as $storeId) {
                    $data[] = [
                        'faq_id' => (int) $faq->getId(),
                        'store_id' => (int) $storeId
                    ];
                }
                $con->insertMultiple($tableName, $data);
            }
        }

        return $faq;
    }
}