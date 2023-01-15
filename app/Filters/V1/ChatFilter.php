<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class ChatFilter extends ApiFilter
{
    protected $safeParams = [
        'name' => ['eq']
    ];

    protected $columnMap = [
    ];
    
}