<?php


namespace App\BindingModels;


class NotaryBindingModel
{
    public string $fio;
    public string $description;
    public string $photo;
    public string $officeAddress;
    public int $qualificationId;
    /**@var int[][] */
    public array $schedule;

    /** @param int[][] $schedule */
    public function __construct(
        string $fio, string $description, string $photo,
        string $officeAddress, int $qualificationId, array $schedule
    )
    {
        $this->fio = $fio;
        $this->description = $description;
        $this->photo = $photo;
        $this->officeAddress = $officeAddress;
        $this->qualificationId = $qualificationId;
        $this->schedule = $schedule;
    }

}
