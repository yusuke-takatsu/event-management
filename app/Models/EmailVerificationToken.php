<?php

namespace App\Models;

use App\Builder\EmailVerificationTokenBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmailVerificationToken extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_id';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    /**
     * @param [type] $query
     * @return EmailVerificationTokenBuilder
     */
    public function newEloquentBuilder($query): EmailVerificationTokenBuilder
    {
        return new EmailVerificationTokenBuilder($query);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
