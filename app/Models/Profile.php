<?php

namespace App\Models;

use App\Builder\ProfileBuilder;
use App\Services\Profile\ValueObject\DateOfBirth;
use App\Services\Profile\ValueObject\FishingStartedDate;
use App\Services\Profile\ValueObject\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_id';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_of_birth' => DateOfBirth::class,
        'fishing_started_date' => FishingStartedDate::class,
        'image' => Image::class,
    ];

    /**
     * @param [type] $query
     * @return ProfileBuilder
     */
    public function newEloquentBuilder($query): ProfileBuilder
    {
        return new ProfileBuilder($query);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
