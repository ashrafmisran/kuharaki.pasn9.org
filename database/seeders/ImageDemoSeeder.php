<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Perniagaan;
use App\Models\ProdukServis;

class ImageDemoSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Update first perniagaan with logo
        $perniagaan = Perniagaan::first();
        if ($perniagaan) {
            $perniagaan->update([
                'logo' => 'sample-logo.jpg' // This will show default-logo.jpg if file doesn't exist
            ]);
        }

        // Update first produk servis with images
        $produkServis = ProdukServis::first();
        if ($produkServis) {
            $produkServis->update([
                'featured_image' => 'sample-featured.jpg', // This will show default based on jenis
                'images' => ['sample-1.jpg', 'sample-2.jpg', 'sample-3.jpg'] // These will only show if files exist
            ]);
        }

        $this->command->info('Demo image data has been seeded. Default images will be shown for missing files.');
        $this->command->info('Logo path: storage/img/logo/');
        $this->command->info('Product/Service images path: storage/img/produkservis/');
    }
}