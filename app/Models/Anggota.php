<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggota';

    protected $guarded = ['id'];

    public function user() : BelongsTo{
        return $this->belongsTo(User::class);
    }
}
