<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($name, $email, $password)
    {
        $data = [];
        $user = User::where('email', '=', $email);
        if ($user->count() > 0) {
            $user->update([
                'name' => $name,
                'password' => $password
            ]);
            $data = $name . " adlı kullanıcının bilgileri güncellendi";
        } else {
            $user = new User();
            $user->name = $name;
            $user->email = $email;
            $user->password = $password;
            $user->save();
            $data = $name . " adlı kullanıcının kaydı oluşturuldu";
        }
        return $data;


    }
}
