<?php

namespace Botsphere;

class Wing
{
    /**
     * @var int
     */
    private $chairmanId;

    /**
     * @var Wing|null
     */
    private $left;

    /**
     * @var Wing|null
     */
    private $right;

    /**
     * Wing constructor.
     * @param int $chairmanId
     */
    public function __construct($chairmanId)
    {
        $this->chairmanId = $chairmanId;
    }

    /**
     * @return int
     */
    public function getChairmanId()
    {
        return $this->chairmanId;
    }

    /**
     * @param Wing $wing
     */
    public function setLeft(Wing $wing)
    {
        $this->left = $wing;
    }

    /**
     * @param Wing $wing
     */
    public function setRight(Wing $wing)
    {
        $this->right = $wing;
    }

    /**
     * @return array
     */
    public function getEvenSessionSpeechOrder()
    {
        $values = [];

        if (isset($this->right)) {
            $values = array_merge($values, $this->right->getEvenSessionSpeechOrder());
        }

        if (isset($this->left)) {
            $values = array_merge($values, $this->left->getEvenSessionSpeechOrder());
        }

        $values[] = $this->chairmanId;

        return $values;
    }
}
