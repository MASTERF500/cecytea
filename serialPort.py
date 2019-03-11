import serial
import requests
import json
ser = serial.Serial()
ser.baudrate = 9600
ser.port = 'COM4'
ser.open()
ser.is_open
def receiving(ser):
    master = str(ser.readline())
    master = master.replace('\\n', '')
    master = master.replace('\\r', '')
    master = master.replace('b', '')
    master = master.replace('\'', '')
    r = requests.get(master)
    print("URL: {}, Status: {}".format(master,r.json()))
try:
    while True:
        receiving(ser)
except KeyboardInterrupt:
    pass
ser.close()
ser.is_open