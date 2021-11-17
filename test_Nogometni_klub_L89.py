from unittest import TestCase

from Nogometni_klub_L89 import Nogometni_klub


class TestNogometni_klub(TestCase):
    def setUp(self):
        self.klub = Nogometni_klub()

class TestStrijelci(TestNogometni_klub):
    def test_broj_strijelaca_do_sest(self):
        if self.klub.step() == 6:
            print("Ima više od 5 strijelaca!")
            exit()
        else:
            pass


class TestGolovi(TestNogometni_klub):
    def test_golovi_na_utakmici(self):
        if self.klub.golovi == 7:
            print("Utakmica je završila!!!")