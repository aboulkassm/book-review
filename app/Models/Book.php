<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Book extends Model
{
    use HasFactory;

    public function reviews()
    {
        return $this->hasMany(\App\Models\Review::class);
    }
    public function scopeTitle(Builder $query, string $title): Builder
    {
        return $query->where('title', 'LIKE', '%' . $title . '%');
    }

    public function scopeWithReviewsCount(Builder $query, $from = null, string $to = null): Builder
    {
        return $query->withCount('reviews');
    }

    public function scopeWithAvgRating(Builder $query, $from = null, string $to = null): Builder
    {
        return $query->withAvg('reviews', 'rating');
    }


    public function scopePopular(Builder $query, $from = null, string $to = null): Builder
    {
        return $query->withReviewsCount($from, $to)->orderBy('reviews_count', 'desc');
    }

    public function scopeHighestRated(Builder $query, $from = null, string $to = null): Builder
    {
        return $query->withAvgRating($from, $to)->orderBy('reviews_avg_rating', 'desc');
    }

    public function scopeMinReviews(Builder $query, int $minReviews): Builder
    {
        return $query->having('reviews_count', '>=', $minReviews);
    }
    private static function dateRangeFilter(Builder $query, $from = null, $to = null)
    {
        if ($from && !$to) {
            return $query->where('created_at', '>=', $from);
        }
        if (!$from && $to) {
            return $query->where('created_at', '<=', $to);
        }
        if ($from && $to) {
            return $query->whereBetween('created_at', [$from, $to]);
        }
        return $query;
    }
    public function scopePopularInLastMonth(Builder $query): Builder
    {
        return $query->popular(now()->subMonth(), now())
            ->highestRated(now()->subMonth(), now())
            ->minReviews(2);
    }
    public function scopePopularLast6Months(Builder $query): Builder
    {
        return $query->popular(now()->subMonths(6), now())
            ->highestRated(now()->subMonths(6), now())
            ->minReviews(5);
    }
    public function scopeHighestRatedInLastMonth(Builder $query): Builder
    {
        return $query->highestRated(now()->subMonth(), now())
            ->popular(now()->subMonth(), now())
            ->minReviews(2);
    }
    public function scopeHighestRatedInLast6Months(Builder $query): Builder
    {
        return $query->highestRated(now()->subMonths(6), now())
            ->popular(now()->subMonths(6), now())
            ->minReviews(5);
    }
    protected static function boot()
    {
        parent::boot();

        static::updated(fn(Book $book)
            => cache()->forget('book:' . $book->id));
        static::deleted(fn(Book $book)
            => cache()->forget('book:' . $book->id));
    }
}
