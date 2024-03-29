<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;
    protected $fillable=[
        'invoice_id',
        'type_id',
        'title',
        'amount',
        'description',
    ];

    public function types(){
        return $this->hasOne('App\Models\Type','id','invoice_type');
    }
}
