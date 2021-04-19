<?php

use App\ConfigContact;
use Illuminate\Database\Seeder;

class ConfigContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ConfigContact::create([
            'footer' => request()->config_contact_footer,
            'contact_page' => request()->config_contact_page,
            'support' => request()->config_content_support,
            'email_name' => request()->email_name,
            'email_rece' => request()->email_receive,
            'work_footer' => '',
            'commit_footer' => ''
        ]);
    }
}
