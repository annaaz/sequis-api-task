<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FriendsRequest extends Model
{
    protected $table = 'friends_request';
    protected $fillable = [
        'requestor', 'to','status'
    ];

}
