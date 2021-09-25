<?php

class Commands {

    public final function ymp():void {
        // Start YMP player
        exec('sh ./bash/ymp.sh');
    }

    public final function soundUp():void {
        exec('sh ./bash/soundUp.sh');
    }

    public final function soundDown():void {
        exec('sh ./bash/soundDown.sh');
    }

    public final function soundPlayPause():void {
        exec('sh ./bash/soundPlayPause.sh');
    }

    public final function playerNext():void {
        exec('sh ./bash/playerNext.sh');
    }
}
