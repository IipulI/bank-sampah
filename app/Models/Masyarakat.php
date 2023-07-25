<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Masyarakat extends Model
{
    use HasFactory;

    protected $table = 'masyarakat';

    protected $primaryKey = 'no_nik';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = ['id'];

    public function user() : BelongsTo{
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function transaksi() : HasMany{
        return $this->hasMany(Transaksi::class, 'no_nik', 'no_nik');
    }

    public function tabungan() : HasOne{
        return $this->hasOne(Tabungan::class, 'no_nik', 'no_nik');
    }

    public function latestTransaksi() : HasOne{
        return $this->hasOne(Transaksi::class, 'no_nik', 'no_nik');
    }
}
