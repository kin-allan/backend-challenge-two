<?php

declare(strict_types=1);

namespace InfoBase\FAQ\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;
use InfoBase\FAQ\Api\Data\FaqInterface;

/**
* Class Status
* @package InfoBase\FAQ\Model\Config\Source
*/
class Status implements ArrayInterface
{
/**
     * {@inheritdoc}
     */
    public function toOptionArray()
    {
        return [
            ['value' => FaqInterface::STATUS_DISABLED, 'label' => __('Disabled')],
            ['value' => FaqInterface::STATUS_ENABLED, 'label' => __('Enabled')],
        ];
    }
}