<?php

namespace App\Listeners;

use App\Events\UserSaved;

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
    public function handle(UserSaved $event): void
    {
        $user = $event->user;
        $addresses = $event->addresses;
        $user->addresses()->delete();
        $user->addresses()->createMany($addresses);
    }
}
