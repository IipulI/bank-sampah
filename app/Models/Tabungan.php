<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tabungan extends Model
{
    use HasFactory;

    protected $table = 'tabungan';

    protected $guarded = ['tabugnan_id'];
    protected $primaryKey = 'tabungan_id';
}
