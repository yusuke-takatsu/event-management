<?php

declare(strict_types=1);

namespace App\Models;

use App\Notifications\VerifiedEmailNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasUlids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id',
        'email_verified_at',
        'remember_token',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime:Y-m-d H:i:s',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * {@inheritdoc}
     */
    public function sendEmailVerificationNotification()
    {
        Log::info('認証メール送信 (VerificationNotification) をqueueに渡します。');
        $this->notify(new VerifiedEmailNotification());
        Log::info('認証メール送信 (VerificationNotification) をqueueに渡し終えました。');
    }

    /**
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    /**
     * @return BelongsToMany
     */
    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'participations')
            ->withPivot('status');
    }
}
