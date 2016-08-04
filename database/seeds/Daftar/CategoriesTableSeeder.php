<?php

use Illuminate\Database\Seeder;
use App\Models\Category\Category;

class CategoriesTableSeeder extends Seeder
{
	protected $categories = [
		'Seminar',
		'Pameran',
		'Latihan',
		'Bengkel',
		'Persidangan',
		'Perhimpunan',
		'Konvensyen',
	];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('categories')->truncate();

        foreach ($this->categories as $category) {
        	factory(Category::class)->create([
				'name' => $category,
			]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
