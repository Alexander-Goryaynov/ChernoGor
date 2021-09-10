<?php


namespace App\ViewModels;


class ScheduleDayViewModel
{
    public string $value;
    /**@var string[] */
    public array $times;

    /**
     * @param string[] $times
     */
    public function __construct(string $value, array $times)
    {
        $this->value = $value;
        $this->times = $times;
    }
}
