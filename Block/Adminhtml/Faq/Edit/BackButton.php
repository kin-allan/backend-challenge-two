<?php

declare(strict_types=1);

namespace InfoBase\FAQ\Block\Adminhtml\Faq\Edit;

use InfoBase\FAQ\Block\Adminhtml\Faq\Edit\BaseButton;

/**
* Class BackButton
* @package InfoBase\FAQ\Block\Adminhtml\Faq\Edit
*/
class BackButton extends BaseButton 
{
     /**
     * @inheritDoc
     */
    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getUrl('*/index/')),
            'class' => 'back',
            'sort_order' => 10
        ];
    }
}