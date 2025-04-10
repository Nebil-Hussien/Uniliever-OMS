<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class client extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'client_address',
        'client_mobile',
        'client_businessName',
        'client_businessType',
        'client_BusinessRegisteration',
        'client_latitude',
        'client_longtude',   
        'client_yearsInBusiness',
        'distro_id',

        'client_verificationData',

    ];

    public function user() {
        return $this->hasone(User::class);
    }
    public function client() {
        return $this->hasone(key_distro::class);
    }
}
