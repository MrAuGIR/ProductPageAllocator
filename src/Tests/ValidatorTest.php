<?php

namespace MrAuGir\Paginator\Tests;

use MrAuGir\Paginator\Cursor\Cursor;
use MrAuGir\Paginator\Layout\LayoutFactory;
use MrAuGir\Paginator\Tests\objects\TemplateFaker;
use MrAuGir\Paginator\Validator;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    public function testValidate(): void
    {
        $validator = new Validator();

        $layout = LayoutFactory::create(8,8);

        // template trop grand
        $template = TemplateFaker::create(8,9);
        $this->assertFalse($validator->validateSlot($template, $layout));

        // template bonne taille
        $template = TemplateFaker::create(8,2);
        $this->assertTrue($validator->validateSlot($template, $layout));

        // template positionne en 0,0
        $layout->initCursor((new Cursor(0,0)));
        $template = TemplateFaker::create(8,2);
        $this->assertTrue($validator->validPosition($template, $layout));

        // template trop grand en longeur positionne en {8,0}
        $layout->initCursor((new Cursor(8,0)));
        $template = TemplateFaker::create(8,2);
        $this->assertFalse($validator->validPosition($template, $layout));

        // template trop grand en hauteur positionne en {8,0}
        $layout->initCursor((new Cursor(8,0)));
        $template = TemplateFaker::create(1,16);
        $this->assertFalse($validator->validPosition($template, $layout));

        // template trop grand en hauteur et en largeur positionne en {8,0}
        $layout->initCursor((new Cursor(8,0)));
        $template = TemplateFaker::create(16,16);
        $this->assertFalse($validator->validPosition($template, $layout));
    }
}