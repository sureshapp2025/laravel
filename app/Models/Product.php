<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'c_code',
        'particulars',
        'hsn',
        'gst',
        'igst',
        'cgst',
        'sgst',
        'except_particulars',
        'is_service',
        'active'
    ];
}
