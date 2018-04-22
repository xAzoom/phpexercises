<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 20.04.2018
 * Time: 00:43
 */

namespace test\Unit;
use PHPUnit\Framework\TestCase;
use RPNCalculator\RPNCalculator;

class RPNCalculatorTest extends TestCase
{
    /**
     * @dataProvider getDataForCalculator
     * @param string $expression
     * @param float $expectedResult
     */
    public function testCalculator(string $expression, float $expectedResult) {
        $rpn = $expression;
        $calculator = new RPNCalculator();

        $result = $calculator->calculate($rpn);

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @expectedException \Exception
     */
    public function testx() {

        throw new \Exception();

    }

    public function getDataForCalculator()
    {
        return [
            ["1 2 +", 3],
            ["3 3 -", 0],
            ["3 3 *", 9],
            ["3 3 /", 1],
            ["0 sin", 0],
        ];
    }
}