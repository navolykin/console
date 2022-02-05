<?php 

declare(strict_types=1);

namespace Console\Styles;

use Console\Styles\AStyle;

class InfoStyle extends AStyle
{
    protected $color = self::COLORS['black'];
    protected $bg = self::COLORS['azure'];
    protected $style = self::BOLD;
    protected $wrap_text = ' ';
}
