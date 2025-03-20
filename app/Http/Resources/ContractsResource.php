<?php

namespace App\Http\Resources;

use App\Services\UserServices;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContractsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        $user = (new UserServices)->getUser($this->client_id);
        return [
            'id'                    => $this->id,
            'client_id'             => $this->client_id,
            'amount'                => $this->amount,
            'commercial_manager_id' => $this->commercial_manager_id,
            'regional_manager_id'   => $this->regional_manager_id,
            'superintendent_id'     => $this->superintendent_id,
            'status'                => $this->status,
            'created_at'            => $this->created_at,
            'updated_at'            => $this->updated_at,
            'client'                => $user['error'] ? null : $user['data'],
            'commercialManager'     => $this->commercialManager,
            'regionalManager'       => $this->regionalManager,
            'superintendent'        => $this->superintendent
        ];
    }
}
