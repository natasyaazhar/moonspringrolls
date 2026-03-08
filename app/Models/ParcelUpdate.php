<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParcelUpdate extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        // 'tracking_num',
        'id',
        'name', 
        'email',
        'parcel_status',
        'created_at',
        'updated_at'
    ];

    
    public static function createParcel ($name, $email, $parcel_status) {

        return self::updateOrCreate(
            [
                'name'          => $name,
                'email'         => $email,
                'parcel_status' => $parcel_status,
                'created_at'    => now(),  
                'updated_at'    => null
            ]
        );
    }

     
}
