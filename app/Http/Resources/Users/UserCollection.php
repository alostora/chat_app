<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    

    public $preserveKeys = true;

    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            
            'current_page' => $this->currentPage(),
            'total' => $this->total(),
            'count' => $this->count(),
            'per_page' => $this->perPage(),
            'current_page' => $this->currentPage(),
            'last_page' => $this->lastPage()
        ];
    }
}
