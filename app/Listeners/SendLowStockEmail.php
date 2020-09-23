<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Events\ProductReachedMinimumQuantity;
use App\Mail\LowStockEmail;
use Illuminate\Support\Facades\Storage;

class SendLowStockEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ProductReachedMinimumQuantity $event)
    {
        $user = User::where('role', 1)->select("id", "email")->first();
        Mail::to($user)->send(new LowStockEmail($event->user, $event->product));
    }
}
