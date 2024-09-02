<?php

namespace App\Listeners;

use App\Http\Controllers\StatusController;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class Updatemedicinesamounts
{
    /**
     * Create the event listener.
     */
    public function __construct(OrderStatusChanged $event)
    {
        $order = $event->order;
        $orderController = new StatusController();
        $orderController->updateDrugQuantities($order);
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        //
    }
}
