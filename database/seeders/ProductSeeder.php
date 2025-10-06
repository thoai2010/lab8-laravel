<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Tạo 5 danh mục mẫu
        $categories = Category::factory(5)->create();

        // Đảm bảo thư mục ảnh tồn tại
        Storage::makeDirectory('public/images');

        // Tạo 50 sản phẩm kèm ảnh tự động
        Product::factory(50)->create()->each(function ($product) use ($categories) {

            // Gán danh mục ngẫu nhiên
            $product->category_id = $categories->random()->id;

            // Tạo ảnh ngẫu nhiên từ Picsum
            $url = 'https://picsum.photos/200?random=' . rand(1, 1000);
            $filename = 'images/' . Str::random(10) . '.jpg';

            // Tải ảnh về thư mục storage/app/public/images
            $imageContent = file_get_contents($url);
            Storage::put('public/' . $filename, $imageContent);

            // Cập nhật đường dẫn ảnh
            $product->image = $filename;
            $product->save();
            
            $imageContent = @file_get_contents($url);

            if ($imageContent === false) {
                echo "⚠️ Không thể tải ảnh từ $url\n";
            } else {
                Storage::put('public/' . $filename, $imageContent);
                echo "✅ Đã lưu ảnh: $filename\n";
            }
        });
        
    }
}
