<?php 

declare(strict_types=1);

namespace Console\Styles;

use Console\Styles\AStyle;

class ErrorStyle extends AStyle
{
    protected $color = self::COLORS['grey'];
    protected $bg = self::COLORS['red'];
    protected $wrap_text = ' ';
}
