<?php

namespace MrAuGir\Paginator;

use MrAuGir\Paginator\Template\TemplatePaginatorInterface;

class Paginator
{
    public function __construct(
      private Validator $validator,
    ){}

    /**
     * @param TemplatePaginatorInterface[] $items
     * @return void
     */
    public function paginate(array $items)
    {

    }
}