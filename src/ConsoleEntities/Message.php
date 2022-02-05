<?php

/**
 * ---------------------------------------------- |
 *            _____                       _       |
 *           /  __ \                     | |      |
 *           | /  \/ ___  _ __  ___  ___ | | ___  |
 *           | |    / _ \| '_ \/ __|/ _ \| |/ _ \ |
 *           | \__/\ (_) | | | \__ \ (_) | |  __/ |
 *            \____/\___/|_| |_|___/\___/|_|\___| |
 * ---------------------------------------------- |
 * Vladimir Navolykin | vnavolykin/console | 2022 |
 * ---------------------------------------------- |
 */

declare(strict_types=1);

namespace Console\ConsoleEntities;

use Console\ConsoleEntities\IConsoleEntity;
use Console\Contracts\IGlossary;
use Console\Styles\AStyle;

/**
 * A text message that is output to the console. Can be formatted directly, 
 * or via a style object. To output, use the write and writeln methods.
 */
class Message implements IConsoleEntity, IGlossary
{
    /**
     * Message content.
     *
     * @var string
     */
    private string $content = '';

    /**
     * Adds a line to the beginning of the content and a reversed line to the end, 
     * thereby wrapping the text.
     *
     * @var string
     */
    private string $wrap_text = '';

    /**
     * Content color.
     *
     * @var int|null
     */
    private ?int $color = null;

    /**
     * Background color.
     *
     * @var int|null
     */
    private ?int $bg = null;

    /**
     * Styles applied to content
     *
     * @var array
     */
    private array $style = [];

    /**
     * It may not take values. The message will be empty.
     * Can accept an array of the following format:
     *  [
     *      "content" => "Message content",
     *      "color" => string IGlossary::const,
     *      "bg" => string IGlossary::const,
     *      "wrap_text" => "Wrap text",
     *  ]
     * Can accept multiple arguments, they will be interpreted in the following 
     * order: content, color, bg, wrap_text
     */
    public function __construct()
    {
        $args_num = func_num_args();

        $content = $wrap_text = '';
        $color = $bg = null;

        if ($args_num > 0) {
            if ($args_num == 1 && is_array(func_get_arg(0))) {
                $params = func_get_arg(0);

                $content = isset($params['content']) ? $params['content'] : $this->content;
                $color = isset($params['color']) ? $params['color'] : $this->color;
                $bg = isset($params['bg']) ? $params['bg'] : $this->bg;
                $wrap_text = isset($params['wrap_text']) ? $params['wrap_text'] : $this->bg;
            } else {
                $content = func_get_arg(0);

                if ($args_num > 1) {
                    $color = func_get_arg(1);
                }

                if ($args_num > 2) {
                    $bg = func_get_arg(2);
                }

                if ($args_num > 3) {
                    $wrap_text = func_get_arg(3);
                }
            }

            $this->content = $content;

            if ($color !== null) {
                if (!is_string($color) && !isset(self::COLORS[strtolower($color)])) {
                    throw new \Exception();
                }

                $this->color = intval(3 . self::COLORS[strtolower($color)]);
            }

            if ($bg !== null) {
                if (!is_string($bg) && !isset(self::COLORS[strtolower($bg)])) {
                    throw new \Exception();
                }

                $this->bg = intval(4 . self::COLORS[strtolower($bg)]);
            }

            if (is_string($wrap_text) && $wrap_text !== '') {
                $this->wrap_text = $wrap_text;
            }
        }
    }

    /**
     * Formats a message based on a style object.
     *
     * @param Console\Styles\AStyle $style Style Object
     * 
     * @return self
     */
    public function setStyle(AStyle $style): self
    {
        if ($style->color !== null) {
            $this->color = intval(3 . $style->color);
        }
        
        if ($style->bg !== null) {
            $this->bg = intval(4 . $style->bg);
        }
        
        if ($style->style !== null) {
            $this->style[] = $style->style;
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

        $this->color = intval(3 . self::COLORS[strtolower($color)]);

        return $this;
    }

    public function bg(string $color): self
    {
        if (!self::COLORS[strtolower($color)]) {
            throw new \Exception();
        }

        $this->bg = intval(4 . self::COLORS[strtolower($color)]);

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

    public function reset(): self
    {
        $this->color = $this->bg = null;
        $this->wrap_text = '';
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

        return "\033[" . $code . $this->wrap_text . $this->content . strrev($this->wrap_text) . "\033[0m";
    }

    public function __toString()
    {
        $this->write('');
    }
}