<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LibraryBooksResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_merge(parent::toArray($request), [
            'borrowed_users_count' => $this->users()->count(),
            'borrowed_users_name' => $this->users->pluck('name')->implode(', '),
        ]);
    }
}
