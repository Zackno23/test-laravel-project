<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
	protected $fillable=[
		'name',
		'age',
		'sex',
		'memo'
	];
	public function scopeNameFilter($query, string $name = null){
		if(!$name){
			return $query;
		}
		return $query->where('name', 'like', '%'.$name.'%');
	}
	public function scopeSexFilter($query, string $sex = null){
		if(!$sex){
			return $query;
		}
		return $query->where('sex',$sex);
	}
	public function scopeMemoFilter($query, string $memo = null){
		if(!$memo){
			return $query;
		}
		return $query->where('memo', 'like', '%'.$memo.'%');
	}
	
}
