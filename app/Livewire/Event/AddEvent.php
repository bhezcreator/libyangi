<?php

namespace App\Livewire\Event;

use App\Models\Address;
use App\Models\Event;
use App\Models\Plan;
use App\Models\Product;
use App\Models\Subscription;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddEvent extends Component
{
    use WithFileUploads;

    public $eventId;
    public $subscription_id;
    public $user_id;
    public $plan_id;

    public $plans = [];
    public $users = [];

    public $title, $description, $theme_id, $type, $concerne;
    public $start_date, $end_date, $status = 'brouillon';
    public $image;

    public $products = []; // selected
    public $allProducts = [];
    public $themes = [];

    // ADDRESS
    public $addresses = [];

    public $isEdit = false;

    public function mount(
        ?int $subscription_id = null,
        ?int $user_id = null,
        ?int $event = null
    ) {
        if ($subscription_id) {
            $this->subscription_id = $subscription_id;
        } else {
            $this->plans = Plan::pluck('name', 'id')->toArray();
        }

        if ($user_id) {
            $this->user_id = $user_id;
        } else {
            $this->users = User::role('client')->pluck('name', 'id')->toArray();
        }

        $this->themes = Theme::pluck('title', 'id')->toArray();
        $this->allProducts = Product::pluck('name', 'id')->toArray();

        $this->addresses = [
            [
                'address' => '',
                'latitude' => '',
                'longitude' => '',
            ]
        ];

        if ($event) {
            $this->isEdit = true;
            $event = Event::with('products', 'subscription')->findOrFail($event);

            $this->eventId = $event->id;
            $this->title = $event->title;
            $this->concerne = $event->concerne;
            $this->description = $event->description;
            $this->theme_id = $event->theme_id;
            $this->type = $event->type;
            $this->start_date = $event->start_date;
            $this->end_date = $event->end_date;
            $this->status = $event->status;

            $this->products = $event->products->pluck('id')->toArray();

            if ($event->addresses->count()) {

                $this->addresses = $event->addresses->map(function ($address) {
                    return [
                        'address' => $address->address,
                        'latitude' => $address->latitude,
                        'longitude' => $address->longitude,
                    ];
                })->toArray();
            }
        }
    }

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'concerne' => 'nullable|string',
        'theme_id' => 'required|exists:themes,id',
        'type' => 'required|string',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'status' => 'required|in:brouillon,publié,fermé',
        'products' => 'array',
        'image' => 'nullable|image|max:5120',

        'addresses' => 'array|min:1',
        'addresses.*.address' => 'nullable|string|max:255',
        'addresses.*.latitude' => 'nullable',
        'addresses.*.longitude' => 'nullable',
    ];

    public function addAddress()
    {
        $this->addresses[] = [
            'address' => '',
            'latitude' => '',
            'longitude' => '',
        ];
    }

    public function removeAddress($index)
    {
        unset($this->addresses[$index]);
        $this->addresses = array_values($this->addresses);
    }

    public function save()
    {
        $this->validate();

        $subscription = null;
        if (!empty($this->plan_id)) {
            $subscription = Subscription::create([
                'user_id' => $this->user_id,
                'plan_id' => $this->plan_id,
                'status' => 'pending'
            ]);

            $this->subscription_id = $subscription->id;
        }


        $slug = Str::slug($this->title) . '-' . time();

        $data = [
            'user_id' => $this->user_id,
            'subscription_id' => $this->subscription_id,
            'theme_id' => $this->theme_id,
            'title' => $this->title,
            'concerne' => $this->concerne,
            'slug' => $slug,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'type' => $this->type,
            'status' => $this->status,
        ];

        // IMAGE
        if ($this->image) {
            $data['image'] = $this->image->store('events', 'public');
        }

        if ($this->isEdit) {
            $event = Event::findOrFail($this->eventId);
            $event->update($data);
        } else {
            $event = Event::create($data);
        }

        // PRODUCTS (pivot)
        $event->products()->sync($this->products);

        // ADDRESS
        // supprimer anciennes adresses
        $event->addresses()->delete();

        // enregistrer nouvelles
        foreach ($this->addresses as $item) {

            if (
                !empty($item['address']) ||
                !empty($item['latitude']) ||
                !empty($item['longitude'])
            ) {

                $event->addresses()->create([
                    'address' => $item['address'],
                    'latitude' => $item['latitude'],
                    'longitude' => $item['longitude'],
                ]);
            }
        }

        $this->dispatch('toast', type: 'success', message: 'Event enregistré');

        return redirect()->route('events.index');
    }

    public function render()
    {
        return view('livewire.event.add-event');
    }
}
