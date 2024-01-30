<?php

namespace App\Actions;

use App\Models\Message;

class StoreMessage {

    public function handle($validatedData)
    {
        return Message::create($validatedData);
    }
}