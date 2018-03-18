<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Van;

class Rental extends Model
{
    protected $table = 'rental';
    protected $primaryKey = 'rent_id';
    protected $guarded = [
        'rent_id',
    ];

    public function van(){
    	return $this->belongsTo(Van::Class, 'plate_number');
    }

    public function getFullNameAttribute(){
        return "{$this->first_name} {$this->last_name}";
    }

    public function vanmodel(){
    	return $this->belongsTo(VanModel::Class, 'model_id');
    }

    public function setContactNumberAttribute($value){
        $contactArr = explode('-',$value);
        $this->attributes['contact_number'] = '+63'.$contactArr[0].$contactArr[1].$contactArr[2];
    }
    
}
