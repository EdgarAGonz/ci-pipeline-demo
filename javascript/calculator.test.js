// calculator.test.js
const add = require('./calculator');

/**
 * Test: Suma de dos números enteros.
 */
test('adds 1 + 2 to equal 3', () => {
    expect(add(1, 2)).toBe(3);
});

/**
 * Test: Suma de dos números flotantes.
 */
test('adds 2.5 + 1.5 to equal 4', () => {
    expect(add(2.5, 1.5)).toBe(4);
});

/**
 * Test: Suma de números negativos.
 */
test('adds -1 + 2 to equal 1', () => {
    expect(add(-1, 2)).toBe(1);
});
