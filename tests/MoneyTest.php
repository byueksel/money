<?php

namespace Byueksel\Tests;

use Byueksel\Money;
use PHPUnit\Framework\TestCase;
/**
 * A simple Money Class for PHP
 *
 * Date: 17.12.2017
 * Time: 01:04
 *
 * @package Byueksel
 * @subpackage Test
 * @author Burak Yueksel <brkyksl58@gmail.com>
 * @copyright 2017 Burak Yueksel
 * @license MIT
 * @version 1.0.0
 */
class MoneyTest extends TestCase
{

    public function testCalculations()
    {
        $mon1 = new Money(100.73);
        $mon1->add(new Money(99.27));
        $this->assertEquals(200, $mon1->getAmount());

        $mon2 = new Money(100.74);
        $mon2->add(new Money(99.27));
        $this->assertEquals(200.01, $mon2->getAmount());

        $mon3 = new Money(0.99);
        $mon3->add(new Money(1.66));
        $this->assertEquals(2.65, $mon3->getAmount());

        $mon4 = new Money(0.99);
        $mon4->multiply(4.66);
        $this->assertEquals(4.6134, $mon4->getAmount(4));
    }

    public function testOneEuro()
    {
        $cur = new Money(1);

        $this->assertEquals(1, $cur->getAmount());
    }

    public function testOneEuroThirtyCent()
    {
        $cur = new Money(1.30);

        $this->assertEquals(1.30, $cur->getAmount());
    }

    public function testAddition()
    {
        $total = new Money();
        $total->add(new Money(14670.40));
        $total->add(new Money(2787.37));
        $total->add(new Money(49.00));

        $this->assertEquals(17506.77, $total->getAmount());
    }

    public function testAdditionFormated()
    {
        $total = new Money();
        $total->add(new Money(14670.40));
        $total->add(new Money(2787.37));
        $total->add(new Money(49.00));

        $this->assertEquals('17.506,77',
            $total->getFormatedAmount(2));
    }

    public function testSubtract()
    {
        $money = new Money(14670.11);
        $money->subtract(new Money(670.09));

        $this->assertEquals(14000.02, $money->getAmount());
    }

    public function testMultiply()
    {
        $money = new Money(84);
        $money->multiply(1.19);

        $this->assertEquals(99.96, $money->getAmount());
    }

    public function testDivide()
    {
        $money = new Money(84);
        $money->divide(1.19);

        $this->assertEquals(70.58, $money->getAmount());
    }

}
