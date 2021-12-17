<?php

class ExecuteCommand {

    private string $password;

    private function getDir(): string
    {
        $reflector = new ReflectionClass(get_class($this));
        return dirname($reflector->getFileName());
    }

    final public function executeCommand(string $commandName, bool $root = false):void {

        $commandString = 'sh ' . $this->getDir() . '/bash/' . $commandName . '.sh';

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
