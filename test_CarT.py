from unittest import TestCase

from CarT import CarT


class TestCarT(TestCase):
    def setUp(self):
        self.car = CarT()


class TestInit(TestCarT):
    def test_initial_speed(self):
        self.assertEqual(self.car.speed, 0)

    def test_initial_odometer(self):
        self.assertEqual(self.car.odometer, 0)

    def test_initial_time(self):
        self.assertEqual(self.car.time, 0)


class TestAccelerate(TestCarT):
    def test_accelerate_from_zero(self):
        self.car.accelerate()
        self.assertEqual(self.car.speed, 5)

    def test_multiple_accelerates(self):
        for _ in range(3):
            self.car.accelerate()
        self.assertEqual(self.car.speed, 15)


class TestBrake(TestCarT):
    def test_brake_once(self):
        self.car.accelerate()
        self.car.brake()
        self.assertEqual(self.car.speed, 0)

    def test_multiple_brakes(self):
        for _ in range(5):
            self.car.accelerate()
        for _ in range(3):
            self.car.brake()
        self.assertEqual(self.car.speed, 10)

    def test_should_not_allow_negative_speed(self):
        self.car.brake()
        self.assertEqual(self.car.speed, 0)

    def test_multiple_brakes_at_zero(self):
        for _ in range(3):
            self.car.brake()
        self.assertEqual(self.car.speed, 0)


class TestStep(TestCarT):
    def test_broj_koraka_do_sest(self):
        if self.car.step() == 6:
            print("There is steps over 5!")
            exit()
        else:
            pass


class TestCarCrash(TestCarT):
    def test_car_crash(self):
        if self.car.speed == 100:
            print("The car crashed!!!")
