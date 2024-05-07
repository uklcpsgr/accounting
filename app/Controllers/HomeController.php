<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\Attributes\Get;
use App\Attributes\Post;
use App\Attributes\Put;
use App\Services\InvoiceService;
use App\View;

class HomeController
{
    public function __construct(private InvoiceService $invoiceService)
    {
    }

    #[Get('/')]
    #[Get('/home')]
    public function index(): View
    {
        $this->invoiceService->process([], 25);

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
