<?php

namespace App\Console\Commands\JSON;

use App\Models\Exercice;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportExcercicesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-excercices-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $jsonFolder = Storage::path('json/exercises');

        foreach (scandir($jsonFolder) as $folder) {
            if (file_exists(Storage::path("json/exercises/$folder/exercise.json"))) {
                $jsonFile = file_get_contents(Storage::path("json/exercises/$folder/exercise.json"));

                $exerciceDatas = json_decode($jsonFile, true);

                Exercice::updateOrCreate([
                    'name' => $exerciceDatas['name'],
                ], [
                    'level' => $exerciceDatas['level'],
                    'force' => $exerciceDatas['force'],
                    'equipment' => $exerciceDatas['equipment'],
                    'primary_muscles' => $exerciceDatas['primaryMuscles'],
                    'secondary_muscles' => $exerciceDatas['secondaryMuscles'],
                    'instructions' => $exerciceDatas['instructions'],
                ]);
            }
        }
    }
}
