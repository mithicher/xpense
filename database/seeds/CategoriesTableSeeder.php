<?php

use Illuminate\Database\Seeder;
use App\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class CategoriesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// DB::table('categories')->delete();

		$json = File::get("database/data-sample/categories.json");
		$data = json_decode($json);

		foreach ($data as $obj) {
			Category::create([
				'user_id' => $obj->user_id,
				'name' => $obj->name,
				'slug' => Str::slug($obj->name)
			]);
		}
	}
}
