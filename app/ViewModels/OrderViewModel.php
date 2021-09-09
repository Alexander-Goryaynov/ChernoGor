<?php


namespace App\ViewModels;


use App\Enums\OrderStatus;

class OrderViewModel
{
    public int $id;
    public ?string $user_email;
    public ?string $created_at;
    public string $subcategory_name;
    public string $notary_fio;
    public string $address;
    public string $consultation_datetime;
    public float $price;
    public string $status;

    public function __construct(
        int $id, string $subcategory_name, string $notary_fio,
        string $address, string $consultation_datetime, float $price,
        string $status
    )
    {
        $this->id = $id;
        $this->subcategory_name = $subcategory_name;
        $this->notary_fio = $notary_fio;
        $this->address = $address;
        $this->consultation_datetime = $consultation_datetime;
        $this->price = $price;
        $this->status = $status;
    }


}
