<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class UserFilter extends ApiFilter
{
    protected $safeParams = [
        'email' => ['eq'],
        'name' => ['eq'],
        'location' => ['eq'],
        'roleId' => ['eq']
    ];

    protected $columnMap = [
        'userId' => 'id_user',
        'roleId' => 'id_role'
    ];
    
}