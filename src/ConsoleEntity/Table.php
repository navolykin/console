<?php 

declare(strict_types=1);

namespace Console\ConsoleEntity;

use Console\ConsoleEntity\IConsoleEntity;

class Table implements IConsoleEntity
{
    private $content = [];

    private $column_sizes = [];

    public function __construct(array $content = [])
    {
        if (!$this->valid($content)) {
            throw new \Exception();
        }

        $this->content = $content;
    }

    private function parse(array &$content): bool
    {
        foreach ($content as $row_num => &$row) {
            if (is_array($row)) {
                $this->column_sizes[$row_num] = 0;

                foreach ($row as &$field) {
                    if (!is_scalar($field)) {
                        return false;
                    }

                    if ($this->column_sizes[$row_num] < strlen($field = (string) $field)) {
                        $this->column_sizes[$row_num] = strlen($field);
                    }
                    
                }
            } else {
                return false;
            }

            return true;
        }
    } 

    private function build(): string
    {
        
    } 

    public function write(string $content): void
    {

    }

    public function writeln(string $content): void
    {

    }
}