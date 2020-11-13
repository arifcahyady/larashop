<?php

namespace App\Model;
use App\Model\Review;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

protected $fillable = [
		'name','detail','price','stock','discount','image'
    ];
    
    public function getImage()
    {
    	if (!$this->image) {
    		
    		return asset('images/bg_1.png');
    	}

    	return asset('images/' . $this->image);
    }

    public function reviews()
    {


    	return $this->hasMany(Review::class);
    }
}
