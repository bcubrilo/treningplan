<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Model\UserTreningPlanTrening;
use App\Model\TreningPlanTrening;
class KorisnikTreningObavjestenje extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $podaci;
    public function __construct($podaci)
    {
        $this->podaci = $podaci;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->subject('Trening')->view('email/treningobavjestenje')
        ->with([
            'podaci'=>$this->podaci
        ]);
    }
}
