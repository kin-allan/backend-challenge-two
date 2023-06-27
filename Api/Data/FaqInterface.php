<?php

declare(strict_types=1);

namespace InfoBase\FAQ\Api\Data;

/**
* Interface FaqInterface
* @package InfoBase\FAQ\Api\Data
*/
interface FaqInterface
{

    public const TABLE_NAME = 'infobase_faq';
    public const ID = 'entity_id';
    public const STATUS = 'status';
    public const QUESTION = 'question';
    public const ANSWER = 'answer';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    public const STATUS_ENABLED = 1;
    public const STATUS_DISABLED = 0;

    /**
     * @return null|int
     */
    public function getId();

    /** 
     * @return null|int
     */
    public function getStatus();

    /**
     * @return null|string
     */
    public function getQuestion();

    /** 
     * @return null|string
     */
    public function getAnswer();

    /** 
     * @return null|string
     */
    public function getCreatedAt();

    /** 
     * @return null|string
     */
    public function getUpdatedAt();

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /** 
     * @param int $status
     * @return $this
     */
    public function setStatus($status);

    /**
     * @param string $question
     * @return $this
     */
    public function setQuestion(string $question);

    /**
     * @param string $answer
     * @return $this
     */
    public function setAnswer(string $answer);

    /**
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt(string $createdAt);

    /**
     * @param string $updatedAt
     * @return $this
     */
    public function setUpdatedAt(string $updatedAt);
}