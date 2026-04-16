<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $table = 'expense';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'CCode',
        'Category',
        'JobNo',
        'Date',
        'Reference',
        'Description',
        'AccountCode',
        'CompanyName',
        'MAWB_MBL',
        'Currency',
        'ExRate',
        'Total',
        'Month'
    ];
}
