<?php

declare(strict_types=1);

namespace InfoBase\FAQ\Model\ResourceModel\Faq;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use InfoBase\FAQ\Model\Faq as Model;
use InfoBase\FAQ\Model\ResourceModel\Faq as ResourceModel;

/**
* Class Collection
* @package InfoBase\FAQ\Model\ResourceModel\Faq
*/
class Collection extends AbstractCollection
{
    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}