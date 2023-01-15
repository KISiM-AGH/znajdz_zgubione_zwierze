<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class MediaFileFilter extends ApiFilter
{
    protected $safeParams = [
        'name' => ['eq'],
        'type' => ['eq'],
        'userId' => ['eq']
    ];

    protected $columnMap = [
        'userId' => 'id_user'
    ];
    
}