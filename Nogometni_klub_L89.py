class Nogometni_klub:

    def __init__(self, golovi=0):
        self.golovi = golovi
        self.strijelci = 0

    def say_state(self):
        print("Broj postignutih golova je {}!".format(self.golovi))

    def gol(self):
        self.golovi += 1

    def step(self):
        self.strijelci = self.golovi

if __name__ == '__main__':

    moj_klub = Nogometni_klub()
    print("Ja sam nogometaš!")
    while True:
        action = input("Šta da napravim slijedeće? Zabij [G]ol, show [S]trijelce or e[X]it?").upper()
        if action not in"GSX" or len(action) != 1:
            print("Ne znam to napraviti!")
            continue
        if action == 'G':
            moj_klub.gol()
            moj_klub.step()
            moj_klub.say_state()
        elif action == 'S':
            print("Broj strijelaca je {} .".format(moj_klub.strijelci))
        elif action == 'X':
            exit()

