#!/usr/bin/env python3
from netifaces import interfaces, ifaddresses, AF_INET
from papirus import PapirusTextPos
from datetime import datetime
import subprocess
import socket
import re
import time
console_display = False
inv = False
text = PapirusTextPos(False, 0)
text.Clear()
text.autoUpdate = False
text.partialUpdates = True
font_size = 15
vert_spacing = font_size + 1
cur_time = datetime.now()
text_time = cur_time.strftime('%Y/%m/%d %I:%M:%S')
disp_text="web - http://secure.pi"
if console_display: print(disp_text)
text.AddText(disp_text,  0, vert_spacing * 0, font_size, Id="web")
disp_text="ssid- "
if console_display: print(disp_text)
text.AddText(disp_text,  0, vert_spacing * 1, font_size, Id="ssid")
disp_text="wlan- "
if console_display: print(disp_text)
text.AddText(disp_text,  0, vert_spacing * 2, font_size, Id="wlan0")
disp_text="wan - "
if console_display: print(disp_text)
text.AddText(disp_text,  0, vert_spacing * 3, font_size, Id="Pub")
disp_text="VPN is "
if console_display: print(disp_text)
text.AddText(disp_text, 0, vert_spacing * 4, font_size, Id="VPN")
disp_text=text_time
if console_display: print(disp_text)
text.AddText(disp_text, 0, vert_spacing * 5, font_size, Id="date")
text.WriteAll()
tunnel_up = False
clear_time = False
tunnel_went_down = False
have_inet = True
first_run = True
last_loop = time.time()
while True:
    diff = time.time() - last_loop
    if first_run:
        first_run = False
        diff = 2.0
    if diff < 1.5:
        time.sleep(2)
        continue
    tunnel_up = False
    for ifaceName in interfaces():
        if ifaceName == "lo": continue
        addresses = [i['addr'] for i in ifaddresses(ifaceName).setdefault(AF_INET, [{'addr':'No IP addr'}] )]
        if ifaceName == "tun0":
            if tunnel_went_down:
                clear_time = True
                tunnel_went_down = False
            tunnel_up = True
            inv = False
        elif ifaceName == "wlan0":
            if "addr" in "".join(addresses):
                disp_text = 'wlan- '
            else:
                disp_text = 'wlan- ' + "".join(addresses)
            if console_display: print(disp_text)
            text.RemoveText("wlan0")
            text.AddText(disp_text,  0, vert_spacing * 2, font_size, Id="wlan0", invert=inv)
        elif ifaceName != "wlan0" and ifaceName != "tun0":
            disp_text = 'wlan- '
            if console_display: print(disp_text)
            text.RemoveText("wlan0")
            text.AddText(disp_text,  0, vert_spacing * 2, font_size, Id="wlan0", invert=inv)
#        elif ifaceName == "usb0":
#            disp_text = 'usb - ' + "".join(addresses)
#            if console_display: print(disp_text)
#            text.RemoveText("usb0")
#            text.AddText(disp_text,  0, vert_spacing * 2, font_size, Id="usb0", invert=inv)
    disp_text = 'wan - '
    request = b"GET / HTTP/1.1\nHost: ident.me\n\n"
    s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    s.settimeout(3)
    try:
        s.connect(("176.58.123.25", 80))
        s.send(request)
        result = s.recv(10000)
        regex = re.findall(r'(?:[\d]{1,3})\.(?:[\d]{1,3})\.(?:[\d]{1,3})\.(?:[\d]{1,3})',result.decode('utf-8'))
        for match in regex:
            disp_text = 'wan - ' + match
        have_inet = True
    except:
        disp_text = 'wan - '
        have_inet = False
    finally:
        s.close()
        if console_display: print(disp_text)
        text.RemoveText("Pub")
        text.AddText(disp_text,  0, vert_spacing * 3, font_size, Id="Pub", invert=inv)
    if tunnel_up:
        disp_text = "VPN is active - SECURE"
        text.RemoveText("VPN")
        text.AddText(disp_text, 0, vert_spacing * 4, font_size, Id="VPN", invert=inv)
    else:
        tunnel_went_down = True
        disp_text = "VPN is down - INSECURE"
        text.RemoveText("VPN")
        text.AddText(disp_text, 0, vert_spacing * 4, font_size, Id="VPN", invert=inv)
    if console_display: print(disp_text)
    text.UpdateText("VPN", disp_text)
    if have_inet and tunnel_went_down:
        disp_text = "Please update VPN config"
        if console_display: print(disp_text)
        text.RemoveText("date")
        text.AddText(disp_text, 0, vert_spacing * 5, font_size, Id="date", invert=inv)
    else:
        cur_time = datetime.now()
        disp_text = cur_time.strftime('%Y/%m/%d %I:%M:%S')
        if console_display: print(disp_text)
        text.RemoveText("date")
        text.AddText(disp_text, 0, vert_spacing * 5, font_size, Id="date", invert=inv)
    try:
        result = subprocess.check_output('/sbin/iwgetid -r', shell=True)
        disp_text = 'ssid- ' + str(result.decode('utf-8'))
    except:
        disp_text = 'ssid- Update Wifi Config'
    finally:
        if console_display: print(disp_text)
        text.RemoveText("ssid")
        text.AddText(disp_text,  0, vert_spacing * 1, font_size, Id="ssid", invert=inv)
    disp_text="web - http://secure.pi"
    if console_display: print(disp_text)
    text.RemoveText("web")
    text.AddText(disp_text,  0, vert_spacing * 0, font_size, Id="web", invert=inv)
    if clear_time:
        clear_time = False
        text.Clear()
    if not tunnel_up:
        inv = not inv
    last_loop = time.time()
    text.WriteAll()
