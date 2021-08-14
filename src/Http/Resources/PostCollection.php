<?php


namespace Iyngaran\Advertiser\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return [
            $this->items(),
            'pagination' => [
                'per_page' => $this->perPage(),
                'current_page' => $this->currentPage(),
                'total_items' => $this->total(),
                'last_page' => $this->lastPage(),
            ],
        ];
    }
}
