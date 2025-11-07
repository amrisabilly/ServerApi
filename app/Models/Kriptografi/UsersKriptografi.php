<?php

namespace App\Models\Kriptografi;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Crypt;

class UsersKriptografi extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users_kripto';

    /**
     * Atribut yang dapat diisi.
     */
    protected $fillable = [
        'username',
        'display_name',
        'email',
        'password',
        'public_key',
        'profile_photo_url',
        'bio',
    ];

    /**
     * Atribut yang harus disembunyikan.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * Relasi pesan yang DIKIRIM.
     */
    public function sentMessages()
    {
        return $this->hasMany(MessagesKriptografi::class, 'sender_id');
    }

    /**
     * Relasi pesan yang DITERIMA.
     */
    public function receivedMessages()
    {
        return $this->hasMany(MessagesKriptografi::class, 'recipient_id');
    }

    // Setter dan getter manual untuk display_name
    public function setDisplayNameAttribute($value)
    {
        $this->attributes['display_name'] = Crypt::encryptString($value);
    }

    public function getDisplayNameAttribute($value)
    {
        return $value ? Crypt::decryptString($value) : null;
    }

    // Setter dan getter manual untuk email
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = Crypt::encryptString($value);
    }

    public function getEmailAttribute($value)
    {
        return $value ? Crypt::decryptString($value) : null;
    }

    // Setter dan getter manual untuk bio
    public function setBioAttribute($value)
    {
        $this->attributes['bio'] = Crypt::encryptString($value);
    }

    public function getBioAttribute($value)
    {
        return $value ? Crypt::decryptString($value) : null;
    }
}
