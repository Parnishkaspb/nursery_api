<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkWithMoney extends Model
{
    use HasFactory;
    protected $table = 'work_with_moneys';
    protected $fillable = ['id_reason', 'id_user', 'money', 'numberdoc'];

    public function reason()
    {
        return $this->belongsTo(Reason::class, 'id_reason');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
