<?php

declare(strict_types=1);

namespace InfoBase\FAQ\Block\Faq;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Store\Model\StoreManagerInterface;
use InfoBase\FAQ\Api\Data\FaqInterface;
use InfoBase\FAQ\Model\ResourceModel\Faq\Collection;
use InfoBase\FAQ\Model\ResourceModel\Faq\CollectionFactory;
use InfoBase\FAQ\Model\Configs;
use function json_encode;

/**
* Class FaqList
* @package InfoBase\FAQ\Block\Faq
*/
class FaqList extends Template
{
    /** 
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /** 
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /** 
     * @var Configs
     */
    protected $configs;

    private $collection;

    /**
     * Constructor.
     *
     * @param Context $context
     * @param CollectionFactory $collectionFactory
     * @param StoreManagerInterface $storeManager
     * @param Configs $configs
     * @param array $data
     */
    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory,
        StoreManagerInterface $storeManager,
        Configs $configs,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->storeManager = $storeManager;
        $this->configs = $configs;

        parent::__construct($context, $data);
    }

    /**
     * Check if can render the block
     *
     * @return bool
     */
    public function canRender(): bool 
    {
        return $this->configs->isEnabled();
    }

    /**
     * Load FAQ collection
     *
     * @return Collection
     */
    public function getCollection(): Collection
    {
        if (null === $this->collection) {
            $this->collection = $this->collectionFactory->create()
            ->join('infobase_faq_store', 'entity_id = faq_id', ['store_id'])
            ->addFieldToFilter('status', FaqInterface::STATUS_ENABLED)
            ->addFieldToFilter('store_id', ['in' => ['0', $this->storeManager->getStore()->getId()]]);
        }

        return $this->collection;
    }

    /**
     * Get collection size
     *
     * @return int
     */
    public function getSize(): int 
    {
        return $this->getCollection()->getSize();
    }

    /**
     * Get FAQ list
     *
     * @return array
     */
    public function getList(): array 
    {        
        return $this->getSize() > 0 ? $this->collection->getItems(): [];
    }

    /**
     * Get FAQ list in json format
     *
     * @return string
     */
    public function getJsonList(): string 
    {
        $data = [];

        foreach ($this->getList() as $item) {
            $data[] = [
                'id' => $item->getId(),
                'title' => $item->getQuestion(),
                'answer' => $item->getAnswer()
            ];
        };

        return json_encode($data);
    }
}