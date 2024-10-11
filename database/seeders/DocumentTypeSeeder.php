<?php

namespace Database\Seeders;

use App\Models\DocumentCategory;
use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DocumentCategory::create([
            'document_number' => '1/2/3',
            'name' => 'Document Category One'
        ]);

        DocumentCategory::create([
            'document_number' => '111/36/3',
            'name' => 'Document Category Two'
        ]);

        DocumentCategory::create([
            'document_number' => '7/21/9',
            'name' => 'Document Category Three'
        ]);

        DocumentCategory::create([
            'document_number' => '10/27/13',
            'name' => 'Document Category Four'
        ]);

        DocumentCategory::create([
            'document_number' => '23/85/3',
            'name' => 'Document Category Five'
        ]);
    }
}
