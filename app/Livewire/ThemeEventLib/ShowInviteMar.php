<?php

namespace App\Livewire\ThemeEventLib;

use App\Models\Event;
use App\Models\Guest;
use App\Models\GuestProductChoice;
use Livewire\Component;
use Illuminate\Support\Str;
use LaravelQRCode\Facades\QRCode;

class ShowInviteMar extends Component
{
    public Event $event;

    public $loaded = false;

    // FORM
    public $event_id;
    public $name;
    public $phone;
    public $email;
    public $message;
    public $ip;
    public $isPrivate = true;

    public $produits = [];
    public $lien;
    public $nb_invites;

    public function mount(Int $id)
    {
        $this->event = Event::with([
            'addresses',
            'guests',
            'products',
            'theme',
            'subscription'
        ])->findOrFail($id);

        $this->event_id = $id;

        // Récupération de lien
        $this->lien = url()->current();

        // Récupération de l'adresse IP
        $this->ip = request()->ip();

        // Nombre d'invités par plan
        $this->nb_invites = $this->event->subscription->plan->max_guests;

        $this->loaded = true;
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'message' => 'nullable|string',
            'isPrivate' => 'boolean',
            'produits' => 'nullable|array',
        ];
    }

    public function save()
    {
        $this->validate();

        // Nombre de réponses déjà enregistrées
        $nbReponses = Guest::where('event_id', $this->event_id)->count();

        if ($nbReponses >= $this->nb_invites) {
            $this->dispatch(
                'toast',
                type: 'error',
                message: 'Nombre d’invité atteinte.'
            );
            return back();
        }

        // Vérifier si l'invité a déjà répondu
        $dejaRepondu = Guest::where([
            ['name', $this->name],
            ['ip', $this->ip],
            ['event_id', $this->event_id],
        ])->exists();

        if ($dejaRepondu) {
            $this->dispatch(
                'toast',
                type: 'error',
                message: 'Vous avez déjà confirmé(e).'
            );
            return back();
        }

        // Générer le code unique
        $code = (string) Str::uuid();

        // Créer le message
        $msg_invite = Guest::create([
            'code' => $code,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'message' => $this->message,
            'ip' => $this->ip,
            'status' => $this->isPrivate ? 'Confirmée' : 'Declinée',
            'event_id' => $this->event_id,
        ]);

        // Si réponse acceptée
        if ($this->isPrivate === true) {
            // Enregistrer les produits si présents
            if (!empty($this->produits)) {
                foreach ($this->produits as $produitId) {
                    GuestProductChoice::create([
                        'event_id' => $this->event_id,
                        'product_id' => $produitId,
                        'guest_id' => $msg_invite->id,
                    ]);
                }
            }

            // Générer le QR code
            $url = route('invitation.verify', ['code' => $msg_invite->code]);
            $fileName = "invitation-{$code}-{$this->event->title}.png";
            $chemin = public_path("storage/{$fileName}");

            QRCode::text("$url")
                ->setSize(12)
                ->setOutfile($chemin)
                ->setMargin(2)
                ->png();

            // Notification à user
            // $utilisateur = User::find($request->client_id);
            // $invite = $request->invite;
            // if ($utilisateur) {
            //     $url = route('events.edit', ['event' => $event->id]);
            //     $utilisateur->notify(new ReponseInvitation($url, $event->id, $invite));
            // }

            /*             
                $messageNotif = [
                    'msg' => "L'invité {$request->invite} vient de réagir à son invitation.",
                    'concernant' => "Réaction de l'invitation",
                    'user' => $request->invite,
                    'id' => $event->id,
                ];

                $utilisateur = User::find($request->client_id);
                if ($utilisateur) {
                    Notification::send($utilisateur, new ActionManager($messageNotif));
                } 
            */
            $this->resetForm();

            // Redirection vers confirmation
            return redirect()->route('confirmation', [
                'chemin' => bin2hex($chemin),
                'invite' => $msg_invite->name,
                'event' => $this->event
            ]);
        }

        // Sinon réponse refusée
        return redirect()->route('refus', [$msg_invite->id]);
    }

    public function resetForm()
    {
        $this->reset([
            'name',
            'phone',
            'email',
            'message',
            'isPrivate',
            'produits',
            'produits',
        ]);
    }

    public function sendInvitation()
    {
        $this->dispatch(
            'theme-event-lib-send-invitation',
            eventId: $this->event->id
        );

        session()->flash(
            'success',
            'Invitation envoyée avec succès.'
        );
    }

    public function render()
    {
        return view('livewire.theme-event-lib.show-invite-mar');
    }
}
