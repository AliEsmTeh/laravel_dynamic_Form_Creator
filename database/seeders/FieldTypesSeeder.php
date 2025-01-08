<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FieldTypes;

class FieldTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample data to seed
        $fieldTypes = [
            [
                'name' => 'Text',
                'description' => 'A simple text field for short input.',
                'is_optional' => false,
            ],
            [
                'name' => 'Textarea',
                'description' => 'A field for longer text input.',
                'is_optional' => false,
            ],
            [
                'name' => 'Number',
                'description' => 'A field for numeric values only.',
                'is_optional' => false,
            ],
            [
                'name' => 'Email',
                'description' => 'A field for email addresses.',
                'is_optional' => false,
            ],
            [
                'name' => 'Password',
                'description' => 'A field for secure password input.',
                'is_optional' => false,
            ],
            [
                'name' => 'Date',
                'description' => 'A field for date values.',
                'is_optional' => false,
            ],
            [
                'name' => 'Datetime',
                'description' => 'A field for date and time values.',
                'is_optional' => false,
            ],
            [
                'name' => 'Checkbox',
                'description' => 'A field for boolean values (true/false).',
                'is_optional' => true,
            ],
            [
                'name' => 'Radio',
                'description' => 'A field for selecting one option from a set.',
                'is_optional' => true,
            ],
            [
                'name' => 'Select',
                'description' => 'A dropdown field for selecting one option.',
                'is_optional' => true,
            ],
            [
                'name' => 'Multi-select',
                'description' => 'A dropdown field for selecting multiple options.',
                'is_optional' => true,
            ],
            [
                'name' => 'File Upload',
                'description' => 'A field for uploading files.',
                'is_optional' => false,
            ],
            [
                'name' => 'Image Upload',
                'description' => 'A field for uploading images.',
                'is_optional' => false,
            ],
            [
                'name' => 'URL',
                'description' => 'A field for entering URLs.',
                'is_optional' => false,
            ],
            [
                'name' => 'Phone',
                'description' => 'A field for entering phone numbers.',
                'is_optional' => false,
            ],
            [
                'name' => 'Color Picker',
                'description' => 'A field for selecting colors.',
                'is_optional' => true,
            ],
            [
                'name' => 'Range',
                'description' => 'A field for selecting a range of values.',
                'is_optional' => true,
            ],
        ];

        // Insert the data into the database
        foreach ($fieldTypes as $fieldType) {
            FieldTypes::create($fieldType);
        }
    }
}
