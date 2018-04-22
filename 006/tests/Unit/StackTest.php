<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 20.04.2018
 * Time: 01:09
 */

namespace test\Unit;


use PHPUnit\Framework\TestCase;
use Stack\Stack;

class StackTest extends TestCase
{
    /**
     * @dataProvider getDataForPushAndPop
     * @param array $elements
     * @param array $expectedElements
     */
    public function testPushAndPop(array $elements, array $expectedElements) {
        $stack = new Stack();



        foreach ($elements as $val) {
            $stack->push($val);
        }

        $newArray = array();
        for($i = 0; $i < count($elements); $i++) {
            $newArray[] = $stack->pop();
        }

        $this->assertEquals($newArray, $expectedElements);
    }

    public function getDataForPushAndPop()
    {
        return [
            [[3, 2, 1], [1, 2, 3]],
            [[1, 2, 3], [3, 2, 1]],
        ];
    }
}

// jak sprawdzać czy zwróciło oczekiwany wyjątek
// nadpisywanie/sprawdzanie prywatnej tablicy