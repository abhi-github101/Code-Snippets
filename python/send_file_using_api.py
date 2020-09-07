import requests
import os
import time
from datetime import datetime

def upload():
    url = 'http://127.0.0.1:6005/rcv_code'
    file = {'file': ('analyse_video.py', open('./analyse_video.py', 'rb'))}

    r = requests.post(url, files=file)
    if r.status_code == 200:
        print("Uploaded Successfully")

def uploadFiles():
    dir = "./send/"
    url = 'http://127.0.0.1:6005/rcv_code'
        
    for f in os.listdir(dir):
        files = {'file': (f, open(dir+f, 'rb'))}

        r = requests.post(url, files=files)
        if r.status_code == 200:
            print("Uploaded Successfully")
           

# upload()
uploadFiles()
