<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            [
                'id' => 131,
                'insurances_id' => 5,
                'nombre' => 'Asistencia Vial (Grua)',
                'id_ms' => 123,
                'tresmeses' => 0,
                'seismeses' => 4017,
                'docemeses' => 5739,
                'activo' => 'si',
            ],
            [
                'id' => 132,
                'insurances_id' => 7,
                'nombre' => 'Asistencia Vial (Grua)',
                'id_ms' => 124,
                'tresmeses' => 0,
                'seismeses' => 4017,
                'docemeses' => 5739,
                'activo' => 'si',
            ],
        ]);
        DB::table('servicio_vehicle_type_tarif')->insert([
            [
                'servicio_id' => 101, // Es Asistencia de Sura normal Liviano
                'vehicle_type_id' => 14,
            ],
            [
                'servicio_id' => 101, // Es Asistencia de Sura normal Liviano
                'vehicle_type_id' => 15
            ],
            [
                'servicio_id' => 101, // Es Asistencia de Sura normal Liviano
                'vehicle_type_id' => 7,
            ],
            [
                'servicio_id' => 101, // Es Asistencia de Sura normal Liviano
                'vehicle_type_id' => 2,
            ],
            [
                'servicio_id' => 101, // Es Asistencia de Sura normal Liviano
                'vehicle_type_id' => 16,
            ],
            [
                'servicio_id' => 101, // Es Asistencia de Sura normal Liviano
                'vehicle_type_id' => 10,
            ],
            [
                'servicio_id' => 101, // Es Asistencia de Sura normal Liviano
                'vehicle_type_id' => 11,
            ],
            [
                'servicio_id' => 101, // Es Asistencia de Sura normal Liviano
                'vehicle_type_id' => 6,
            ],
            [
                'servicio_id' => 101, // Es Asistencia de Sura normal Liviano
                'vehicle_type_id' => 18,
            ],
            [
                'servicio_id' => 101, // Es Asistencia de Sura normal Liviano
                'vehicle_type_id' => 13,
            ],
            [
                'servicio_id' => 123, // Es Asistencia de Sura normal Liviano
                'vehicle_type_id' => 14,
            ],
            [
                'servicio_id' => 123, // Es Asistencia de Sura normal Liviano
                'vehicle_type_id' => 15
            ],
            [
                'servicio_id' => 123, // Es Asistencia de Sura normal Liviano
                'vehicle_type_id' => 7,
            ],
            [
                'servicio_id' => 123, // Es Asistencia de Sura normal Liviano
                'vehicle_type_id' => 2,
            ],
            [
                'servicio_id' => 123, // Es Asistencia de Sura normal Liviano
                'vehicle_type_id' => 16,
            ],
            [
                'servicio_id' => 123, // Es Asistencia de Sura normal Liviano
                'vehicle_type_id' => 10,
            ],
            [
                'servicio_id' => 123, // Es Asistencia de Sura normal Liviano
                'vehicle_type_id' => 11,
            ],
            [
                'servicio_id' => 123, // Es Asistencia de Sura normal Liviano
                'vehicle_type_id' => 6,
            ],
            [
                'servicio_id' => 123, // Es Asistencia de Sura normal Liviano
                'vehicle_type_id' => 18,
            ],
            [
                'servicio_id' => 123, // Es Asistencia de Sura normal Liviano
                'vehicle_type_id' => 13,
            ],
            [
                'servicio_id' => 131, // Es Asistencia de Sura normal Pesado
                'vehicle_type_id' => 8,
            ],
            [
                'servicio_id' => 131, // Es Asistencia de Sura normal Pesado
                'vehicle_type_id' => 21,
            ],
            [
                'servicio_id' => 131, // Es Asistencia de Sura normal Pesado
                'vehicle_type_id' => 9,
            ],
            [
                'servicio_id' => 131, // Es Asistencia de Sura normal Pesado
                'vehicle_type_id' => 12,
            ],
            [
                'servicio_id' => 131, // Es Asistencia de Sura normal Pesado
                'vehicle_type_id' => 20,
            ],
            [
                'servicio_id' => 131, // Es Asistencia de Sura normal Pesado
                'vehicle_type_id' => 6,
            ],
            [
                'servicio_id' => 131, // Es Asistencia de Sura normal Pesado
                'vehicle_type_id' => 1,
            ],
            [
                'servicio_id' => 131, // Es Asistencia de Sura normal Pesado
                'vehicle_type_id' => 17,
            ],
            [
                'servicio_id' => 131, // Es Asistencia de Sura normal Pesado
                'vehicle_type_id' => 19,
            ],
            [
                'servicio_id' => 131, // Es Asistencia de Sura normal Pesado
                'vehicle_type_id' => 3,
            ],
            [
                'servicio_id' => 131, // Es Asistencia de Sura normal Pesado
                'vehicle_type_id' => 4,
            ],
            [
                'servicio_id' => 131, // Es Asistencia de Sura normal Pesado
                'vehicle_type_id' => 5,
            ],
            [
                'servicio_id' => 132, // Es Asistencia de Sura normal Pesado
                'vehicle_type_id' => 8,
            ],
            [
                'servicio_id' => 132, // Es Asistencia de Sura normal Pesado
                'vehicle_type_id' => 21,
            ],
            [
                'servicio_id' => 132, // Es Asistencia de Sura normal Pesado
                'vehicle_type_id' => 9,
            ],
            [
                'servicio_id' => 132, // Es Asistencia de Sura normal Pesado
                'vehicle_type_id' => 12,
            ],
            [
                'servicio_id' => 132, // Es Asistencia de Sura normal Pesado
                'vehicle_type_id' => 20,
            ],
            [
                'servicio_id' => 132, // Es Asistencia de Sura normal Pesado
                'vehicle_type_id' => 6,
            ],
            [
                'servicio_id' => 132, // Es Asistencia de Sura normal Pesado
                'vehicle_type_id' => 1,
            ],
            [
                'servicio_id' => 132, // Es Asistencia de Sura normal Pesado
                'vehicle_type_id' => 17,
            ],
            [
                'servicio_id' => 132, // Es Asistencia de Sura normal Pesado
                'vehicle_type_id' => 19,
            ],
            [
                'servicio_id' => 132, // Es Asistencia de Sura normal Pesado
                'vehicle_type_id' => 3,
            ],
            [
                'servicio_id' => 132, // Es Asistencia de Sura normal Pesado
                'vehicle_type_id' => 4,
            ],
            [
                'servicio_id' => 132, // Es Asistencia de Sura normal Pesado
                'vehicle_type_id' => 5,
            ],
        ]);
    }
}
