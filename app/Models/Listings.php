<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listings extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'model', 'make', 'year', 'price', 'price', 'cubic', 'mileage', 'colour', 'description', 'hp', 'first_name', 'last_name', 'telephone', 'town'
    ];
    public function incrementViews($id){
        $this->increment('views',1 ,['id' => $id]);
    }
}
