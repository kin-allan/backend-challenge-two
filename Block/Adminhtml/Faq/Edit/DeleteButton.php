<?php

declare(strict_types=1);

namespace InfoBase\FAQ\Block\Adminhtml\Faq\Edit;

use InfoBase\FAQ\Block\Adminhtml\Faq\Edit\BaseButton;

/**
* Class DeleteButton
* @package InfoBase\FAQ\Block\Adminhtml\Faq\Edit
*/
class DeleteButton extends BaseButton 
{
     /**
     * @inheritDoc
     */
    public function getButtonData()
    {
        $data = [];

        if ($this->getFaqId()) {
            $data = [
                'label' => __('Delete question'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                    'Are you sure you want to do this?'
                ) . '\', \'' . $this->getDeleteUrl() . '\', {"data": {}})',
                'sort_order' => 20
            ];
        }

        return $data;
    }

    /**
     * Url to send delete requests to.
     *
     * @return string
     */
    private function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', ['id' => $this->getFaqId()]);
    }
}