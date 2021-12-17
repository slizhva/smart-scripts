<?php

namespace Controller;

class Commands extends ExecuteCommand {

    final public function refresh():void {
    }

    final public function shutdown():void {
        $this->executeCommand('shutdown', true);
    }

    final public function ymp():void {
        $this->executeCommand('ymp');
    }

    final public function soundUp():void {
        $this->executeCommand('soundUp');
    }

    final public function soundDown():void {
        $this->executeCommand('soundDown');
    }

    final public function soundPlayPause():void {
        $this->executeCommand('soundPlayPause');
    }

    final public function playerNext():void {
        $this->executeCommand('playerNext');
    }

}
