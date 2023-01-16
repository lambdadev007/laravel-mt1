<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceMailBuffer extends Model
{
    protected $table = 'invoice_mail_buffer';

    protected $fillable = ['email', 'type', 'name', 'phone_number', 'p_id', 'invoice_counter', 'price'];
}
