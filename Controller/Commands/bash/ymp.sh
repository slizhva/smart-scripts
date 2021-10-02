#!/bin/bash
export DISPLAY=:1;
xdotool key ctrl+alt+t;
sleep 2;
xdotool type "setsid ymp";
xdotool key KP_Enter;
sleep 12;
xdotool key ctrl+shift+F7;