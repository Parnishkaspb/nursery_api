<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMoney extends Model
{
    protected $table = "user_moneys";
    use HasFactory;

    protected $fillable = [
        'id_user',
        'summa',
        'money_give',
        'percent',
        'years',
    ];

    public function ho_invest()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
