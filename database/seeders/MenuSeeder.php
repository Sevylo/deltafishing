<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('menus')->insert([
            ['name'=>'Gurami Bakar','price'=>50000,'image'=>'Gurami_bakar.jpg','description'=>'Ikan gurami bakar bumbu khas.'],
            ['name'=>'Gurami Goreng','price'=>25000,'image'=>'Gurami_goreng.jpg','description'=>'Ikan gurami goreng renyah.'],
            ['name'=>'Gurami Asam Manis','price'=>30000,'image'=>'Gurami_asam_manis.jpg','description'=>'Gurami saus asam manis.'],
            ['name'=>'Bandeng Presto','price'=>15000,'image'=>'Bandeng_presto.jpg','description'=>'Bandeng presto tulang lunak.'],
            ['name'=>'Patin Goreng','price'=>15000,'image'=>'Patin_goreng.jpg','description'=>'Ikan patin goreng.'],
            ['name'=>'Nasi Putih','price'=>5000,'image'=>'Nasi_putih.jpg','description'=>'Nasi putih pulen.'],
            ['name'=>'Es Teh','price'=>4000,'image'=>'Es_teh.jpg','description'=>'Es teh manis segar.'],
            ['name'=>'Es Jeruk','price'=>4000,'image'=>'Es_jeruk.jpg','description'=>'Es jeruk segar.'],
            ['name'=>'Teh Hangat','price'=>3000,'image'=>'Teh_hangat.jpg','description'=>'Teh hangat manis.'],
            ['name'=>'Jeruk Hangat','price'=>3000,'image'=>'Jeruk_hangat.jpg','description'=>'Jeruk hangat segar.'],
            ['name'=>'Air Mineral','price'=>3000,'image'=>'Air_mineral.jpg','description'=>'Air mineral botol.'],
        ]);
    }
}
