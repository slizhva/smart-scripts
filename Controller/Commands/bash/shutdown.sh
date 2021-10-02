#!/bin/bash
export DISPLAY=:1;
xdotool key ctrl+alt+t;
sleep 2;
xdotool type "echo $1 | sudo -S shutdown -h now";
xdotool key KP_Enter;