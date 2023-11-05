<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;
    //今まで$planet->title = $request->titleでカラムにデータを入れていたが、面倒だから自動で！
    protected $fillable = [
        'title',
        'body',
    ];

    public function user()
    {
        //記事一つは一人のユーザーに紐づけている。リレーション設計(紐づけ作業)。つまり記事からユーザーに簡単にアクセスするため
        return $this->belongsTo(User::class);
    }
    public function getImageUrlAttribute()
    {
        return Storage::url($this->image_path);
    }

    public function getImagePathAttribute()
    {
        return 'images/posts/' . $this->image;
    }
}
