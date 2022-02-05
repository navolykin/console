<?php 

declare(strict_types=1);

namespace Console\Styles;

use Console\Styles\AStyle;

class SuccessStyle extends AStyle
{
    protected $color = self::COLORS['black'];
    protected $bg = self::COLORS['green'];
    protected $wrap_text = ' ';
}
