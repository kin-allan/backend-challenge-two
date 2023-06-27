<?php 

declare(strict_types=1);

namespace InfoBase\FAQ\Ui\Component\Faq;

use Magento\Ui\DataProvider\AbstractDataProvider;
use InfoBase\FAQ\Model\ResourceModel\Faq\CollectionFactory as CollectionFactory;

/**
 * Class DataProvider
 * @package InfoBase\FAQ\Ui\Faq
 */
class DataProvider extends AbstractDataProvider
{
    /**
     * @var CollectionFactory
     */
    protected $collection;

    /**
    * @var array|null
    */
    protected $loadedData;

    /**
     * Constructor.
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();

        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $meta,
            $data
        );
    }

    /**
     * @inheritDoc
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $questions = $this->collection->getItems();

        foreach ($questions as $question) {
            $data = $question->getData();
            $data['id'] = $question->getId();
            $data['store_id'] = $question->getLinkedStores();
            $this->loadedData[$question->getId()] = $data;
        }

        return $this->loadedData;
    }
}
