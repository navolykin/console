<?php 

declare(strict_types=1);

namespace Console\Styles;

use Console\Styles\AStyle;

class ErrorTextStyle extends AStyle
{
    protected $color = self::COLORS['red'];
    protected $style = self::PALE;
}
