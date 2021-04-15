<?php

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
            'nombre' => 'Restaurant',
            'slug' => Str::slug('Restaurant'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'Café',
            'slug' => Str::slug('Café'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'hoteles',
            'slug' => Str::slug('hoteles'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'Bares y night club',
            'slug' => Str::slug('Bares y night club'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'hospitales',
            'slug' => Str::slug('hospitales'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'gimnasio',
            'slug' => Str::slug('gimnasio'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('categorias')->insert([
            'nombre' => 'doctor',
            'slug' => Str::slug('doctor'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
