import sys
import requests
from bs4 import BeautifulSoup
web = requests.get("http://www.jzvedu.com")
web.encoding = 'utf-8'
webs = BeautifulSoup(web.text,'lxml', from_encoding='utf8')
for each in webs.find_all('a'):
    print each.string.encode(sys.getfilesystemencoding())
    a = raw_input()
