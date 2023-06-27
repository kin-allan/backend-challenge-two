<?php

declare(strict_types=1);

namespace InfoBase\FAQ\Block\Adminhtml\Faq\Edit;

use Magento\Backend\Block\Widget\Context;
use InfoBase\FAQ\Model\FaqFactory;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
* Class BaseButton
* @package InfoBase\FAQ\Block\Adminhtml\Faq\Edit
*/
class BaseButton implements ButtonProviderInterface
{
/**
     * @var Context
     */
    protected $context;

    /**
     * @var FaqFactory
     */
    protected $faqFactory;

    /**
     * Constructor.
     * @param Context $context
     * @param FaqFactory $faqFactory
     */
    public function __construct(
        Context $context,
        FaqFactory $faqFactory
    ) {
        $this->context = $context;
        $this->faqFactory = $faqFactory;
    }

    /**
     * Return Faq ID
     *
     * @return int|null
     */
    public function getFaqId(): ?int
    {
        try {
            return (int) $this->faqFactory->create()->load(
                $this->context->getRequest()->getParam('id')
            )->getId();
        } catch (NoSuchEntityException $e) {
            return null;
        }

        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }

    /**
     * To be implemented
     *
     * @return array
     */
    public function getButtonData()
    {
        return [];
    }
}