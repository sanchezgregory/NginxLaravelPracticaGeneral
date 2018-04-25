<?php

use App\Curse;
use Illuminate\Database\Seeder;

class CurseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Curse::class, 20)->create();
    }
}
