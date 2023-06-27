<?php

declare(strict_types=1);

namespace InfoBase\FAQ\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use InfoBase\FAQ\Model\Configs;

/**
* Class Index
* @package InfoBase\FAQ\Controller\Index
*/
class Index extends Action
{

    /** 
     * @var Configs
     */
    protected $configs;

    /**
     *
     * @var PageFactory
     */
    protected $pageFactory;

    /**
     * Constructor
     *
     * @param Context $context
     * @param Configs $configs
     * @param PageFactory $pageFactory
     */
    public function __construct(
        Context $context, 
        Configs $configs,
        PageFactory $pageFactory
    ) {
        $this->configs = $configs;
        $this->pageFactory = $pageFactory;

        parent::__construct($context);
    }

    /**
    * @inheritDoc
    */
    public function execute()
    {
        if (!$this->configs->isEnabled()) {
            $this->_redirect('/');
        }
        
        $result = $this->pageFactory->create();
        $result->getConfig()->getTitle()->set(__('FAQ'));

        return $result;
    }
}
