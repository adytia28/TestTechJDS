<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NewsCategory;
use Illuminate\Support\Str;

class NewsCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['health', 'sports', 'food', 'drink', 'racing', 'music', 'news', 'game'];

        foreach($categories as $item) {
            $categories = new NewsCategory;
            $categories->title = $item;
            $categories->slug = Str::slug($item);
            $categories->created_by = 1;
            $categories->updated_by = 1;
            $categories->save();
        }
    }
}
