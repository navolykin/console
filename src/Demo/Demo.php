<?php

namespace Console\Demo;

use Console\Console;

class Demo
{
    public function postPackageInstall(): void
    {
        $this->welcome("CONSOLE IS WORK!");
    }

    private function welcome(string $content = "Welcome"): void
    {
        Console::getInstance('message')->color('red')->bold()->write($content);
    }
}
