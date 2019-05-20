<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contacts extends Model
{
    protected $fillable = ['first', 'last', ];
    
	public function details(){
		return $this->hasMany('App\details');
	}
}
