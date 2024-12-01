<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historical_Transaction extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'historical_transactions';
}
