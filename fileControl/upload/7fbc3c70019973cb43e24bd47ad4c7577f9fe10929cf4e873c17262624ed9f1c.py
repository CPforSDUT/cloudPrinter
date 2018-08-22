able = {"oe": 0, "n": 0, "z": 0,
        "oK": 1, "6": 1, "5": 1,
        "ow": 2, "-": 2, "A": 2,
        "oi": 3, "o": 3, "i": 3,
        "7e": 4, "v": 4, "P": 4,
        "7K": 5, "4": 5, "k": 5,
        "7w": 6, "C": 6, "s": 6,
        "7i": 7, "S": 7, "l": 7,
        "Ne": 8, "c": 8, "F": 8,
        "NK": 9, "E": 9, "q": 9,
        '*': 'X'}
print('输入想翻译的:')
userinput = input()
userinput = userinput[4:]
n = 0
while True:
    if able.get(userinput[n:n+2],'null') != 'null':
        userinput = userinput.replace(userinput[n:n+2],str(able.get(userinput[n:n+2],'*')),1)
    else:
        userinput = userinput[:n] + userinput[n:].replace(userinput[n],str(able.get(userinput[n],'*')),1)
    n += 1
    if n == len(userinput):
        break
print(userinput)
