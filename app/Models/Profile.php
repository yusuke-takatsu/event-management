<?php

namespace App\Models;

use App\Builder\ProfileBuilder;
use App\Casts\DateOfBirthCast;
use App\Casts\FishingStartedDateCast;
use App\Casts\ImageCast;
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
        'date_of_birth' => DateOfBirthCast::class,
        'fishing_started_date' => FishingStartedDateCast::class,
        'image' => ImageCast::class,
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
