<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PrivateDebt;
use App\Notifications\DebtDueSoon;
use Carbon\Carbon;

class SendDebtNotifications extends Command
{
    protected $signature = 'debt:notify';
    protected $description = 'Envoie des notifications pour les dettes proches de l\'échéance';

    public function handle()
    {
        $today = Carbon::today();

        $debts = PrivateDebt::where('status', 'unpaid')
            ->whereNotNull('due_date')
            ->get();

        foreach ($debts as $debt) {
            $due = Carbon::parse($debt->due_date);
            $days = $today->diffInDays($due, false);

            if ($days <= 3 && $days >= 0) {
                $debt->toUser->notify(new DebtDueSoon($debt, $days));
            }
            if ($days < 0) {
                $debt->toUser->notify(new DebtDueSoon($debt, $days));
            }
        }

        $this->info('Notifications envoyées.');
    }
}