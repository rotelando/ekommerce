<?php

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Eloquent::unguard();

        $this->call('ProductsTableSeeder');
        
        $this->command->info('Products table seeded!');
        
        $this->call('ProductItemsTableSeeder');
        
        $this->command->info('Product Items table seeded!');
    }

}

class ProductsTableSeeder extends Illuminate\Database\Seeder {

    public function run() {
        DB::table('products')->delete();

        Product::create(
                array('name' => 'Tecno Phantom Pad 2 Dual Sim',
                    'short_description' => 'Phantom PAD II has surpassing Android 4.2, 7.8 inch IPS touchscreen, a powerful 1.3G Quad-core processor.',
                    'description' => 'Phantom PAD II has surpassing Android 4.2, 7.8 inch IPS touchscreen, a powerful 1.3G Quad-core processor. Its metal body and slim design present a sense of "armored warriors", embracing the concept of strength and beauty',
                    'price' => 31030,
                    'stock' => 1,
                    'image_path' => 'http://www.konga.com/media/catalog/product/cache/1/image/370x/9df78eab33525d08d6e5fb8d27136e95/0/0/0002072_nokia-power-keyboard-su-42-package-for-lumia-2520-tablet-black.jpeg'
        ));
        Product::create(
                array('name' => 'Tecno S9 Dual Core',
                    'short_description' => 'The Tecno S9 will definitely become your best companion to keep pace with the world trend.',
                    'description' => 'The Tecno S9 will definitely become your best companion to keep pace with the world trend. Empowered with advanced hardware, The S9 is to bring so much convenience and additional features that will be definitely beyond your expectation',
                    'price' => 32030,
                    'stock' => 1,
                    'image_path' => 'http://www.konga.com/media/catalog/product/cache/1/image/370x/9df78eab33525d08d6e5fb8d27136e95/_/0/_0007_transpa_copy_8.jpg'
                )
        );
    }

}

class ProductItemsTableSeeder extends Illuminate\Database\Seeder {

    public function run() {
        DB::table('product_items')->delete();

        ProductItems::create(
                array('product_id' => 1,
                    'sku_id' => 'aabb1',
                    'status' => 1
        ));
        ProductItems::create(
                array('product_id' => 2,
                    'sku_id' => 'bbcc2',
                    'status' => 1
                )
        );
    }

}
