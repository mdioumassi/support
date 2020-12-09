<?php


namespace App\Event;



use App\Entity\DoDonate;
use Symfony\Contracts\EventDispatcher\Event;

class DonateSuccessEvent extends Event
{
    private $donate;

    public function __construct(DoDonate $donate)
    {
        $this->donate = $donate;
    }

    public function getDonate(): DoDonate
    {
        return $this->donate;
    }
}