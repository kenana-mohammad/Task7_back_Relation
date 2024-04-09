<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class phone extends Model
{
    use HasFactory;
       protected $fillable =[
        'number','employee_id'

       ];
    //one to one
     public function employee(){
         return $this->beLongsTo(employee::class);
     }
}
