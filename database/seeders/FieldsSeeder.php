<?php

namespace Database\Seeders;

use App\Models\Fields;
use App\Models\FieldTypes;
use App\Models\Form;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FieldsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch all forms and field types
        $forms = Form::all();
        $fieldTypes = FieldTypes::all();

        // Check if there are any forms and field types to associate
        if ($forms->isEmpty() || $fieldTypes->isEmpty()) {
            $this->command->info('No forms or field types found. Please seed forms and field types first.');
            return;
        }

        // Generate 15 fields
        for ($i = 0; $i < 15; $i++) {
            Fields::create([
                'form_id' => $forms->random()->id,
                'label' => fake()->sentence(2),
                'options' => null,
                'placeholder' => fake()->sentence(3),
                'required' => fake()->boolean(),
                'sequence' => $i + 1, // Sequence number
            ]);
        }
    }
}
