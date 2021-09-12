<?php


namespace App\ViewModels;


class AccountViewModel
{
    public string $email;
    public string $name;
    public string $created_at;
    public int $orders_count;
    public float $average_sum;
    public string $last_ordered_at;

    public function __construct(
        string $email, string $name, string $created_at,
        int $orders_count, float $average_sum, string $last_ordered_at
    )
    {
        $this->email = $email;
        $this->name = $name;
        $this->created_at = $created_at;
        $this->orders_count = $orders_count;
        $this->average_sum = $average_sum;
        $this->last_ordered_at = $last_ordered_at;
    }
}
