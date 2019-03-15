import requests


def translate_word(word):
    url = 'https://translate.yandex.net/api/v1.5/tr.json/translate?'
    key = 'trnsl.1.1.20190301T083329Z.832c79ee38d9a807.ec602e027019c318c78d814fa539d62b5a12310e'
    text = word
    lang = 'ru-en'

    r = requests.post(url, data={'key': key, 'text': text, 'lang': lang})

    answer = r.text
    answer = answer[36: (len(answer) - 3)]
    return answer


def translate_string(s):
    words = s.split()
    translated_words = []
    for word in words:
        translated_words.append(translate_word(word))
    return translated_words
