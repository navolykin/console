<?php 

declare(strict_types=1);

namespace Console\ConsoleEntity;

use Console\Contracts\IConsoleEntity;

class Listing implements IConsoleEntity
{
    private $delimiter = '-';

    private $max_key = 0;

    private $max_value = 0;

    private $min_delimiter_count = 10;

    private $row_length_max = 150;

    private $row_length = 0;

    private $content = [];

    private $alignment = 0;

    public function __construct()
    {

    }

    private function parse(array $content): bool
    {
        foreach ($content as $key => $field) {
            if (!is_scalar($field)) {
                return false;
            }

            if (mb_strlen((string) $key) > $this->max_key) {
                $this->max_key = mb_strlen((string) $key);
            }

            if (mb_strlen((string) $field) > $this->max_value) {
                $this->max_value = mb_strlen((string) $field);
            }
        }

        return true;
    }

    public function content(array $content): self
    {
        if (!$this->parse($content)) {
            throw new \Exception();
        }

        $this->row_length = $this->max_key + $this->max_value + $this->min_delimiter_count;
        $this->content = $content;

        return $this;
    }

    private function build(): string
    {
        $table = '';

        foreach ($this->content as $key => $value) {
            $diff = strlen($value) - mb_strlen($value);
            /*$row = $key . str_pad($value, $this->row_length - mb_strlen($key) + $diff, $this->delimiter, STR_PAD_LEFT);

            if ($this->needTruncate()) {
                $rows = str_split($row, $this->row_length_max);

            }*/
            if ($this->alignment == 1) {
                $table .= str_pad((string) $key, $this->min_delimiter_count + $this->max_key, $this->delimiter) . $value . PHP_EOL;
            } else {
                $table .= $key . str_pad($value, $this->row_length - mb_strlen((string) $key) + $diff, $this->delimiter, STR_PAD_LEFT) . PHP_EOL;
            }
            
        }

        return $table;
    }

    private function needTruncate(): bool
    {
        return $this->row_length > $this->row_length_max;
    }

    public function left(): self
    {
        $this->alignment = 1;

        return $this;
    }

    public function write(string $content = ''): void
    {
        echo $this->build();
    }

    public function writeln(string $content): void
    {
        echo $this->build() . PHP_EOL;
    }
}