<?php 

declare(strict_types=1);

namespace Console\Styles;

use Console\Styles\AStyle;

class WarningStyle extends AStyle
{
    protected $color = self::COLORS['black'];
    protected $bg = self::COLORS['yellow'];
    protected $style = self::BOLD;
    protected $wrap_text = ' ';
}
