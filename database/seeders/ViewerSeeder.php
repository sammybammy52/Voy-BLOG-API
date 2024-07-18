<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Viewer;

class ViewerSeeder extends Seeder
{
    public function run()
    {
        Viewer::factory()->create();
    }
}
