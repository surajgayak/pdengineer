<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrackingBankGuarantee extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'type',
        'start_date',
        'project_name',
        'client_name',
        'expiry_date',
        'total_amount',
        'hold_amount',
        'status'
    ];
}
