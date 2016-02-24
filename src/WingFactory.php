<?php

namespace Botsphere;

class WingFactory
{

    /**
     * @param array $membersInOddSessionOrder
     * @return Wing
     * @throws \Exception
     */
    public function createFromOddSessionSpeechOrder(array $membersInOddSessionOrder)
    {
        if (empty($membersInOddSessionOrder)) {
            throw new \Exception('There are no members in odd session speech order!');
        }

        $members = array_reverse($membersInOddSessionOrder);

        return $this->createWing($members);
    }

    /**
     * @param array $members
     * @return Wing
     */
    private function createWing(array $members)
    {
        $chairmanId = $members[0];

        $wing = new Wing($chairmanId);

        $this->setLeftAndRightOnWing($members, $wing);

        return $wing;
    }

    /**
     * @param array $members
     * @param Wing $wing
     */
    private function setLeftAndRightOnWing(array $members, Wing $wing)
    {
        $leftMemberIndex = $this->findLeftMemberIndex($members, $wing);
        $rightMemberIndex = $this->findRightMemberIndex($members, $wing);

        if ($rightMemberIndex && $leftMemberIndex) {
            $lengthFromLeftToRight = $leftMemberIndex - $rightMemberIndex;

            $membersForLeft = array_slice($members, $leftMemberIndex);
            $membersForRight = array_slice($members, $rightMemberIndex, $lengthFromLeftToRight);

            $left = $this->createWing($membersForLeft);
            $right = $this->createWing($membersForRight);

            $wing->setLeft($left);
            $wing->setRight($right);
        } else if ($rightMemberIndex) {
            $membersForRight = array_slice($members, $rightMemberIndex);

            $right = $this->createWing($membersForRight);

            $wing->setRight($right);
        } else if ($leftMemberIndex) {
            $membersForLeft = array_slice($members, $leftMemberIndex);

            $left = $this->createWing($membersForLeft);

            $wing->setLeft($left);
        }
    }

    /**
     * @param array $members
     * @param Wing $wing
     * @param int $leftMemberIndex
     * @return bool|int
     */
    private function findLeftMemberIndex(array $members, Wing $wing, $leftMemberIndex = 1)
    {
        if (!isset($members[$leftMemberIndex])) {
            return false;
        } else if ($wing->getChairmanId() > $members[$leftMemberIndex]) {
            return $leftMemberIndex;
        } else {
            return $this->findLeftMemberIndex($members, $wing, ++$leftMemberIndex);
        }
    }

    /**
     * @param array $members
     * @param Wing $wing
     * @return bool|int
     */
    private function findRightMemberIndex(array $members, Wing $wing)
    {
        $rightMemberIndex = 1;

        if (isset($members[$rightMemberIndex]) && $wing->getChairmanId() < $members[$rightMemberIndex]) {
            return $rightMemberIndex;
        }

        return false;
    }

}
