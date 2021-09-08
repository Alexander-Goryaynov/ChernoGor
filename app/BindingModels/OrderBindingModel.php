<?php


namespace App\BindingModels;


class OrderBindingModel
{
    public int $notaryId;
    public int $subcategoryId;
    public string $consultationDate;
    public string $consultationTime;

    public function __construct(
        int $notaryId, int $subcategoryId,
        string $consultationDate, string $consultationTime
    )
    {
        $this->notaryId = $notaryId;
        $this->subcategoryId = $subcategoryId;
        $this->consultationDate = $consultationDate;
        $this->consultationTime = $consultationTime;
    }
}
