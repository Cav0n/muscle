<?php

namespace App\Console\Commands\JSON;

use App\Models\Exercice;
use App\Models\Image;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportExcercicesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import:exercices';

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

                $exercice = Exercice::updateOrCreate([
                    'name' => $exerciceDatas['name'],
                ], [
                    'level' => $exerciceDatas['level'],
                    'force' => $exerciceDatas['force'],
                    'equipment' => $exerciceDatas['equipment'],
                    'primary_muscles' => $exerciceDatas['primaryMuscles'],
                    'secondary_muscles' => $exerciceDatas['secondaryMuscles'],
                    'instructions' => [
                        'en' => $exerciceDatas['instructions']
                    ],
                ]);

                if (file_exists(Storage::path("json/exercises/$folder/images/0.jpg"))) {
                    $this->addImageToExercice($exercice, "json/exercises/$folder/images/0.jpg");
                }

                if (file_exists(Storage::path("json/exercises/$folder/images/1.jpg"))) {
                    $this->addImageToExercice($exercice, "json/exercises/$folder/images/1.jpg");
                }
            }
        }
    }

    /** Get an image from a path and add it to an exercice. */
    protected function addImageToExercice(Exercice $exercice, string $imagePath)
    {
        $fileName = pathinfo($imagePath, PATHINFO_FILENAME);
        $fileExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
        $publicPath = "public/images/exercices/{$exercice->id}/$fileName.$fileExtension";

        Storage::copy($imagePath, $publicPath);

        $image = Image::create(['path' => "images/exercices/{$exercice->id}/$fileName.$fileExtension"]);

        $exercice->images()->syncWithoutDetaching($image->id);
    }
}
