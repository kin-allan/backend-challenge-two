<?php

declare(strict_types=1);

namespace InfoBase\FAQ\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use InfoBase\FAQ\Model\ResourceModel\Faq as Resource;
use InfoBase\FAQ\Model\FaqFactory;

/**
* Class Delete
* @package InfoBase\FAQ\Controller\Adminhtml\Question
*/
class Delete extends Action
{

    const ADMIN_RESOURCE = 'InfoBase_FAQ::manage';
    
    /**
     * @var Resource
     */
    protected $resource;

    /** 
     * @var FaqFactory
     */
    protected $modelFactory;

    /**
     * Constructor
     *
     * @param Context $context
     * @param Resource $resource
     * @param FaqFactory $modelFactory
     */
    public function __construct(
        Context $context,
        Resource $resource,
        FaqFactory $modelFactory
    ) {
        $this->resource = $resource;
        $this->modelFactory = $modelFactory;

        return parent::__construct($context);
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        if ($id) {
            if ($this->resource->delete($this->modelFactory->create()->load($id))) {
                $this->messageManager->addSuccess(__('Question deleted'));
            } else {
                $this->messageManager->addError(__('Unable to delete question'));
            }
        }

        return $this->_redirect('faq/index/index');
    }
}
