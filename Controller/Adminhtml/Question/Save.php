<?php

declare(strict_types=1);

namespace InfoBase\FAQ\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use InfoBase\FAQ\Model\ResourceModel\Faq as Resource;
use InfoBase\FAQ\Model\FaqFactory;
use InfoBase\FAQ\Model\Faq\SaveHandler;

/**
* Class Save
* @package InfoBase\FAQ\Controller\Adminhtml\Question
*/
class Save extends Action implements HttpPostActionInterface
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
     * @var SaveHandler
     */
    protected $saveHandler;

    /**
     * Constructor
     *
     * @param Context $context
     * @param Resource $resource
     * @param FaqFactory $modelFactory
     * @param SaveHandler $saveHandler
     */
    public function __construct(
        Context $context,
        Resource $resource,
        FaqFactory $modelFactory, 
        SaveHandler $saveHandler
    ) {
        $this->resource = $resource;
        $this->modelFactory = $modelFactory;
        $this->saveHandler = $saveHandler;

        return parent::__construct($context);
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('entity_id');
        $params = $this->getRequest()->getParams();
        $model = $this->modelFactory->create();

        if ($id && $id > 0) {
            $model->load($id);
            $model->setData($params);
        } else {
            $model->setData($params);
            $model->setData('entity_id', null);
        }

        if ($this->resource->save($model)) {
            $this->saveHandler->linkStoreIds($model, $this->getRequest()->getParam('store_id', [0]));
            $this->messageManager->addSuccess(__('Question saved'));
            return $this->_redirect('*/question/edit', ['id' => $model->getId() ]);
        } else {
            $this->messageManager->addError(__('Unable to save question'));
        }

        return $this->_redirect('*/*/index');
    }
}
