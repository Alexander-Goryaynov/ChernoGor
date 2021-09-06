<?php


namespace App\ViewModels;


class NotaryViewModel
{
    public int $id;
    public string $fio;
    public string $description;
    public string $photo;
    public string $office_address;
    public string $qualification_name;

    public function __construct(
        int $id, string $fio, string $description,
        string $photo, string $office_address, string $qualification_name
    )
    {
        $this->id = $id;
        $this->fio = $fio;
        $this->description = $description;
        $this->photo = $photo;
        $this->office_address = $office_address;
        $this->qualification_name = $qualification_name;
    }
}
