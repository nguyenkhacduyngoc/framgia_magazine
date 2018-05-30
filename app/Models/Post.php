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
    const NON_USER_ID = 0;
    const POST_STATUS = [
        'pending' => 0,
        'rejected' => 1,
        'accepted' => 2,
    ];

    const SLIDER_OPTIONS = [
        '' => 'None',
        'main' => 'Main Slider',
        'side' => 'Side Slider',
    ];

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
        'slider',
    ];

    protected $rule_approve_post = [
        'title' => 'string',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($post) {
            // before delete() method call this
            $post->comments()->delete();
            $post->rates()->delete();
            $post->likes()->forceDelete();
            // do the rest of the cleanup...
        });
    }

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

    public function sortByTime()
    {
        return $this->sortBy(function ($comment) {
            return $comment->created_at;
        }, SORT_REGULAR, true);
    }

    public function setPageName($pageName)
    {
        $this->pageName = $pageName;
    }

    protected function hasCategory()
    {
        $categories = Category::where('id', '>', 0)->pluck('id')->toArray();
        return Post::whereIn('category_id', $categories);
    }

    protected function approvedPost()
    {
        return $this->hasCategory()->where('status', 2)->orderBy('created_at', 'desc');
    }

    protected function sliders()
    {
        $number_slider_main = $this->approvedPost()->where('slider', 'main')->count();
        $number_slider_side = $this->approvedPost()->where('slider', 'side')->count();
        $slider['main'] = $number_slider_main >= self::NUMBER_SLIDER_MAIN
        ? $this->approvedPost()->where('slider', 'main')->get()
        : $this->approvedPost()->take(self::NUMBER_SLIDER_MAIN)->get();

        $slider['side'] = ($number_slider_side == self::NUMBER_SLIDER_SIDE)
        ? $this->approvedPost()->where('slider', 'side')->get()
        : $this->approvedPost()->skip(self::NUMBER_SLIDER_SIDE)->take(self::NUMBER_SLIDER_SIDE)->get();

        return $slider;
    }

    protected function lastest()
    {
        return $this->hasCategory()->where('status', 2)
            ->orderBy('created_at', 'desc')
            ->firstOrFail();
    }

    protected function lastestPaginate()
    {
        $lastestPaginate = $this->hasCategory()->where('status', 2)
            ->orderBy('created_at', 'desc')
            ->where('id', '<>', $this->lastest()->id)
            ->take(self::NUMBER_LASTEST_PAGINATE_TAKE)
            ->paginate(self::NUMBER_LASTEST_PAGINATE, ['*'], 'lastest_news');

        return $lastestPaginate;
    }

    protected function moreNews()
    {
        $post = $this->where('status', 2)
            ->orderBy('created_at', 'desc')
            ->skip(self::NUMBER_MORENEWS_SKIP)->firstOrFail();
        $moreNews = $this->hasCategory()->where('status', 2)->orderBy('created_at', 'desc')
            ->where('id', '<', $post->id)
            ->paginate(self::NUMBER_MORENEWS_PAGINATE, ['*'], 'more_news');

        return $moreNews;
    }

}
