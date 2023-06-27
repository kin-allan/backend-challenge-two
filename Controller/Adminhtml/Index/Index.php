<?php

declare(strict_types=1);

namespace InfoBase\FAQ\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
* Class Index
* @package InfoBase\FAQ\Controller\Adminhtml\Index
*/
class Index extends Action
{
    const ADMIN_RESOURCE = 'InfoBase_FAQ::grid';

    /** 
     *
     * @var PageFactory
     */
    protected $pageResultFactory;

    /**
     * Constructor.
     *
     * @param Context $context
     * @param PageFactory $pageResultFactory
     */
    public function __construct(
        Context $context,
        PageFactory $pageResultFactory
    ) {
        $this->pageResultFactory = $pageResultFactory;

        parent::__construct($context);
    }

    /**
     * Render faq grid
     *
     * @return mixed
     */
    public function execute() 
    {
        return $this->pageResultFactory
            ->create()
            ->setActiveMenu('InfoBase_FAQ::list');    
    }
}