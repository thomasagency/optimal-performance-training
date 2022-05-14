<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeCategory extends Model
{
    use HasFactory;


    protected $table = 'time_categories';

    protected $fillable = [
        'lang_id',
        'name',
        'slug',
        'status',
        
    ];


    public function timetable(){
        return $this->hasMany(TimeTable::class,'time_categories_id','id');
    }


    
}
