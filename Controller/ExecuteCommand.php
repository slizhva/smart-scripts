<?php

class ExecuteCommand {

    private string $password;

    final public function executeCommand(string $commandName, bool $root = false):void {

        $commandString = 'sh ' . __DIR__ . '/bash/' . $commandName . '.sh';

        // If need root but not defined
        if ($root && $this->password === '') {
            throw new RuntimeException('Please set your password in the .env file');
        }

        // If need root to exec command
        $commandString .= $root ? (' ' . $this->password) : '';

        exec($commandString);
    }

    public function __construct() {
        $this->password = $_ENV['SUDO_PASSWORD'] ?? '';
    }

}
