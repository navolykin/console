<?php

declare(strict_types=1);

namespace Console\Styles;

use Console\Styles\AStyle;

class WarningTextStyle extends AStyle
{
    protected $color = self::COLORS['yellow'];
    protected $style = self::PALE;
}
