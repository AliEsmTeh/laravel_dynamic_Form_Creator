<?php

namespace Database\Seeders;

use App\Models\Fields;
use App\Models\FieldTypes;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FieldsFieldTypesPivotSeeder extends Seeder
{
    public function run(): void
    {

        $fields = Fields::all();
        $fieldTypes = FieldTypes::all();


        if ($fields->isEmpty() || $fieldTypes->isEmpty()) {
            $this->command->info('No fields or field types found. Please seed fields and field types first.');
            return;
        }

        foreach ($fields as $field) {
            $randomFieldTypes = $fieldTypes->random(rand(1, 3));

            foreach ($randomFieldTypes as $fieldType) {
                DB::table('fields_field_types_pivot')->insert([
                    'field_id' => $field->id,
                    'field_type_id' => $fieldType->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
