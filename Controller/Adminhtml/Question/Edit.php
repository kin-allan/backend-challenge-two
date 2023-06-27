<?php

declare(strict_types=1);

namespace InfoBase\FAQ\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;
use InfoBase\FAQ\Model\ResourceModel\Faq as Resource;
use InfoBase\FAQ\Model\FaqFactory;

/**
* Class Edit
* @package InfoBase\FAQ\Controller\Adminhtml\Question
*/
class Edit extends Action
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
     * @var Registry
     */
    protected $registry;

    /** 
     * @var PageFactory
     */
    protected $pageFactory;

    /**
     * Constructor
     *
     * @param Context $context
     * @param Resource $resource
     * @param FaqFactory $modelFactory
     * @param Registry $registry
     * @param PageFactory $PageFactory
     */
    public function __construct(
        Context $context,
        Resource $resource,
        FaqFactory $modelFactory,
        Registry $registry,
        PageFactory $pageFactory
    ) {
        $this->resource = $resource;
        $this->modelFactory = $modelFactory;
        $this->registry = $registry;
        $this->pageFactory = $pageFactory;

        return parent::__construct($context);
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        try {
            $id = $this->getRequest()->getParam('id');
            $model = $this->modelFactory->create()->load($id);          
            $this->registry->register('infobase_faq_question', $model);
            $resultPage = $this->pageFactory->create();

            return $resultPage;

        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('Question not found.'));
        }

        return $this->_redirect('*/*/');
    }
}
