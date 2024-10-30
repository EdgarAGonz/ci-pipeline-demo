# test_main.py
import unittest
from main import add

class TestAddFunction(unittest.TestCase):
    def test_add_integers(self):
        """
        Test: Suma de dos números enteros.
        """
        self.assertEqual(add(1, 2), 3)

    def test_add_floats(self):
        """
        Test: Suma de dos números flotantes.
        """
        self.assertEqual(add(1.5, 2.5), 4.0)

    def test_add_negative(self):
        """
        Test: Suma de un número negativo y uno positivo.
        """
        self.assertEqual(add(-1, 2), 1)

if __name__ == '__main__':
    unittest.main()
