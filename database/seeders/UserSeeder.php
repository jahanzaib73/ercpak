<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\Desigination;
use App\Models\Location;
use App\Models\Province;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Super Admin
        User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 1,
            'profile_pic_name' => 'super_admin',
            'profile_pic_url' => asset('assets/images/users/avatar-1.jpg')
        ])->assignRole('Super Admin');

        User::create([
            'first_name' => 'Hussain',
            'last_name' => 'Khan',
            'email' => 'hussain@gmail.com',
            'password' => Hash::make('admin'),
            'profile_pic_name' => 'super_admin',
            'profile_pic_url' => asset('assets/images/users/avatar-1.jpg')
        ]);

        Location::create([
            'name' => 'Test Location',
            'country_id' => 1,
            'province_id' => 1,
            'city_id' => 1,
        ]);

        Country::create([
            'name' => 'Pakistan'
        ]);

        Province::create([
            'name' => 'Baluchistan',
            'arabic_name' => 'بلوشستان',
            'country_id' => 1
        ]);

        Province::create([
            'name' => 'Punjab',
            'arabic_name' => 'البنجاب',
            'country_id' => 1
        ]);

        Province::create([
            'name' => 'Sindh',
            'arabic_name' => 'السند',
            'country_id' => 1
        ]);

        Province::create([
            'name' => 'Khyber Pk',
            'arabic_name' => 'خيبر بختونخا',
            'country_id' => 1
        ]);

        City::create([
            'name' => 'Lahore',
            'province_id' => 1
        ]);

        Desigination::create([
            'name' => 'Test Designation'
        ]);
    }
}
