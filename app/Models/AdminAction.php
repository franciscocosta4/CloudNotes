<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminAction extends Model
{
    use HasFactory;
    protected $table = 'admin_actions';

    protected $fillable= ['admin_id','message','seen'];
}
