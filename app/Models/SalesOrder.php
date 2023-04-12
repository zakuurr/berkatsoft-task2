<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesOrder extends Model
{
    use HasFactory,SoftDeletes;

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function sales_order_details()
    {
        return $this->hasMany(SalesOrderDetail::class);
    }

    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->locale('id_ID')->isoFormat('D MMMM Y');
    }

    public function getFormattedGrandTotalAttribute()
    {
        return 'Rp ' . number_format($this->grand_total, 0, ',', '.');;
    }

    protected $appends = [
        'formatted_created_at',
        'formatted_grand_total',
    ];

    protected $guarded = ['id'];
}
