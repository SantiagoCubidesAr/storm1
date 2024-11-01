<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status',
        'fullname',
        'id_gender',
        'photo',
        'phone',
        'address',
        'email',
        'password',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    public function administrator() {
        return $this->hasOne(Administrator::class);
    }

    public function driver() {
        return $this->hasOne(Driver::class);
    }

    public function student() {
        return $this->hasOne(Student::class);
    }

    public function tutor() {
        return $this->hasOne(Tutor::class);
    }

    public function genders() {
        return $this->belongsTo(Gender::class, 'id_gender');
    }

    public function status() {
        return $this->belongsTo(Status::class, 'id_status');
    }

    public function scopeNames($users, $q) {
        if (trim($q)) {
            $users->where('fullname', 'LIKE', "%$q%");
        }
    }
}
