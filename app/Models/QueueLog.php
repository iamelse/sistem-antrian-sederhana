<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QueueLog extends Model
{
    protected $guarded = ['id'];

    public function queue(): BelongsTo
    {
        return $this->belongsTo(Queue::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
