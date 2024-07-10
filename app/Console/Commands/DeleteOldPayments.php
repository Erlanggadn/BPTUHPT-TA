<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ModPembayaranSapi;
use Carbon\Carbon;

class DeleteOldPayments extends Command
{
    protected $signature = 'payments:delete-old';

    protected $description = 'Delete old payments if not updated within 15 days';

    public function handle()
    {
        $payments = ModPembayaranSapi::whereNull('dbeli_sudah')
            ->where('created_at', '<=', Carbon::now()->subDays(15))
            ->get();

        foreach ($payments as $payment) {
            $payment->delete();
        }

        $this->info('Old payments deleted successfully.');
    }
}
