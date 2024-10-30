<?php

// Importamos la clase Calculator desde el namespace App.
use App\Calculator;
// Importamos TestCase desde PHPUnit para crear pruebas.
use PHPUnit\Framework\TestCase;

// Definición de la clase CalculatorTest, que extiende TestCase de PHPUnit.
class CalculatorTest extends TestCase
{
    // Prueba unitaria para el método add.
    // Esta prueba verifica que la suma de 2 y 2 sea igual a 4.
    public function testAdd()
    {
        // Instancia de la clase Calculator.
        $calculator = new Calculator();
        
        // Aserción que compara el resultado de add(2, 2) con el valor esperado (4).
        $this->assertEquals(4, $calculator->add(2, 2));
    }

    // Prueba unitaria para el método subtract.
    // Esta prueba verifica que la resta de 2 y 2 sea igual a 0.
    public function testSubtract()
    {
        // Instancia de la clase Calculator.
        $calculator = new Calculator();
        
        // Aserción que compara el resultado de subtract(2, 2) con el valor esperado (0).
        $this->assertEquals(0, $calculator->subtract(2, 2));
    }
}
