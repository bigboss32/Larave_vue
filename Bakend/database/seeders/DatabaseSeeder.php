<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Proyecto;
use App\Models\Tarea;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        Proyecto::factory()->times(15)->create();
        Tarea::factory()->times(8)->create()->each(function ($tarea) {
            $tarea->proyectos()->sync(
                Proyecto::all()->random(3)
            );
        });
    }
}