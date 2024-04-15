<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;


class DropTable extends Command
{
    protected $signature = 'db:drop-table {table}';
    protected $description = 'Drops a specified table from the database.';

    public function handle()
    {
        $table = $this->argument('table');
        Schema::connection('gs_data')->dropIfExists($table);
        $this->info('Dropped table: ' . $table);
    }

}
