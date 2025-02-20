<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use Notifiable;
    use HasFactory;
    use Searchable;
    use SoftDeletes;
    use HasApiTokens;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'password',
        'phone_number_verified_at',
        'email_verified_at',
        'ward_id',
        'subcounty_id',
        'dob',
        'gender',
        'county_id',
        'address',
        'nationality',
        'user_code',
        'last_login_at',
        'status'
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
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    protected $searchableFields = ['*'];

    public function officer()
    {
        return $this->belongsTo(Officer::class);
    }
    public function county()
    {
        return $this->belongsTo(County::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'nationality', 'id');
    }
    public function subcounty()
    {
        return $this->belongsTo(Subcounty::class);
    }
    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }
    public function isSuperAdmin(): bool
    {
        return $this->hasRole('admin');
    }
    public function getProfilePhotoUrlAttribute()
    {
        $user = Auth::user();

        if ($user) {
            return $user->profile_photo_path;
        }
        return null;
    }
}
