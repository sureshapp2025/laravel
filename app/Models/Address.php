<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    
    // Explicitly define real table name just in case, typical for legacy db.
    protected $table = 'address';
    
    // Primary key mapping
    protected $primaryKey = 'Id';

    // Disabling default timestamps if the database uses CreateDate/ModifyDate, 
    // or mapping them using custom constants 
    const CREATED_AT = 'CreateDate';
    const UPDATED_AT = 'ModifyDate';

    protected $fillable = [
        'Type', 'AccountCode', 'CompanyName', 'ALine1', 'ALine2', 'Location', 
        'Pincode', 'StateCode', 'State', 'Country', 'PAN', 'GSTNo', 
        'ContactName', 'Phone', 'Email', 'CreditDays', 'CreateBy', 'ModifyBy'
    ];
}
