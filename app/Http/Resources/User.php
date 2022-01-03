<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Order;
use App\Http\Resources\Order as OrderResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'nickname' => $this->nickname,
            'phone_number' => $this->phone_number,
            'gender' => $this->gender,
            'latest_order' => new OrderResource(
                Order::where('email', $this->email)
                ->orderBy('paid_at', 'desc')->get()->first()
            ),
        ];
    }
}
