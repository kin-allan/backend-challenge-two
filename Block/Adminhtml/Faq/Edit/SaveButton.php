<?php

declare(strict_types=1);

namespace InfoBase\FAQ\Block\Adminhtml\Faq\Edit;

use InfoBase\FAQ\Block\Adminhtml\Faq\Edit\BaseButton;

/**
* Class SaveButton
* @package InfoBase\FAQ\Block\Adminhtml\Faq\Edit
*/
class SaveButton extends BaseButton 
{
    /**
     * @inheritDoc
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save'
            ],
            'sort_order' => 90
        ];
    }
}