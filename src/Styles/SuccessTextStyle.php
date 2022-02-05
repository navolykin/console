<?php

declare(strict_types=1);

namespace Console\Styles;

use Console\Styles\AStyle;

class SuccessTextStyle extends AStyle
{
    protected $color = self::COLORS['green'];
    protected $style = self::PALE;
}
