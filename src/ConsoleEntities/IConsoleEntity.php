<?php

/**
 * ---------------------------------------------- |
 *            _____                       _       |
 *           /  __ \                     | |      |
 *           | /  \/ ___  _ __  ___  ___ | | ___  |
 *           | |    / _ \| '_ \/ __|/ _ \| |/ _ \ |
 *           | \__/\ (_) | | | \__ \ (_) | |  __/ |
 *            \____/\___/|_| |_|___/\___/|_|\___| |
 * ---------------------------------------------- |
 * Vladimir Navolykin | vnavolykin/console | 2022 |
 * ---------------------------------------------- |
 */

declare(strict_types=1);

namespace Console\ConsoleEntities;

interface IConsoleEntity
{
    public function write(string $content): void;

    public function writeln(string $content): void;
}