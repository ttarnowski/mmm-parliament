<?php

namespace Botsphere;


class WingFactory_createFromOddSessionSpeechOrder_Test extends \PHPUnit_Framework_TestCase
{
    public function testItThrowsAnExceptionWhenThereAreNoMemberIdsInOddSessionSpeechOrder()
    {
        $this->setExpectedException(\Exception::class);

        (new WingFactory())->createFromOddSessionSpeechOrder([]);
    }

    public function testItReturnsOneWingWithOnlyAChairmanIdWhenThereIsOnlyOneMemberIdInOddSessionSpeechOrder()
    {
        $expected = new Wing(10);

        $actual = (new WingFactory())->createFromOddSessionSpeechOrder([10]);

        $this->assertEquals($expected, $actual);
    }

    public function testItReturnsWingWithOneNestingLevelWhenOddSessionHasOnlyOneFullWing()
    {
        $expected = $this->prepareWing(10, 8, 12);

        $actual = (new WingFactory())->createFromOddSessionSpeechOrder([8,12,10]);

        $this->assertEquals($expected, $actual);
    }

    public function testItReturnsWingWithTwoNestingLevelsWhenOddSessionHasTwoFullWings()
    {
        $expected = new Wing(10);
        $expected->setLeft($this->prepareWing(8, 2, 9));
        $expected->setRight(new Wing(12));

        $actual = (new WingFactory())->createFromOddSessionSpeechOrder([2,9,8,12,10]);

        $this->assertEquals($expected, $actual);
    }

    public function testItReturnsWingWithThreeNestingLevelsOnlyForRightWingsWhenOddSessionHasOnlyRightWings()
    {
        $expected = $this->prepareWingWithThreeLevelsOfNestingOnTheLeft(10, [8,4,1]);

        $actual = (new WingFactory())->createFromOddSessionSpeechOrder([1,4,8,10]);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @param int $chairmanId
     * @param int $leftChairmanId
     * @param int $rightChairmanId
     * @return Wing
     */
    private function prepareWing($chairmanId, $leftChairmanId, $rightChairmanId)
    {
        $wing = new Wing($chairmanId);

        $wing->setLeft(new Wing($leftChairmanId));
        $wing->setRight(new Wing($rightChairmanId));

        return $wing;
    }

    /**
     * @param int $mainChairmanId
     * @param array $nestedChairmanIdsOnTheLeft Three element array of nested chairman ids on the left
     * @return Wing
     */
    private function prepareWingWithThreeLevelsOfNestingOnTheLeft($mainChairmanId, array $nestedChairmanIdsOnTheLeft)
    {
        $nestedLeftWing2 = new Wing($nestedChairmanIdsOnTheLeft[1]);
        $nestedLeftWing2->setLeft(new Wing($nestedChairmanIdsOnTheLeft[2]));

        $nestedLeftWing = new Wing($nestedChairmanIdsOnTheLeft[0]);
        $nestedLeftWing->setLeft($nestedLeftWing2);

        $wing = new Wing($mainChairmanId);
        $wing->setLeft($nestedLeftWing);

        return $wing;
    }
}