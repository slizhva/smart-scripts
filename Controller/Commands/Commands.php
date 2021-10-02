<?php

class Commands {

    private function executeCommand(string $commandName, bool $root = false):void {
        $commandString = 'sh ' . __DIR__ . '/bash/' . $commandName . '.sh';

        // If need root
        $commandString .= $root ? ' ' . $_ENV['SUDO_PASSWORD'] : '';

        exec($commandString);
    }

    public final function shutdown():void {
        $this->executeCommand('shutdown', true);
    }

    public final function ymp():void {
        $this->executeCommand('ymp');
    }

    public final function soundUp():void {
        $this->executeCommand('soundUp');
    }

    public final function soundDown():void {
        $this->executeCommand('soundDown');
    }

    public final function soundPlayPause():void {
        $this->executeCommand('soundPlayPause');
    }

    public final function playerNext():void {
        $this->executeCommand('playerNext');
    }
}
