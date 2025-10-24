<?php

namespace App\Notifications;

use App\Models\NoteInvitation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class NoteSharedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $invitation;

    /**
     * Create a new notification instance.
     */
    public function __construct(NoteInvitation $invitation)
    {
        $this->invitation = $invitation;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $sharerName = $this->invitation->sharerUser->name;
        $noteTitle = $this->invitation->note->title;
        $permission = $this->invitation->permission;

        $url = URL::temporarySignedRoute(
            'notes.acceptInvitation',
            now()->addDays(7), // Invitation valid for 7 days
            ['token' => $this->invitation->token]
        );

        return (new MailMessage)
            ->subject('You have been invited to a note!')
            ->greeting('Hello!')
            ->line("{$sharerName} has invited you to a note: \"{$noteTitle}\" with {$permission} permissions.")
            ->action('View Note Invitation', $url)
            ->line('This invitation link will expire in 7 days.')
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $url = URL::temporarySignedRoute(
            'notes.acceptInvitation',
            now()->addDays(7), // Invitation valid for 7 days
            ['token' => $this->invitation->token]
        );

        return [
            'note_id' => $this->invitation->note_id,
            'sharer' => $this->invitation->sharerUser->name,
            'note_title' => $this->invitation->note->title,
            'permission' => $this->invitation->permission,
            'token' => $this->invitation->token, // Keep token for reference if needed
            'url' => $url, // Store the full signed URL
        ];
    }

    /**
     * Get the database representation of the notification.
     */
    public function toDatabase(object $notifiable): array
    {
        return $this->toArray($notifiable);
    }
}
