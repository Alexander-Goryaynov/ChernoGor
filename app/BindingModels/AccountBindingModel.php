<?php


namespace App\BindingModels;


class AccountBindingModel
{
    public string $name;
    public string $password;
    public ?string $newPassword;

    public function __construct(string $name, string $password, ?string $newPassword)
    {
        $this->name = $name;
        $this->password = $password;
        $this->newPassword = $newPassword;
    }
}
