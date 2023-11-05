<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    //ユーザーが入力したデータがbody要素以外をデータベースに取り込まないように。つまりデータベースに入力データを取り込むときの整合性とセキュリティ対策
    protected $fillable = [
        'body',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    //コメントは1つの記事/ユーザーと紐づいているから、コメントの設計図に1つに紐づき処理(belongsTo)をかく
    //反対にユーザーは複数のコメントと紐づいているから、Userの設計図に複数の紐づき処理(hasMany)をかく
}
