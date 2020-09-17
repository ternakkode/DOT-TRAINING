<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
 
    	for($i = 1; $i <= 10; $i++){
            $nama_produk = $faker->realText(20);
            $harga_jual = $faker->numberBetween(10000, 200000);
            $harga_beli = $harga_jual + 20000;
 
    	      // insert data ke table pegawai menggunakan Faker
    		DB::table('produk')->insert([
    			'nama_produk'       => $nama_produk,
    			'harga_jual'        => $harga_jual,
    			'harga_beli'        => $harga_beli
    		]);
 
    	}
    }
}
