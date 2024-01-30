<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PortfolioResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'cover_photo' => url("uploaded-files/{$this->cover_photo}"),
            'url'         => $this->url ?? '#',
        ];
    }
}
