<?php

namespace App\Console\Commands;

use Database\Seeders\UsersTableSeeder;
use Illuminate\Console\Command;

class UsersCreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {name} {password} {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command terminalı üzerinden kullanıcı ekleme. Girilen datalar name,email ve password. Örnek php artisan user:create adsoyad sifre email şeklinde sırayla girerseniz kullanıcı kaydı oluşturulacaktır.';


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(UsersTableSeeder $seeder)
    {
        $name = $this->argument('name');
        $email = $this->argument('email');
        $password = $this->argument('password');

        $seeder->run($name, $email, $password);
        return 0;


    }
}
