<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
      'member_id', 'news_id', 'title', 'content',
  ];
    
    public function member()
    {
      return $this->belongsTo(Member::class);
    }

    public function news()
    {
      return $this->belongsTo(News::class);
    }
}
