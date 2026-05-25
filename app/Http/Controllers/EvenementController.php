<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Guest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;

class EvenementController extends Controller
{
    public function download(string $chemins, string $invite, int $eventId)
    {
        // Décoder le chemin du QR code en binaire
        $qrcode = hex2bin($chemins);

        // Charger l'événement ou échouer si non trouvé
        $event = Event::findOrFail($eventId);

        // Dossier de stockage des invitations PDF
        $folder = storage_path('app/public/invitations');

        // Créer le dossier s'il n'existe pas
        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0755, true);
        }

        // Nom du fichier PDF sécurisé (remplacer espaces, caractères spéciaux)
        $safeTitle = preg_replace('/[^A-Za-z0-9_\-]/', '_', $event->title);
        $safeInvite = preg_replace('/[^A-Za-z0-9_\-]/', '_', $invite);
        $pdfFileName = "{$safeTitle}_pour_{$safeInvite}.pdf";

        $pdfPath = $folder . DIRECTORY_SEPARATOR . $pdfFileName;

        // Générer le PDF depuis la vue
        $pdf = Pdf::loadView('pages.download_invitation', compact('invite', 'qrcode', 'event'))
            ->setPaper('a4')
            ->setWarnings(false);
        return $pdf->stream('invitation.pdf');
        // Sauvegarder le PDF
        //$pdf->save($pdfPath);

        // Retourner la réponse de téléchargement du PDF
        // return response()->download($pdfPath)->deleteFileAfterSend(true);
    }

    public function print_invits($id, $type)
    {
        $event = Event::findOrFail($id);

        $folder = storage_path('app/public/invitations/invites');
        File::ensureDirectoryExists($folder, 0755, true);

        $pdf = Pdf::loadView('pages.events.print_invits', compact('event', 'type'))
            ->setWarnings(false);

        $filename = match ($type) {
            'msg' => "Liste_messages_invitation_{$event->title}.pdf",
            default => "Liste_invites_{$event->title}.pdf",
        };

        $pdfPath = "{$folder}/{$filename}";
        $pdf->save($pdfPath);

        return response()->download($pdfPath);
    }

    // Function de verification de l'invitation
    public function verify($code)
    {
        $invitation = Guest::where('code', $code)->first();

        if (!$invitation) {
            // alert()->error('Validation', "Invitation invalide");
            return redirect()->route('invitation.verification');
        }

        if ($invitation->used) {
            // alert()->success('Validation', "Cette invitation a déjà été utilisée.");
            return redirect()->route('invitation.verification');
        }

        // Marquer comme utilisée
        $invitation->used = true;
        $invitation->save();

        // Notification
        // $messageNotif = [
        //     'msg' => "L'invité " . $invitation->invite . " vient de checker son invitation.",
        //     'concernant' => "Evaluation de l'invitation",
        //     'user' => Auth::user()->id,
        //     'id' => $invitation->id_event,
        // ];

        // $evenement = Evenement::find($invitation->id_event);
        // $utilisateur = User::find($evenement->idUser);
        // if ($utilisateur) {
        //     Notification::send($utilisateur, new ActionManager($messageNotif));
        // }

        // alert()->success('Validation', "Invitation validée avec succès.");
        return redirect()->route('invitation.verification');
    }
}
