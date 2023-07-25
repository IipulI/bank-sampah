<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staff';

    protected $guarded = ['staff_id'];
    protected $primaryKey = 'staff_id';

    public function user() : BelongsTo{
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
