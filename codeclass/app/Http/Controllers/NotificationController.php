<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
// Notifications pour les étudiants
public function studentNotifications()
{
// Exemple de données pour les notifications des étudiants
$notifications = [
[
'type' => 'urgent',
'title' => 'Échéance Projet',
'message' => 'Le projet "Interface Mobile" doit être livré dans 24 heures.',
'time' => 'Il y a 10 minutes',
],
[
'type' => 'success',
'title' => 'Validation Réussie',
'message' => 'Votre rapport mensuel a été approuvé par le chef de projet.',
'time' => 'Il y a 1 heure',
],
];

return view('centre-notifications', compact('notifications'));
}

// Notifications pour les enseignants
public function teacherNotifications()
{
// Exemple de données pour les notifications des enseignants
$notifications = [
[
'type' => 'info',
'title' => 'Nouvelle Collaboration',
'message' => 'Marie Dubois vous a ajouté au projet "Refonte UX".',
'time' => 'Il y a 3 heures',
],
[
'type' => 'warning',
'title' => 'Rappel: Réunion',
'message' => 'Réunion d\'équipe hebdomadaire dans 30 minutes.',
'time' => 'Il y a 4 heures',
],
];

return view('centre-notifications', compact('notifications'));
}
}