<?php

namespace Database\Seeders\Kriptografi;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class Message extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('messages')->insert([
            [
                'sender_id' => 1,
                'recipient_id' => 1,
                'content_type' => 'text',
                'encrypted_payload' => 'ENCRYPTED_MESSAGE_1',
                'file_name' => null,
                'file_size' => null,
            ],
            [
                'sender_id' => 1,
                'recipient_id' => 1,
                'content_type' => 'text',
                'encrypted_payload' => 'ENCRYPTED_MESSAGE_2',
                'file_name' => null,
                'file_size' => null,
            ],
        ]);
    }
}
