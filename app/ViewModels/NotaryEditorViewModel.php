<?php


namespace App\ViewModels;


class NotaryEditorViewModel
{
    public string $fio;
    public string $description;
    public string $photo;
    public string $office_address;
    public int $qualification_id;
    /** @var int[][] */
    public array $schedule;

    /** @param int[][] $schedule */
    public function __construct(
        string $fio, string $description, string $photo,
        string $office_address, int $qualification_id, array $schedule
    )
    {
        $this->fio = $fio;
        $this->description = $description;
        $this->photo = $photo;
        $this->office_address = $office_address;
        $this->qualification_id = $qualification_id;
        $this->schedule = $schedule;
    }
}
