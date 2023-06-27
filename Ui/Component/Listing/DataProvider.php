<?php

declare(strict_types=1);

namespace InfoBase\FAQ\Ui\Component\Listing;

use Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider as BaseDataProvider;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\ReportingInterface;
use Magento\Framework\Api\Search\SearchCriteria;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\App\RequestInterface;
use InfoBase\FAQ\Model\ResourceModel\Faq as FaqResource;

/**
* Class DataProvider
* @package InfoBase\FAQ\Ui\Component\Listing
*/
class DataProvider extends BaseDataProvider
{
    /**
     * Constructor.
     *
     * @param null|string $name
     * @param null|string $primaryFieldName
     * @param null|string $requestFieldName
     * @param ReportingInterface $reporting
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param RequestInterface $request
     * @param FilterBuilder $filterBuilder
     * @param FaqResource $faqResource
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        ReportingInterface $reporting,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        RequestInterface $request,
        FilterBuilder $filterBuilder,
        FaqResource $faqResource,
        array $meta = [],
        array $data = []
    ) {
        $this->faqResource = $faqResource;

        return parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $reporting,
            $searchCriteriaBuilder,
            $request,
            $filterBuilder,
            $meta,
            $data
        );
    }

    protected function searchResultToOutput(SearchResultInterface $searchResult)
    {
        $arrItems = [];

        $arrItems['items'] = [];
        foreach ($searchResult->getItems() as $item) {
            $itemData = [];
            foreach ($item->getCustomAttributes() as $attribute) {
                $itemData[$attribute->getAttributeCode()] = $attribute->getValue();
            }
            $itemData['store_id'] = $this->faqResource->getLinkedStoreIds($itemData['entity_id']);
            $arrItems['items'][] = $itemData;
        }

        $arrItems['totalRecords'] = $searchResult->getTotalCount();

        return $arrItems;
    }
}