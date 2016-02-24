<?php

namespace Botsphere;

class IntegrationTest extends \PHPUnit_Framework_TestCase
{

    public function testItReturnsEvenSessionSpeechOrderForProvidedOddSessionSpeechOrder()
    {
        $expected = [27, 21, 22, 25, 20, 7, 1, 5, 10];

        $actual = (new DetermineSpeechOrderForEvenSessionCommand())->execute(9, 1, 7, 5, 21, 22, 27, 25, 20, 10);

        $this->assertEquals($expected, $actual);
    }

    public function testItThrowsAnExceptionWhenNumberOfParliamentMembersExceed3000()
    {
        $this->setExpectedException(\Exception::class);

        $args = array_fill(0, 3001, 'Test value');

        $command = new DetermineSpeechOrderForEvenSessionCommand();
        call_user_func_array([$command, 'execute'], $args);
    }

    public function testItThrowsAnExceptionWhenParliamentMemberIdsExceed65535()
    {
        $this->setExpectedException(\Exception::class);

        (new DetermineSpeechOrderForEvenSessionCommand())->execute(3, 4, 79999, 10);
    }

    public function testItThrowsAnExceptionWhenOneOfParliamentMemberIdsIsNotAnInteger()
    {
        $this->setExpectedException(\Exception::class);

        (new DetermineSpeechOrderForEvenSessionCommand())->execute(3, 4, 'x', 10);
    }

    public function testItThrowsAnExceptionWhenOneOfParliamentMemberIdsIsNotAPositiveValue()
    {
        $this->setExpectedException(\Exception::class);

        (new DetermineSpeechOrderForEvenSessionCommand())->execute(2, 4, -100);
    }
}