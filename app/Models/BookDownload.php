<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookDownload extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'book_id',
        'downloaded_at',
    ];

    protected $dates = ['downloaded_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
