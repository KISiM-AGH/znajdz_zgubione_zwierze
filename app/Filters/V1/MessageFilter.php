<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class MessageFilter extends ApiFilter
{
    protected $safeParams = [
        'userId' => ['eq'],
        'chatId' => ['eq']
    ];

    protected $columnMap = [
        'userId' => 'id_user',
        'chatId' => 'id_chat'
    ];
    
}