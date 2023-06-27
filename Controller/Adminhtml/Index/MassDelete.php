<?php

declare(strict_types=1);

namespace InfoBase\FAQ\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use InfoBase\FAQ\Model\ResourceModel\Faq as Resource;
use Magento\Ui\Component\MassAction\Filter as MassActionFilter;
use InfoBase\FAQ\Model\ResourceModel\Faq\CollectionFactory;

/**
* Class MassDelete
* @package InfoBase\FAQ\Controller\Adminhtml\Index
*/
class MassDelete extends Action
{

    const ADMIN_RESOURCE = 'InfoBase_FAQ::manage';
    
    /**
     * @var Resource
     */
    protected $resource;

    /** 
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /** 
     * @var MassActionFilter
     */
    protected $filter;

    /**
     * Constructor
     *
     * @param Context $context
     * @param Resource $resource
     * @param CollectionFactory $collectionFactory
     * @param MassActionFilter $filter
     */
    public function __construct(
        Context $context,
        Resource $resource,
        CollectionFactory $collectionFactory, 
        MassActionFilter $filter
    ) {
        $this->resource = $resource;
        $this->collectionFactory = $collectionFactory;
        $this->filter = $filter;

        return parent::__construct($context);
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $collectionSize = $collection->getSize();

        foreach ($collection as $model) {
            $this->resource->delete($model);
        }

        $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $collectionSize));

        return $this->_redirect('*/*/index');
    }
}
