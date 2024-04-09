<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    use HasFactory;
    protected $fillable=[
        'name','salary','company_id','age','email'
    ];

      //one to many company
        public function company(){
            return $this->belongsTo(Company::class);
        }

        ///one to one
        public function phone(){
            return $this->hasOne(phone::class);
        }

        //many to many
             public function services(){
                return $this->beLongsToMany(service::class,table:'services_empolyee');
             }
}
