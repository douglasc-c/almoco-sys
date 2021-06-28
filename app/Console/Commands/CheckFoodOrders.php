<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\FoodOrder;

class CheckFoodOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:checkFoodOrders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $foodOrders = FoodOrder::join('menus', 'menus.id', '=', 'food_orders.menu_id')
                        ->where('food_orders.status_id', 2)
                        ->update([
                            'food_orders.status_id' => 5
                        ]);

        if($foodOrders){
            $this->info('Ordens verificadas');
        }
        
    }
}
