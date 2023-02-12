<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelegramAutoMessages extends Model
{
    use HasFactory;

    protected $table = "telegram_auto_messages";
    public $timestamps = false;
}
