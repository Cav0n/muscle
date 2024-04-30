<?php

namespace App\Notifications\Seances;

use App\Models\SeanceInvite;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InviteNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public SeanceInvite $seanceInvite
    ){}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject($this->seanceInvite->invited_by->firstname . " veut s'entrainer avec vous !")
                    ->salutation("Bonjour {$this->seanceInvite->user?->firstname},")
                    ->line("{$this->seanceInvite->invited_by->firstname} vous invite à une séance.")
                    ->line("Pour accepter l'invitation veuillez cliquer sur le bouton ci-dessous :")
                    ->action("J'accepte l'invitation 💪🏼",
                        route("dashboard.seances.invites.accept", ['seanceInvite' => $this->seanceInvite]));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'seance_invite_id' => $this->seanceInvite->id
        ];
    }
}
