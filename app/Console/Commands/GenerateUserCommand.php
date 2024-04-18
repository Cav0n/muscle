<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class GenerateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:user:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a brand new user !';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = new User();

        $user->email = $this->ask('Email') ?? 'fbernard19@protonmail.com';

        // Verify before saving that the email is unique
        while (User::where('email', $user->email)->exists()) {
            $this->error("Un utilisateur est déjà enregistré avec cette adresse email.");
            $user->email = $this->ask('Email');
        }

        $user->firstname = $this->ask('Prénom') ?? 'Florian';
        $user->lastname = $this->ask('Nom de famille') ?? 'Bernard';
        $user->password = $password = $this->ask('Mot de passe') ?? "0K3RI?7I{rFWge}K/2^4";

        $user->save();

        $this->info("L'utilisateur a été généré.");
        $this->info("Email: ".$user->email." | Mot de passe : ".$password);

        return Command::SUCCESS;
    }
}
