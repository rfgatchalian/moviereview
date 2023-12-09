<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rating extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'ratings';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const RATE_SELECT = [
        '1' => '1',
        '2' => '2',
        '3' => '3',
        '4' => '4',
        '5' => '5',
    ];

    protected $fillable = [
        'movie_id',
        'user_id',
        'rate',
        'review',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class, 'movie_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
