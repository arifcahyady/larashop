<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelapak extends Model
{
    protected $table = 'pelapak';
    protected $guarded = ['id'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

}
