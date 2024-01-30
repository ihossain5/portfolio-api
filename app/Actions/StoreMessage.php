<?php

namespace App\Actions;

use App\Models\Message;

class StoreMessage {

    public function handle(array $validatedData): Message
    {
        return Message::create($validatedData);
    }
}