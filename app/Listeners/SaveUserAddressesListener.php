<?php

namespace App\Listeners;

use App\Events\UserSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SaveUserAddressesListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserSaved $event) : void
    {
        $user      = $event->user;
        $addresses = $event->addresses;
        $user->addresses()->delete();
        $user->addresses()->createMany($addresses);
    }
}
