<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Post extends Model
{
    use Sluggable;

    const NUMBER_SLIDER_MAIN = 3;
    const NUMBER_SLIDER_SIDE = 2;
    const NUMBER_LASTEST_PAGINATE_TAKE = 12;
    const NUMBER_LASTEST_PAGINATE = 4;
    const NUMBER_MORENEWS_SKIP = 5;
    const NUMBER_MORENEWS_PAGINATE = 4;
    const UPLOAD_LINK = 'upload/posts/';
    const NUMBER_PAGENATE_SEARCH = 10;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'subtitle',
        'content',
        'video',
        'img',
        'status',
        'avg_rate',
    ];

    protected $rule_approve_post = [
        'title' => 'required',
    ];

    protected function validateApprovePost(array $data)
    {
        return Validator::make($data, $this->rule_approve_post);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    protected function sliders()
    {
        $post = $this->where('status', 2)->orderBy('created_at', 'desc');
        $slider['main'] = $post->take(self::NUMBER_SLIDER_MAIN)
            ->get();
        $slider['side'] = $post->skip(self::NUMBER_SLIDER_MAIN)
            ->take(self::NUMBER_SLIDER_SIDE)
            ->get();

        return $slider;
    }

    protected function lastest()
    {
        return $this->where('status', 2)
            ->orderBy('created_at', 'desc')
            ->first();
    }

    protected function lastestPaginate()
    {
        $lastestPaginate = $this->where('status', 2)
            ->orderBy('created_at', 'desc')
            ->take(self::NUMBER_LASTEST_PAGINATE_TAKE)
            ->paginate(self::NUMBER_LASTEST_PAGINATE);

        return $lastestPaginate;
    }

    protected function moreNews()
    {
        $moreNews = $this->where('status', 2)->orderBy('created_at', 'desc')
            ->skip(self::NUMBER_MORENEWS_SKIP)
            ->paginate(self::NUMBER_MORENEWS_PAGINATE);

        return $moreNews;
    }

}
