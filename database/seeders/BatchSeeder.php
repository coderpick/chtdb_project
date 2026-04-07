<?php

namespace Database\Seeders;

use App\Models\Batch;
use App\Models\TrainingCenter;
use Illuminate\Database\Seeder;

class BatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $centers = TrainingCenter::all();

        foreach ($centers as $center) {
            // Morning Batch
            Batch::updateOrCreate(
                [
                    'training_center_id' => $center->id,
                    'shift' => 'Morning',
                ],
                [
                    'name' => 'Batch-01 (Morning)',
                    'start_date' => now()->subMonths(6),
                    'end_date' => now()->subMonths(3),
                    'capacity' => $center->district == 'rangamati' ? 40 : 30,
                    'status' => 'completed',
                ]
            );

            // Afternoon Batch
            Batch::updateOrCreate(
                [
                    'training_center_id' => $center->id,
                    'shift' => 'Afternoon',
                ],
                [
                    'name' => 'Batch-02 (Afternoon)',
                    'start_date' => now()->subMonths(6),
                    'end_date' => now()->subMonths(3),
                    'capacity' => $center->district == 'rangamati' ? 40 : 30,
                    'status' => 'completed',
                ]
            );
        }
    }
}
