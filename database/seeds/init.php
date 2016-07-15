<?php

use Illuminate\Database\Seeder;
use App\User;
use App\UserInfo;
use App\Payment;

class init extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'username' => 'phillipmadsen',
            'email' => 'pmadsen2013@gmail.com',
            'password' => bcrypt('mad15696')
        ]);
        $user->isAdmin = 1;
        $user->save();
        \File::makeDirectory(public_path()."/content/admin");
        \File::makeDirectory(public_path()."/content/admin/photos/");
        $dest = public_path()."/content/admin/photos/profile.png";
        $file = public_path()."/img/profile.png";
        \File::copy($file, $dest);
        UserInfo::create(["user_id" => $user->id, "photo" => "/content/admin/photos/profile.png"]);
        //init Payment
        Payment::create([
            'stripe_publishable_key' => '',
            'stripe_secret_key' => '',
            'paypal_client_id' => '',
            'paypal_secret' => ''
        ]);
    }
}
