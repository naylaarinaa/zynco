<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            // Dresses
            ['name' => 'Katun Gaun Flare', 'category' => 'dress', 'price' => 50.00, 'image_url' => 'https://image.uniqlo.com/UQ/ST3/id/imagesgoods/475682/item/idgoods_28_475682.jpg?width=320', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Gaun Brushed Jersey', 'category' => 'dress', 'price' => 59.00, 'image_url' => 'https://image.uniqlo.com/UQ/ST3/id/imagesgoods/473087/item/idgoods_08_473087.jpg?width=750', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Katun Gaun T', 'category' => 'dress', 'price' => 60.00, 'image_url' => 'https://image.uniqlo.com/UQ/ST3/id/imagesgoods/464784/item/idgoods_11_464784.jpg?width=750', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Gaun Tanpa Lengan', 'category' => 'dress', 'price' => 40.00, 'image_url' => 'https://image.uniqlo.com/UQ/ST3/id/imagesgoods/464785/item/idgoods_55_464785.jpg?width=750', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Gaun Lawn Lembut', 'category' => 'dress', 'price' => 60.00, 'image_url' => 'https://image.uniqlo.com/UQ/ST3/id/imagesgoods/470668/item/idgoods_09_470668.jpg?width=750', 'created_at' => now(), 'updated_at' => now()],

            // Pants
            ['name' => 'Celana Lipit Denim', 'category' => 'pants', 'price' => 49.00, 'image_url' => 'https://image.uniqlo.com/UQ/ST3/id/imagesgoods/468849/item/idgoods_31_468849.jpg?width=750', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Celana Legging Ultra', 'category' => 'pants', 'price' => 29.00, 'image_url' => 'https://image.uniqlo.com/UQ/ST3/id/imagesgoods/464149/item/idgoods_68_464149.jpg?width=750', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Celana Legging Ultra', 'category' => 'pants', 'price' => 29.00, 'image_url' => 'https://image.uniqlo.com/UQ/ST3/id/imagesgoods/464148/item/idgoods_09_464148.jpg?width=750', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Celana Jogger Katun', 'category' => 'pants', 'price' => 29.00, 'image_url' => 'https://image.uniqlo.com/UQ/ST3/id/imagesgoods/466662/item/idgoods_32_466662.jpg?width=750', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Celana Pendek Rileks', 'category' => 'pants', 'price' => 39.00, 'image_url' => 'https://image.uniqlo.com/UQ/ST3/id/imagesgoods/466026/item/idgoods_56_466026.jpg?width=750', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Celana Pendek Chino', 'category' => 'pants', 'price' => 19.00, 'image_url' => 'https://image.uniqlo.com/UQ/ST3/id/imagesgoods/469828/item/idgoods_10_469828.jpg?width=750', 'created_at' => now(), 'updated_at' => now()],

            // Jackets
            ['name' => 'Jaket Parka Saku', 'category' => 'jacket', 'price' => 49.00, 'image_url' => 'https://image.uniqlo.com/UQ/ST3/id/imagesgoods/465466/item/idgoods_32_465466.jpg?width=750', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Jaket Parka Reversibel', 'category' => 'jacket', 'price' => 49.00, 'image_url' => 'https://image.uniqlo.com/UQ/ST3/id/imagesgoods/465471/item/idgoods_11_465471.jpg?width=750', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Jaket Rileks Jersey', 'category' => 'jacket', 'price' => 49.00, 'image_url' => 'https://image.uniqlo.com/UQ/ST3/id/imagesgoods/469775/item/idgoods_64_469775.jpg?width=750', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Jaket Ultra Light', 'category' => 'jacket', 'price' => 50.00, 'image_url' => 'https://image.uniqlo.com/UQ/ST3/id/imagesgoods/469869/item/idgoods_04_469869.jpg?width=750', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Jaket Parka Seamless', 'category' => 'jacket', 'price' => 50.00, 'image_url' => 'https://image.uniqlo.com/UQ/ST3/id/imagesgoods/469896/item/idgoods_67_469896.jpg?width=750', 'created_at' => now(), 'updated_at' => now()],

            // Skirts
            ['name' => 'Rok Panjang Lipit', 'category' => 'skirt', 'price' => 69.00, 'image_url' => 'https://image.uniqlo.com/UQ/ST3/id/imagesgoods/475399/item/idgoods_08_475399.jpg?width=750', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rok Sifon Motif', 'category' => 'skirt', 'price' => 59.00, 'image_url' => 'https://image.uniqlo.com/UQ/ST3/id/imagesgoods/475172/item/idgoods_69_475172.jpg?width=750', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rok Span Brushed', 'category' => 'skirt', 'price' => 59.00, 'image_url' => 'https://image.uniqlo.com/UQ/ST3/id/imagesgoods/472562/item/idgoods_31_472562.jpg?width=750', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rok Volume Katun', 'category' => 'skirt', 'price' => 69.00, 'image_url' => 'https://image.uniqlo.com/UQ/ST3/id/imagesgoods/471632/item/idgoods_37_471632.jpg?width=750', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Rok Satin', 'category' => 'skirt', 'price' => 60.00, 'image_url' => 'https://image.uniqlo.com/UQ/ST3/id/imagesgoods/469830/item/idgoods_30_469830.jpg?width=750', 'created_at' => now(), 'updated_at' => now()],

            // Shirts
            ['name' => 'Kemeja Flannel Lembut', 'category' => 'shirt', 'price' => 39.00, 'image_url' => 'https://image.uniqlo.com/UQ/ST3/id/imagesgoods/469423/item/idgoods_32_469423.jpg?width=320', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kemeja Katun Garis', 'category' => 'shirt', 'price' => 40.00, 'image_url' => 'https://image.uniqlo.com/UQ/ST3/id/imagesgoods/469422/item/idgoods_64_469422.jpg?width=320', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kemeja Oxford Garis', 'category' => 'shirt', 'price' => 50.00, 'image_url' => 'https://image.uniqlo.com/UQ/ST3/id/imagesgoods/452298/item/idgoods_65_452298.jpg?width=320', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kemeja Oxford Polos', 'category' => 'shirt', 'price' => 39.00, 'image_url' => 'https://image.uniqlo.com/UQ/ST3/id/imagesgoods/450259/item/idgoods_64_450259.jpg?width=320', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kemeja Luaran Jersey', 'category' => 'shirt', 'price' => 29.00, 'image_url' => 'https://image.uniqlo.com/UQ/ST3/id/imagesgoods/470299/item/idgoods_09_470299.jpg?width=320', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
