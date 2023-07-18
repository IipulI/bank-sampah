<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
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

    public function transaksi() : HasMany{
        return $this->hasMany(Transaksi::class);
    }

    public function tabungan() : HasOne{
        return $this->hasOne(Tabungan::class);
    }

    public function latestTransaksi() : HasOne{
        return $this->hasOne(Transaksi::class);
    }
}
