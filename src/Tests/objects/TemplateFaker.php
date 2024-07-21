<?php

namespace MrAuGir\Paginator\Tests\objects;

use MrAuGir\Paginator\Template\TemplatePaginatorInterface;

class TemplateFaker implements TemplatePaginatorInterface
{
    public function __construct(
        private int $columns,
        private int $rows,
    )
    {
    }

    /**
     * @return TemplatePaginatorInterface[]
     */
    public static function getListeTemplate():array
    {
        return [
            0 => TemplateFaker::create(6,2),
            1 => TemplateFaker::create(2,2),
            2 => TemplateFaker::create(6,2),
            4 => TemplateFaker::create(6,4),
            5 => TemplateFaker::create(8,8),
            6 => TemplateFaker::create(6,2),
            7 => TemplateFaker::create(2,1),
            8 => TemplateFaker::create(2,1),
        ];
    }

    public function getSlots(): int
    {
        return $this->rows * $this->columns;
    }

    public function getLenthInColumn(): int
    {
        return $this->columns;
    }

    public function getHeightInRows(): int
    {
        return $this->rows;
    }

    public static function create(int $columns, int $rows):self
    {
        return new self($columns, $rows);
    }
}