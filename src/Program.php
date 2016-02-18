<?php

namespace Botsphere;

class Program {

    public function execute() {
        $args = func_get_args();
        $members = [];

        foreach ($args as $key => $arg) {
            if ($key != 0) {
                $members[] = $arg;
            }
        }

        return $this->chair(array_reverse($members))->getSpeechOrderRight();
    }

    public function chair(array $members) {
        $occupiedBy = $members[0];

        $chair = new Chair($occupiedBy);

        $chair->setRelation(
            $this->getChairRelation($chair, $members)
        );

        return $chair;
    }


    private function getChairRelation($chair, $members) {
        $leftIndicator = $this->findLeftIndicatorForWing($members, $chair->getOccupiedBy());
        $rightIndicator = $this->findRightIndicatorForWing($members, $chair->getOccupiedBy());

        $length = abs($leftIndicator-$rightIndicator);

        $chairRelation = new ChairRelation();

        if ($leftIndicator && $rightIndicator) {
            if ($leftIndicator > $rightIndicator) {
                $chairRelation->left = $this->chair(array_slice($members, $leftIndicator));
                $chairRelation->right = $this->chair(array_slice($members, $rightIndicator, $length));
            } else {
                $chairRelation->left = $this->chair(array_slice($members, $leftIndicator, $length));
                $chairRelation->right = $this->chair(array_slice($members, $rightIndicator));
            }
        } else if ($leftIndicator) {
            $chairRelation->left = $this->chair(array_slice($members, $leftIndicator));
        } else if ($rightIndicator) {
            $chairRelation->right = $this->chair(array_slice($members, $rightIndicator));
        }

        return $chairRelation;
    }

    private function findLeftIndicatorForWing($members, $wing, $leftIndicator = 1) {
        if (!isset($members[$leftIndicator])) {
            return false;
        }

        if ($wing > $members[$leftIndicator]) {
            return $leftIndicator;
        } else {
            return $this->findLeftIndicatorForWing($members, $wing, ++$leftIndicator);
        }
    }

    private function findRightIndicatorForWing($members, $wing, $rightIndicator = 1) {
        if (!isset($members[$rightIndicator])) {
            return false;
        }

        if ($wing < $members[$rightIndicator]) {
            return $rightIndicator;
        } else {
            return $this->findRightIndicatorForWing($members, $wing, ++$rightIndicator);
        }
    }

}

class Chair
{
    private $occupiedBy;

    private $leftChair;

    private $rightChair;

    public function __construct($occupiedBy)
    {
        $this->occupiedBy = $occupiedBy;
    }

    public function getOccupiedBy() {
        return $this->occupiedBy;
    }

    public function setRelation(ChairRelation $chairRelation) {
        $this->leftChair = $chairRelation->left;
        $this->rightChair = $chairRelation->right;
    }

    public function getSpeechOrderRight() {
        $values = [];

        if (isset($this->rightChair)) {
            $values = array_merge($values, $this->rightChair->getSpeechOrderRight());
        }

        if (isset($this->leftChair)) {
            $values = array_merge($values, $this->leftChair->getSpeechOrderRight());
        }

        $values[] = $this->occupiedBy;

        return $values;
    }

    public function getTree($level = 0) {
        for ($i=0;$i<=$level;$i++) {
            echo '|';
        }

        echo ' <- ' . $this->occupiedBy . ' -> ' . "\n";

        if (isset($this->leftChair)) {
            echo $this->leftChair->getTree($level + 1);
        }

        if (isset($this->rightChair)) {
            echo $this->rightChair->getTree($level + 1);
        }

    }
}

class ChairRelation {
    public $left;
    public $right;
}