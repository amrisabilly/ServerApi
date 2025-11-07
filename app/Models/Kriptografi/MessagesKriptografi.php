<?php

namespace App\Models\Kriptografi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MessagesKriptografi extends Model
{
    use HasFactory;

    protected $table = 'messages';


    protected $fillable = [
        'sender_id',
        'recipient_id',
        'content_type',
        'encrypted_payload',
        'file_name',
        'file_size',
    ];

    public function sender()
    {
        return $this->belongsTo(UsersKriptografi::class, 'sender_id');
    }

    public function recipient()
    {
        return $this->belongsTo(UsersKriptografi::class, 'recipient_id');
    }
}
