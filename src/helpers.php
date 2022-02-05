<?php 

declare(strict_types=1);

namespace Console\Helpers;

use Console\Console;
use Console\Styles\ErrorStyle;
use Console\Styles\WarningStyle;
use Console\Styles\SuccessStyle;
use Console\Styles\InfoStyle;
use Console\Styles\ErrorTextStyle;

function error(string $content, $ln = false): void
{
    $message = Console::getInstance('message')->setStyle(new ErrorStyle());
    $ln ? $message->writeln($content) : $message->write($content);
}

function warning(string $content, $ln = false): void
{
    $message = Console::getInstance('message')->setStyle(new WarningStyle());
    $ln ? $message->writeln($content) : $message->write($content);
}

function seccess(string $content, $ln = false): void
{
    $message = Console::getInstance('message')->setStyle(new SuccessStyle());
    $ln ? $message->writeln($content) : $message->write($content);
}

function info(string $content, $ln = false): void
{
    $message = Console::getInstance('message')->setStyle(new InfoStyle());
    $ln ? $message->writeln($content) : $message->write($content);
}

function error_text(string $content, $ln = false): void
{
    $message = Console::getInstance('message')->setStyle(new ErrorTextStyle());
    $ln ? $message->writeln($content) : $message->write($content);
}
