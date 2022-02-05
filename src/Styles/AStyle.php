<?php 

declare(strict_types=1);

namespace Console\Styles;

use Console\Contracts\IGlossary;

abstract class AStyle implements IGlossary
{
    protected $color     = null;

    protected $bg        = null;

    protected $style     = null;

    protected $position  = [];

    protected $wrap_text = '';

    public function getParams(): array
    {
        return [
            'color'     => $this->color,
            'bg'        => $this->bg,
            'style'     => $this->style,
            'wrap_text' => $this->wrap_text,
        ];
    }

    public function __get($name)
    {
        /*if (!isset($this->{$name})) {
            throw new \Exception();
        }*/

        return $this->$name;
    }
}