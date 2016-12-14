<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Item extends Model
{
    protected $fillable = ['body', 'user_id', 'pic_id', 'status_id'];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
