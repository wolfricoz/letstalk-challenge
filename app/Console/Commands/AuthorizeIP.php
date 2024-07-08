<?php

namespace App\Console\Commands;

use App\Models\IpTable;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;

class AuthorizeIP extends Command implements PromptsForMissingInput
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ip:allow {ip}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command adds an IP to the authorized table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $ip = (bool) IpTable::where('ip_address', '=', $this->argument('ip'))->first();
        if ($ip){
            $this->warn('IP is already in the table.');
            return 1;
        }
        IpTable::create(['ip_address' => $this->argument('ip')]);
        $this->info('Successfully added the IP address to the table');
        return 0;
    }
}
