<?php

namespace Botsphere;


class Wing_getEvenSessionSpeechOrder_Test extends \PHPUnit_Framework_TestCase
{
    const MAIN_CHAIRMAN_ID = 10;
    const LEFT_CHAIRMAN_ID = 8;
    const RIGHT_CHAIRMAN_ID = 12;

    public function testItReturnsOneElementArrayWhenWingHasNotRightAndLeft()
    {
        $wing = new Wing(self::MAIN_CHAIRMAN_ID);

        $actual = $wing->getEvenSessionSpeechOrder();

        $this->assertEquals([self::MAIN_CHAIRMAN_ID], $actual);
    }

    public function testItReturnsCorrectSpeechOrderWhenWingHasOnlyOneNestingLevel()
    {
        $wing = $this->prepareWing(self::MAIN_CHAIRMAN_ID, self::LEFT_CHAIRMAN_ID, self::RIGHT_CHAIRMAN_ID);
        $expected = [self::RIGHT_CHAIRMAN_ID, self::LEFT_CHAIRMAN_ID, self::MAIN_CHAIRMAN_ID];

        $actual = $wing->getEvenSessionSpeechOrder();

        $this->assertEquals($expected, $actual);
    }

    public function testItReturnsCorrectSpeechOrderWhenWingHasMoreNestingLevels()
    {
        $wing = new Wing(self::MAIN_CHAIRMAN_ID);
        $wing->setLeft($this->prepareWing(8, 6, 9));
        $wing->setRight($this->prepareWing(15, 11, 30));
        $expected = [30,11,15,9,6,8,self::MAIN_CHAIRMAN_ID];

        $actual = $wing->getEvenSessionSpeechOrder();

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
}