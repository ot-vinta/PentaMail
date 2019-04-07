import random


class Key():

    def getn(self):
        return self.module

    def getexp(self):
        return self.exponent

    def getkey(self):
        return "(" + str(self.exponent) + "," + str(self.module) + ")"


class PublicKey(Key):

    def __init__(self, e, n, fi):
        self.exponent = e
        self.module = n
        self.eulers_func = fi

    def __init__(self, p, q):
        # Надо будет доработать проверку на уникальность
        n = p * q
        fi = (p - 1) * (q - 1)

        # Нахождение числа e, которое должно быть взаимопростым с fi

        fi_set = set()  # множество делителей числа fi
        for i in range(2, fi):
            if fi % i == 0:
                fi_set.add(i)

        e_possible = list()  # список возможных значений для e
        for i in range(2, fi):
            i_set = set()  # множество делителей возможного значения e
            for j in range(2, i+1):
                if i % j == 0:
                    i_set.add(j)
            if i_set.isdisjoint(fi_set):  # e и fi должны быть взаимно простыми
                e_possible.append(i)
        if len(e_possible) == 0:
            print("there are no possible values for e")
        e = random.choice(e_possible)

        self.exponent = e
        self.module = n
        self.eulers_func = fi


class PrivateKey(Key):

    def __init__(self, pubkey):  # Нахождение числа d для пары закрытого ключа

        n = pubkey.getn()
        e = pubkey.getexp()
        fi = pubkey.eulers_func

        d = random.randint(n//2, n)
        got_d = False
        while not got_d:
            d += 1
            if d*e % fi == 1:
                got_d = True
        self.exponent = d
        self.module = n


class Message:
    def encode(text, key):  # Преобразование сообщения

        e = key.getexp()
        n = key.getn()

        text_list = list()  # Список порядковых номеров каждого символа
        for i in text:
            text_list.append(ord(i))

        text_list_coded = list()  # Закодированный список символов
        for i in text_list:
            text_list_coded.append(i ** e % n)
        return text_list_coded

    def decode(text_list_coded, key):  # Дешифровка сообщения

        d = key.getexp()
        n = key.getn()

        text_list_decoded = list()  # декодированный список символов
        for i in text_list_coded:
            text_list_decoded.append(i ** d % n)
        text_decoded = ""  # декодированный текст
        for i in text_list_decoded:
            text_decoded += chr(i)
        return text_decoded
