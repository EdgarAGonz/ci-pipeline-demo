<?php

// Definimos un espacio de nombres (namespace) para organizar las clases.
// Esto es importante para seguir el estándar PSR-12.
namespace App;

// Definición de la clase Calculator.
class Calculator
{
    // Método para sumar dos números.
    // @param float|int $a Primer número a sumar.
    // @param float|int $b Segundo número a sumar.
    // @return float|int Resultado de la suma.
    public function add($a, $b)
    {
        return $a + $b;
    }

    // Método para restar dos números.
    // @param float|int $a Minuendo.
    // @param float|int $b Sustraendo.
    // @return float|int Resultado de la resta.
    public function subtract($a, $b)
    {
        return $a - $b;
    }
}
