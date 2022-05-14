<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeTable extends Model
{
    use HasFactory;

      protected $table ='time_tables';

    protected $fillable = [
        'lang_id',
        'time_categories_id',
        'title',
        'slug',
        'image',
        'date',
        'day',
        'start_time',
        'end_time',
        'trainer',
        'color',
        'content',
        'meta_tags',
        'meta_description',
        'status',
        
        
    ];



    public function timecategories(){
    return $this->belongsTo(TimeCategory::class,'time_categories_id','id');
    }


}
