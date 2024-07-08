<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpTable extends Model
{
    protected $guarded = [];
    protected $table = 'ip_table';


    public static function check($ip): bool
    {
        $instance = new self();
//        dd($ip);
        if($instance->where('ip_address', '=', $ip)->first()){
            return true;
        }
        return false;
    }
}
