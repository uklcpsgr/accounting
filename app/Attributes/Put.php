<?php

namespace App\Attributes;

use App\Enums\HttpMethod;
use Attribute;

#[Attribute]
class Put extends Route
{
    public function __construct(string $routePath)
    {
        parent::__construct($routePath, HttpMethod::Put);
    }
}