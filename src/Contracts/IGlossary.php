<?php 

declare(strict_types=1);

namespace Console\Contracts;

interface IGlossary
{
    const BOLD      = 1;
    const PALE      = 2;
    const ITALIC    = 3;
    const UNDERLINE = 4;
    const FLASHING  = 5;
    const INVERT    = 7;
    const HIDE      = 8;
    const CROSSED   = 9;

    const COLORS = [
        'black'  => 0,
        'red'    => 1,
        'green'  => 2,
        'yellow' => 3,
        'blue'   => 4,
        'perple' => 5,
        'azure'  => 6,
        'grey'   => 7,
        'white'  => 9,
    ];
}