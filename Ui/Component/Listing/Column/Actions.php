<?php

declare(strict_types=1);

namespace InfoBase\FAQ\Ui\Component\Listing\Column;

use Magento\Backend\Model\UrlInterface as UrlBuilder;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

/**
* Class Actions
* @package InfoBase\FAQ\Ui\Component\Listing\Column
*/
class Actions extends Column
{
    public const URL_EDIT = 'faq/question/edit';
    public const URL_DELETE = 'faq/question/delete';

    /**
     * @var UrlBuilder
     */
    protected $urlBuilder;

    /**
     * Constructor.
     * @param ContextInterface   $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlBuilder         $urlBuilder
     * @param array              $components
     * @param array              $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlBuilder $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * @inheritDoc
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $name = $this->getData('name');
                if (isset($item['entity_id'])) {
                    $item[$name]['edit'] = [
                        'href' => $this->urlBuilder->getUrl(self::URL_EDIT, ['id' => $item['entity_id']]),
                        'label' => __('Edit'),
                    ];

                    $item[$name]['delete'] = [
                        'href' => $this->urlBuilder->getUrl(self::URL_DELETE, ['id' => $item['entity_id']]),
                        'label' => __('Delete'),
                        'confirm' => [
                            'title' => __('Delete question'),
                            'message' => __('Are you sure you want to delete?'),
                        ],
                        'post' => true,
                    ];
                }                
            }
        }

        return $dataSource;
    }
}