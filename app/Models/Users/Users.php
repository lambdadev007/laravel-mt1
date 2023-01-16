<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users';
	protected $guarded = [ 'id', 'created_at',  'updated_at' ];
    // protected $fillable = ['title', 'slug', 'designation', 'dob'];
}

