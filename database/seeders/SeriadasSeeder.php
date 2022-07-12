<?php

namespace Database\Seeders;

use App\Models\Seriadas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeriadasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seriadas = [
            // Primer semestre
            [1531, 1596], // Calc. Dif - Calc. Int
            [1533, 1837], // Tall. Etic. - Cult. Empr.
            [1535, 1837], // Tall. Admon - Cult. Empr.
            [1532, 1597], // Fund. Prog. - Prog. Or. Ob.

            // Segundo semestre
            [1596, 1835], // Calc. Int. - Calc. Vect.
            [1596, 1052], // Calc. Int. - Prob. Est.
            [1600, 1838], // Alg. Lin. - Inv, Op.
            [1597, 1836], // Prog. Or. Ob. - Est. Dat.

            // Tercer semestre
            [1835, 1841], // Calc. Vec. - Ec. Dif.
            [1052, 1838], // Prob. Est. - Inv. Op.
            [1836, 1843], // Est. Dat. - Topicos
            [1836, 1863], // Est. Dat. - Prolog
            [1018, 1851], // Principios - Arquitectura

            // Cuarto semestre
            [1841, 1842], // Ec. Dif. - Metodos
            [1838, 1849], // Inv. Op. - Simulacion
            [1863, 1867], // Prolog - Int. Art
            [1844, 1848], // Fund. BD - Taller BD
            [1851, 1857], // Arquitectura - Leng. Inter.

            // Quinto semestre
            [1847, 1853], // Fund. Telecom - Redes
            [1839, 1856], // Fund. Ing. Soft - Ing Soft
            [1848, 1854], // Taller BD - Admon BD

            // Sexto semestre
            [1852, 1858], // Autom I - Autom II
            [1853, 1859], // Redes - Conmutacion
            [1856, 1861], // Ing Soft - Gestion
            [1857, 1862],

            // Septimo semestre
            [1860, 1865], // Tall. Inv - Tall. Inv II
            [1859, 1864], // Conmutacion - Admon Redes
            [1850, 1855], // Sis. Op. - Tall. Sis. Op.

            // Octavo
            [1866, 2309], // Prog. Web - Des. Ap. Web
            [1866, 2307], // Prog. Web - Des. Ap. Ecommerce
            [2308, 2311], // Ap. Mov. - Prog. Avan. Disp. Mov.
        ];


        foreach ($seriadas as $seriada) {
            Seriadas::create([
                'anterior_id'  => $seriada[0],
                'siguiente_id' => $seriada[1],
            ]);
        }

    }
}
