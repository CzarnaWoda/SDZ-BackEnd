<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class PetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'race' => $this->race,
            'gender' => $this->gender,
            'age' => $this->age,
            'description' => $this->description,
            'image' => $this->getImageUrl(),
            'invoiceId' => $this->invoice_id,
        ];
    }

    /**
     * Get the URL of the pet's image.
     *
     * @return string|null
     */
    protected function getImageUrl()
    {
        if ($this->isExternalUrl($this->image)) {
            return $this->image; // Zwraca zewnętrzny URL, jeśli obraz jest zewnętrzny
        }

        // Jeśli obraz nie jest zewnętrzny, użyj lokalnego adresu URL
        return Storage::url($this->image);
    }

    /**
     * Check if the image URL is external.
     *
     * @param string|null $url
     * @return bool
     */
    protected function isExternalUrl($url)
    {
        return Str::startsWith($url, ['http://', 'https://']);
    }
}
