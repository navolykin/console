<?php 

declare(strict_types=1);

namespace Console\Tools;

interface ITrancater
{
    public function truncate(int $limit);
}
