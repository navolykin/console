<?php 

declare(strict_types=1);

namespace Console\Contracts;

interface IConsoleEntity
{
    public function write(string $content): void;

    public function writeln(string $content): void;
}