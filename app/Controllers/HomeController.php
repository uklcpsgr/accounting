<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\Attributes\Get;
use App\Attributes\Post;
use App\Attributes\Put;
use App\View;

class HomeController
{

    #[Get('/')]
    #[Get('/home')]
    public function index(): View
    {
        return View::make('index');
    }

    #[Post('/')]
    public function store()
    {

    }

    #[Put('/')]
    public function update()
    {

    }
}
