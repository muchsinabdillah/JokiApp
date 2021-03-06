<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;

    protected $table = "merchants";

    protected $guarded = ['id'];

    // protected $fillable = [
    //     'merchant_name',
    //     'phone_number',
    //     'merchant_type',
    //     'status',
    // ];
}
