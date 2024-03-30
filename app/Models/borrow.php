<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class borrow extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function auther(): BelongsTo
    {
        return $this->belongsTo(auther::class,'auther_id','id');
    }
    
    public function book(): BelongsTo
    {
        return $this->belongsTo(book::class, 'book_id', 'id');
    }
}
