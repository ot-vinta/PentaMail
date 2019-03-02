from nltk.stem import LancasterStemmer
import Translator


def separate_char(s, c):
    d = len(s)
    j = 1
    while j < d - 1:
        if (s[j] == c) and (s[j - 1] != ' '):
            s = s[0: j] + ' ' + s[j: len(s)]
            d += 1
        if (s[j] == c) and (s[j + 1] != ' '):
            s = s[0: j + 1] + ' ' + s[j + 1: len(s)]
            d += 1
        j += 1
    return s


def delete_special_chars(s):
    s = separate_char(s, '{')
    s = separate_char(s, '}')
    s = separate_char(s, '[')
    s = separate_char(s, ']')
    s = separate_char(s, '.')
    s = separate_char(s, ',')
    s = separate_char(s, '?')
    s = separate_char(s, '\'')
    s = separate_char(s, '\"')
    s = separate_char(s, ':')
    s = separate_char(s, ';')
    s = separate_char(s, '|')
    s = separate_char(s, '_')
    s = separate_char(s, '-')
    s = separate_char(s, '+')
    s = separate_char(s, '=')
    s = separate_char(s, '!')
    s = separate_char(s, '@')
    s = separate_char(s, '#')
    s = separate_char(s, '$')
    s = separate_char(s, '№')
    s = separate_char(s, '%')
    s = separate_char(s, '^')
    s = separate_char(s, '&')
    s = separate_char(s, '<')
    s = separate_char(s, '>')
    s = separate_char(s, '*')
    s = separate_char(s, '\\')
    s = separate_char(s, '/')
    s = separate_char(s, '£')
    s = separate_char(s, '')
    s = separate_char(s, 'ú')
    s = separate_char(s, '‘')
    s = separate_char(s, '(')
    s = separate_char(s, ')')
    s = s.replace('{', '')
    s = s.replace('}', '')
    s = s.replace(':)', '}')
    s = s.replace(':(', '{')
    s = s.replace('[', '')
    s = s.replace(']', '')
    s = s.replace('.', '')
    s = s.replace(',', '')
    s = s.replace('?', '')
    s = s.replace('\'', '')
    s = s.replace('\"', '')
    s = s.replace(':', '')
    s = s.replace('|', '')
    s = s.replace('_', '')
    s = s.replace(';', '')
    s = s.replace('-', '')
    s = s.replace('+', '')
    s = s.replace('=', '')
    s = s.replace('!', '')
    s = s.replace('@', '')
    s = s.replace('#', '')
    s = s.replace('№', '')
    s = s.replace('$', '')
    s = s.replace('%', '')
    s = s.replace('^', '')
    s = s.replace('<', '')
    s = s.replace('>', '')
    s = s.replace('*', '')
    s = s.replace('/', '')
    s = s.replace('\\', '')
    s = s.replace('£', '')
    s = s.replace('', '')
    s = s.replace('ú', '')
    s = s.replace('‘', '')
    s = s.replace('&', '')
    s = s.replace(')', ' ')
    s = s.replace('(', ' ')
    s = separate_char(s, '{')
    s = separate_char(s, '}')
    return s


def replace_digits(s):
    start_num = -1
    digits = '0123456789'
    j = 0
    for c in s:
        if (digits.find(c) != -1) and (start_num == -1):
            start_num = j
        elif (digits.find(c) == -1) and (start_num != -1):
            temp = s[start_num: j]
            j -= len(temp) - 1
            s = s.replace(temp, '!', 1)
            start_num = -1
        j += 1
    if start_num != -1:
        temp = s[start_num: len(s[i]) - 1]
        s = s.replace(temp, '!', 1)
    s = separate_char(s, '!')
    return s


def lemmatize(s):
    lancaster = LancasterStemmer()
    words = s.split()
    for i in range(0, len(words)):
        words[i] = lancaster.stem(words[i])
    s = ' '.join(words)
    return s


def normalize_data(s):
    s = Translator.translate_string(s)
    s = s.lower()
    s = delete_special_chars(s)
    s = replace_digits(s)
    s = lemmatize(s)
    return s