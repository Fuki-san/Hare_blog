<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function user()
    {
    //記事一つは一人のユーザーに紐づけている。リレーション設計(紐づけ作業)。つまり記事からユーザーに簡単にアクセスするため
        return $this->belongsTo(User::class);
    }
}
