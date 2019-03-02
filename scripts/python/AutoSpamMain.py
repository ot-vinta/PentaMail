import numpy as np
import Normalizer
import sys
import json


def initialize_weights():
    W = {}
    b = {}
    W[1] = np.load('Weights.npy')
    b[1] = np.load('b.npy')
    return W, b


def load_message():
    try:
        content = json.loads(sys.argv[1])
    except:
        print('ERROR')
        sys.exit(1)
    return content


def find_unique_words(s):
    unique_words = []
    words = s.split()
    for word in words:
        unique_words.append(word)
    return unique_words


def find_frequencies(unique_words, s):
    word_freq = {}
    word_count = {}
    for word in unique_words:
        word_count[word] = 0
        word_freq[word] = 0
    words = s.split()
    for word in words:
        word_count[word] += 1
    for j in word_count:
        word_freq[j] = round(word_count[j] / len(words), 4)
    return word_freq


def delete_useless_words(words, words_freq):
    keys = []
    for word in words_freq:
        if word not in words:
            keys.append(word)
    for i in keys:
        words_freq.pop(i)
    return words_freq


def f(x):
    return 1 / (1 + np.exp(-x))


# Calculate target function
def feed_forward(x, W, b):
    h = {1: x}
    z = {}
    for l in range(1, len(W) + 1):
        if l == 1:
            node_in = x
        else:
            node_in = h[l]
        z[l+1] = (W[l].dot(node_in).T + b[l]).T
        h[l+1] = f(z[l+1])
    return h, z


def predict_y(W, b, X, n_layers):
    m = X.shape[0]
    y = np.zeros((m,))
    for i in range(m):
        h, z = feed_forward(X[i], W, b)
        y[i] = np.argmax(h[n_layers])
    return y


def make_args(words_freq, words):
    X = []
    for word in words:
        if word not in words_freq:
            X.append(0)
        else:
            X.append(words_freq[word])
    return X


W, b = initialize_weights()
#s = load_message()
s = 'Привет! Как дела? Что делаешь? А я ничего.'
s = Normalizer.normalize_data(s)
words_freq = find_frequencies(find_unique_words(s), s)
file = open('keys.txt', 'r', encoding='utf-8')
words = file.readline().split()
words_freq = delete_useless_words(words, words_freq)
X = make_args(words_freq, words)
X = np.asarray(X)
X = X.reshape(5610, 1).T
answer = predict_y(W, b, X, 2)
print(json.dumps(answer))
