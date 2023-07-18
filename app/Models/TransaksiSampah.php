<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TransaksiSampah extends Pivot
{
    use HasFactory;

    public $incrementing = true;

    protected $guarded = ['id'];
}
