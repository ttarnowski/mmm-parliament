<?php

namespace Botsphere;

class ProgramTest extends \PHPUnit_Framework_TestCase {

    public function test_it_program_works() {
        $expected = [27,21,22,25,20,7,1,5,10];

        $actual = (new Program())->execute(9,1,7,5,21,22,27,25,20,10);

        $this->assertEquals($expected, $actual);
    }

//    public function random_test() {
//        $expected = [];
//
//        $nums = [];
//
//        for ($i=1;$i<=rand(5,100)*2;$i++) {
//            $nums[rand(1,40)*rand(1,2)] = 0;
//        }
//
//        $args = array_keys($nums);
//
//        array_unshift($args, count($args));
//
//        $program = new Program();
//
//        $actual = call_user_func_array([$program, 'execute'], $args);
//
//        $this->assertEquals($expected, $actual);
//    }
}