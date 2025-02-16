<?php

namespace App\Console\Commands;

use App\Models\Agenda;
use Illuminate\Console\Command;

class UpdateAgendaStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-agenda-status';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Memperbarui status agenda berdasarkan waktu saat ini';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $agendas = Agenda::all();

        foreach ($agendas as $agenda) {
            $agenda->updateStatus();
        }

        $this->info('Status agenda diperbarui.');
    }
}
