<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class service extends Model
{
    use HasFactory;
    protected $fillable =[
        'name'
    ];
    //many to many

    public function Employees_services(){
        return $this->beLongsToMany(employee::class, table:'services_empolyee');
    }

}
