<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InfoResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'name'        => $this->name,
            'photo'       => $this->photo,
            'designation' => $this->designation,
            'about'       => $this->about,
            'email'       => $this->email,
            'phone'       => $this->phone,
            'phone_2'     => $this->phone_2,
            'address'     => $this->address,
        ];
    }
}
