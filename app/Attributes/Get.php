<?php

namespace App\Attributes;

use App\Enums\HttpMethod;
use Attribute;

#[Attribute(Attribute::TARGET_METHOD|Attribute::IS_REPEATABLE)]
class Get extends Route
{
}