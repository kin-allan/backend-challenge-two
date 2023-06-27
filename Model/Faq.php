<?php

declare(strict_types=1);

namespace InfoBase\FAQ\Model;

use Magento\Framework\Model\AbstractModel;
use InfoBase\FAQ\Model\ResourceModel\Faq as ResourceModel;
use InfoBase\FAQ\Api\Data\FaqInterface;

/**
* Class Faq
* @package InfoBase\FAQ\Model
*/
class Faq extends AbstractModel implements FaqInterface
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'infobase_faq';

    /**
     * @var string
     */
    protected $_eventObject = 'faq';

    /**
     * @inheritDoc 
     */
    public function _construct() 
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * @inheritDoc
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * @inheritDoc
     */
    public function getQuestion()
    {
        return $this->getData(self::QUESTION);
    }

    /**
     * @inheritDoc
     */
    public function getAnswer()
    {
        return $this->getData(self::ANSWER);
    }

    /**
     * @inheritDoc
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setId($id)
    {
        $this->setData(self::ID, $id);

        return $this;
    }

     /**
     * @inheritDoc
     */
    public function setStatus($status)
    {
        $this->setData(self::STATUS, $status);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setQuestion(string $question)
    {
        $this->setData(self::QUESTION, $question);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setAnswer(string $answer)
    {
        $this->setData(self::ANSWER, $answer);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setCreatedAt(string $createdAt)
    {
        $this->setData(self::CREATED_AT, $createdAt);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setUpdatedAt(string $updatedAt)
    {
        $this->setData(self::UPDATED_AT, $updatedAt);

        return $this;
    }

    /**
     * Get stores this FAQ belongs
     *
     * @return array
     */
    public function getLinkedStores(): array 
    {
        if (!$this->getId()) {
            return [];
        }

        return $this->getResource()->getLinkedStoreIds((int) $this->getId());
    }
}