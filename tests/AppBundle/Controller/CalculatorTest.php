<?php
/**
 * Created by IntelliJ IDEA.
 * User: Raimondas
 * Date: 6/27/2017
 * Time: 1:17 PM
 */

namespace AppBundle\Controller;


class CalculatorTest extends \PHPUnit_Framework_TestCase
{
    public function testAdd()
    {
        $calc = new Calculator();
        $result = $calc->add(30, 12);

        // assert that your calculator added the numbers correctly!
        $this->assertEquals(42, $result);
    }
}
