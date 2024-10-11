<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
// use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use HasRoles, HasApiTokens, HasFactory, Notifiable, LogsActivity;

    const INACTIVE = 0;
    const ACTIVE = 1;

    const RECEIVER = 'RECEIVER';
    const HANDOVER = 'HANDOVER';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

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

    public function getFullNameAttribute()
    {
        return ucwords($this->first_name . ' ' . $this->last_name);
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public static function getAllUsers()
    {
        return User::where('role_id', '!=', 1)->count();
    }

    public static function getAllActiveUsers()
    {
        return User::whereStatus(User::ACTIVE)->where('role_id', '!=', 1)->count();
    }

    public static function getAllIncativeUsers()
    {
        return User::whereStatus(User::INACTIVE)->where('role_id', '!=', 1)->count();
    }

    public function designation()
    {
        return $this->belongsTo(Desigination::class, 'designation_id', 'id');
    }
    public function signature()
    {
        return $this->hasOne(UserSignature::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = Auth::id();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function costCenter()
    {
        return $this->belongsTo(CostCenter::class, 'cost_center', 'id');
    }

    public function timelines()
    {
        return $this->hasMany(Activity::class, 'causer_id', 'id')->where('causer_type', 'App\Models\User');
    }

    // Customize log description
    public function getDescriptionForEvent(string $eventName): string
    {
        return "User has been {$eventName} by " . optional(Auth::user())->full_name;
    }

    public function assignTaksIds()
    {
        return $this->hasMany(TaskTeam::class, 'assigned_user_id', 'id');
    }

    public function allowances()
    {
        return $this->hasMany(UserAllowance::class, 'allowance_owner_id', 'id');
    }

    public function courierReceiverHandover()
    {
        return $this->hasMany(CourierReceiverHandover::class, 'user_id', 'id');
    }

    protected static function booted()
    {
        if (!isSuperAdmin() && Auth::check()) {
            static::addGlobalScope('filterData', function (Builder $builder) {
                $builder->where('role_id', '!=', 1);
            });
        }
    }

    public function appliedLeaves()
    {
        return $this->hasMany(Leave::class, 'user_id', 'id')->where('status', 1);
    }

    public function getLeavesCount()
    {
        return $this->appliedLeaves()->sum('total_days');
    }

    public function getLeavesBalance()
    {
        return $this->leaves - $this->getLeavesCount();
    }

    public function trip()
    {
        return $this->hasMany(Trip::class, 'driver_id', 'id');
    }
}
