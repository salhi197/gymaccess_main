<?php



// app/Console/Commands/TruncateEntreTable.php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\EntreService;

class TruncateEntreTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'entre:truncate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Truncate the entre table once a day';

    protected $entreService;

    /**
     * Create a new command instance.
     */
    public function __construct(EntreService $entreService)
    {
        parent::__construct();
        $this->entreService = $entreService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->entreService->truncateEntreTable();
        $this->info('The entre table has been truncated.');
    }
}
