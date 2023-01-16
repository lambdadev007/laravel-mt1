<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repairs extends Model
{
    protected $table = 'repairs';

    protected $fillable = ['invoice_counter_date', 'invoice_counter_int'];
}
