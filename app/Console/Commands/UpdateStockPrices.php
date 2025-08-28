<?php

namespace App\Console\Commands;

use App\Services\AssetPriceService;
use Illuminate\Console\Command;

class UpdateStockPrices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assets:update-stocks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update stock prices from Alpha Vantage API';

    /**
     * Execute the console command.
     */
    public function handle(AssetPriceService $priceService)
    {
        $this->info('Updating stock prices...');
        
        try {
            $priceService->updateStockPrices();
            $this->info('Stock prices updated successfully!');
        } catch (\Exception $e) {
            $this->error('Failed to update stock prices: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
