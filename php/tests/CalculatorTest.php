<?php
// tests/CalculatorTest.php

use PHPUnit\Framework\TestCase;
require './src/Calculator.php';

class CalculatorTest extends TestCase {
    /**
     * Test: Suma de dos números enteros.
     */
    public function testAdd() {
        $calculator = new Calculator();
        $this->assertEquals(4, $calculator->add(2, 2));
    }

    /**
     * Test: Suma de dos números flotantes.
     */
    public function testAddFloats() {
        $calculator = new Calculator();
        $this->assertEquals(5.5, $calculator->add(2.5, 3.0));
    }
}
