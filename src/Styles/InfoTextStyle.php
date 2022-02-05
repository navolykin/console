<?php

declare(strict_types=1);

namespace Console\Styles;

use Console\Styles\AStyle;

class InfoTextStyle extends AStyle
{
    protected $color = self::COLORS['azure'];
    protected $style = self::PALE;
}
