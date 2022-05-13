<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlockUser extends Model
{
    protected $table = 'blocked_mail';
    protected $fillable = [
        'requestor', 'block'
    ];

}
