<?php

namespace App\Models;

use App\Traits\ApiModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use PHPUnit\Framework\MockObject\Api;

class Module extends Model
{
    use HasFactory;
    use ApiModel;


    protected static $api_path = "api/vendor/module";
}