<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class AnnouncementFilter extends ApiFilter
{
    protected $safeParams = [
        'title' => ['eq'],
        'localization' => ['eq'],
        'userId' => ['eq']
    ];

    protected $columnMap = [
        'userId' => 'id_user'
    ];
    
}