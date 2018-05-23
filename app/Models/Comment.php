<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'content',
        'commentable_id',
        'commentable_type',
    ];

    protected $rule_comment = [
        'content' => 'required|string|max:1000',
    ];

    protected function validateComment(array $data)
    {
        return Validator::make($data, $this->rule_comment);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function comment()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function sortByTime()
    {
        return $this->sortBy(function ($comment) {
            return $comment->created_at;
        }, SORT_REGULAR, true);
    }
}
