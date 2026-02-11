<?php

namespace Database\Seeders;

use App\Models\PageContent;
use Illuminate\Database\Seeder;

class PageContentSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['home', 'latar-belakang', 'carta-organisasi', 'aktiviti', 'galeri'] as $slug) {
            PageContent::updateOrCreate(
                ['page_slug' => $slug],
                ['content' => PageContent::defaultContent($slug)]
            );
        }
    }
}
