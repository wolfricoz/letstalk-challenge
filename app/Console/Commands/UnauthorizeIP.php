<?php

namespace App\Console\Commands;

use App\Models\IpTable;
use Illuminate\Console\Command;

class UnauthorizeIP extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ip:disallow {ip}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $ip = IpTable::where('ip_address', '=', $this->argument('ip'))->first();
        if (!$ip){
            $this->warn('There is no record of this IP.');
            return 1;
        }
        $ip->delete();
        $this->info('Successfully added the IP address to the table');
        return 0;
    }
}
