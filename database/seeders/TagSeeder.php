<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['name' => 'Desing'],
            ['name' => 'MArketing'],
            ['name' => 'SEO'],
            ['name' => 'Consulting'],
            ['name' => 'Reading'],
        ];

        Tag::insert($tags);
    }
}