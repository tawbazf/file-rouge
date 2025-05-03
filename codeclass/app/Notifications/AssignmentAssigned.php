<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Assignment;

class AssignmentAssigned extends Notification implements ShouldQueue
{
use Queueable;

public $assignment;

public function __construct(Assignment $assignment)
{
$this->assignment = $assignment;
}

public function via($notifiable)
{
return ['database']; 
}
public function toDatabase($notifiable)
{
return [
'assignment_id' => $this->assignment->id,
'title' => $this->assignment->title,
'description' => $this->assignment->description,
'message' => 'Un nouveau devoir vous a été assigné.',
];
}

public function toMail($notifiable)
{
return (new MailMessage)
->subject('Nouveau devoir assigné')
->line('Un nouveau devoir vous a été assigné : ' . $this->assignment->title)
->action('Voir le devoir', url('/assignments/' . $this->assignment->id));
}
}