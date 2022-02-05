<?php

namespace Console\Demo;

use Console\Console;

class Demo
{
    public static function postPackageInstall(): void
    {
        self::welcome("CONSOLE IS WORK!");
    }

    private static function welcome(string $content = "Welcome"): void
    {
        Console::getInstance('message')->color('red')->bold()->write($content);
    }
}
