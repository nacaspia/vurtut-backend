<?php

namespace App\Events;

use App\Models\Reservation;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow; // NOW: gecikməsin
use Illuminate\Queue\SerializesModels;

class ReservationCreated implements ShouldBroadcastNow
{
    use SerializesModels;

    public $reservation;

    public function __construct(Reservation $reservation)
    {
        // İstəsən burada yalnız lazım olan field-ları seçib array kimi verə bilərsən
        $this->reservation = $reservation->only([
            'id','company_id','user_id','date','full_name','phone',
            'place_count','person_count','text','created_at'
        ]);
    }

    public function broadcastOn()
    {
        // Hər user yalnız öz kanalını dinləsin:
        return new PrivateChannel('company.'.$this->reservation['company_id']);
    }

    public function broadcastAs()
    {
        return 'ReservationCreated';
    }
}
