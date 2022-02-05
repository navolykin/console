<?php 

declare(strict_types=1);

namespace Console\ConsoleEntity;

use Console\Contracts\IConsoleEntity;
use Console\Contracts\IGlossary;
use Console\Styles\AStyle;

class Message implements IConsoleEntity, IGlossary
{
    private $content = '';

    private $wrap_text = '';

    private $color   = null;

    private $bg      = null;

    private $style   = [];

    private $position = [];

    public function __construct()
    {
        $args_num = func_num_args();

        $content = '';
        $color = $bg = null;

        if ($args_num > 0) {
            if ($args_num == 1 && is_array(func_get_arg(0))) {
                $params = func_get_arg(0);

                $content = isset($params['content']) ? $params['content'] : $this->content;
                $color = isset($params['color']) ? $params['color'] : $this->color;
                $bg = isset($params['bg']) ? $params['bg'] : $this->bg;
            } else {
                if ($args_num > 1) {
                    $content = func_get_arg(0);
                    $color = func_get_arg(1);
                }

                if ($args_num > 2) {
                    $bg = func_get_arg(2);
                }
            }

            $this->content = $content;

            if ($color != null) {
                if (!is_string($color) && !isset(self::COLORS[strtolower($color)])) {
                    throw new \Exception();
                }

                $this->color = 3 . self::COLORS[strtolower($color)];
            }

            if ($color != null) {
                if (!is_string($bg) && !isset(self::COLORS[strtolower($bg)])) {
                    throw new \Exception();
                }

                $this->bg = 4 . self::COLORS[strtolower($bg)];
            }
        }
    }

    public function setStyle(AStyle $style): self
    {
        if ($style->color !== null) {
            $this->color = 3 . $style->color;
        }
        
        if ($style->bg !== null) {
            $this->bg = 4 . $style->bg;
        }
        
        if (!empty($style->style)) {
            $this->style = $style->style;
        }

        if ($style->wrap_text !== '') {
            $this->wrap_text = $style->wrap_text;
        }

        return $this;
    }

    private function normalizContent(string $content): string
    {
        return preg_replace('/(\s)+/', ' ', $content);
    }

    public function color(string $color): self
    {
        if (!isset(self::COLORS[strtolower($color)])) {
            throw new \Exception();
        }

        $this->color = 3 . self::COLORS[strtolower($color)];

        return $this;
    }

    public function bg(string $color): self
    {
        if (!self::COLORS[strtolower($color)]) {
            throw new \Exception();
        }

        $this->bg = 4 . self::COLORS[strtolower($color)];

        return $this;
    }

    public function content(string $content): self
    {
        $this->content = preg_replace('/(\s)+/', ' ', $content);

        return $this;
    }

    public function bold(): self
    {
        if (!isset($this->style[self::BOLD])) {
            $this->style[] = self::BOLD;
        }

        return $this;
    }

    public function pale(): self
    {
        if (!isset($this->style[self::PALE])) {
            $this->style[] = self::PALE;
        }

        return $this;
    }

    public function italic(): self
    {
        if (!isset($this->style[self::ITALIC])) {
            $this->style[] = self::ITALIC;
        }

        return $this;
    }

    public function underline(): self
    {
        if (!isset($this->style[self::UNDERLINE])) {
            $this->style[] = self::UNDERLINE;
        }

        return $this;
    }

    public function flashing(): self
    {
        if (!isset($this->style[self::FLASHING])) {
            $this->style[] = self::FLASHING;
        }

        return $this;
    }

    public function invert(): self
    {
        if (!isset($this->style[self::INVERT])) {
            $this->style[] = self::INVERT;
        }

        return $this;
    }

    public function hide(): self
    {
        if (!isset($this->style[self::HIDE])) {
            $this->style[] = self::HIDE;
        }

        return $this;
    }

    public function position(int $column, int $row): self
    {
        $this->position = [$column, $row];

        return $this;
    }

    public function reset(): self
    {
        $this->color = $this->bg = null;
        $this->style = [];

        return $this;
    }

    public function get(string $content): string
    {
        $this->content = $content;

        return $this->buildMessage();
    }

    public function wrap(string $wrap_text = ' '): self
    {
        $this->wrap_text = $wrap_text;

        return $this;
    }

    public function write(string $content): void
    {
        $this->content = $this->normalizContent($content);

        echo $this->buildMessage();
    }

    public function writeln(string $content): void
    {
        $this->content = $this->normalizContent($content);

        echo $this->buildMessage() . PHP_EOL;
    }

    private function buildMessage(): string
    {
        $data = [];
        if (!empty($this->style)) {
            $data[] = implode(';', array_unique($this->style));
        }
        if ($this->color !== null) {
            $data[] = $this->color;
        }
        if ($this->bg !== null) {
            $data[] = $this->bg;
        }

        $code = '0';
        if (!empty($data)) {
            $code = implode(';', $data);
        }

        $code .= 'm';

        $position = '';
        if (!empty($this->position)) {
            $position = "\033[" . $this->position[0] . ';' . $this->position[1] . 'H';
        }

        return $position . "\033[" . $code . $this->wrap_text . $this->content . $this->wrap_text . "\033[0m";
    }

}