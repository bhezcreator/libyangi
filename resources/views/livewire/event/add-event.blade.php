<div class="d-gril-container">

    <form wire:submit.prevent="save" class="d-gril-row">

        <div class="d-gril-col-12">
            <h5>Information de l'événement</h5>
        </div>

        <div class="d-gril-col-12 d-gril-md-12 d-gril-12">
            <div class="d-gril-group">
                <x-form.input label="Titre" wire:model="title" />
            </div>
        </div>

        <div class="d-gril-col-6 d-gril-md-6 d-gril-12">
            <div class="d-gril-group">
                <x-form.input label="Concerne" wire:model="concerne" />
            </div>
        </div>

        <div class="d-gril-col-6 d-gril-md-6 d-gril-12">
            <div class="d-gril-group">
                <x-form.select
                    label="Type"
                    wire:model="type"
                    :options="[
                        'mariage'=>'Mariage',
                        'anniversaire'=>'Anniversaire',
                        'conférence'=>'Conférence'
                    ]"
                />
            </div>
        </div>

        <div class="d-gril-col-6 d-gril-md-6 d-gril-12">
            <div class="d-gril-group">
                <x-form.input type="datetime-local" label="Date début" wire:model="start_date" />
            </div>
        </div>

        <div class="d-gril-col-6 d-gril-md-6 d-gril-12">
            <div class="d-gril-group">
                <x-form.input type="datetime-local" label="Date fin" wire:model="end_date" />
            </div>
        </div>

        <div class="d-gril-col-6 d-gril-md-6 d-gril-12">
            <div class="d-gril-group">
                <x-form.select
                    label="Statut"
                    wire:model="status"
                    :options="[
                        'brouillon'=>'Brouillon',
                        'publié'=>'Publié',
                        'fermé'=>'Fermé'
                    ]"
                />
            </div>
        </div>

        <div class="d-gril-col-6 d-gril-md-6 d-gril-12">
            <div class="d-gril-group">
                <x-form.select
                    label="Thème"
                    wire:model="theme_id"
                    :options="$themes"
                />
            </div>
        </div>

        <div class="d-gril-col-12 d-gril-md-6 d-gril-12">
            <div class="d-gril-group app-form-group" wire:ignore>
                <label>Description</label>

                <textarea id="editor1">
                    {{ $description }}
                </textarea>
            </div>

            <script>
                document.addEventListener('livewire:init', () => {
                    CKEDITOR.replace('editor1');
                    CKEDITOR.instances.editor1.on('change', function () {
                        @this.set(
                            'description',
                            CKEDITOR.instances.editor1.getData()
                        );
                    });
                });
            </script>
        </div>

        <!-- IMAGE -->
        <div class="d-gril-col-6 d-gril-md-6 d-gril-12">
            <div class="d-gril-group">
                <x-form.input type="file" label="Prochette" wire:model="image" />
            </div>
        </div>

        <!-- PRODUITS -->
        <div class="d-gril-col-6 d-gril-md-6 d-gril-12">
            <div class="app-form-group">
                <label>Produits</label>
            </div>

            @foreach($allProducts as $id => $name)
                <x-form.toggle
                    label="{{ $name }}"
                    wire:model="products"
                    value="{{ $id }}" />
            @endforeach
        </div>

        @if (!$subscription_id AND !$user_id)
            <!-- A PROPOS -->
            <div class="d-gril-col-12">
                <h5>Autre informations</h5>
            </div>

            <div class="d-gril-col-6 d-gril-md-6 d-gril-12">
                <div class="d-gril-group">
                    <x-form.select
                        label="Organisateur"
                        wire:model="user_id"
                        :options="$users"
                    />
                </div>
            </div>

            <div class="d-gril-col-6 d-gril-md-6 d-gril-12">
                <div class="d-gril-group">
                    <x-form.select
                        label="Plan ou forfait"
                        wire:model="plan_id"
                        :options="$plans"
                    />
                </div>
            </div>
        @endif

        <!-- ADDRESSES -->
        <div class="d-gril-col-12">

            <div style="display: flex;justify-content: space-between;align-items: center;flex-wrap: wrap;gap: 10px;">
                <h5>Adresses</h5>

                <button
                    type="button"
                    wire:click="addAddress"
                    class="btn btn-success btn-sm"
                >
                    <i class="las la-plus"></i> Adresse
                </button>
            </div>

        </div>

        @foreach($addresses as $index => $item)

            <div class="d-gril-col-12">

                <div class="card">

                    <div style="display: flex;justify-content: space-between;align-items: center;flex-wrap: wrap;gap: 10px;margin-bottom:5px;">

                        <p style="color: #9564ff;font-weight:600;font-size:0.85rem;margin-bottom:5px;">
                            Adresse #{{ $index + 1 }}
                        </p>

                        @if(count($addresses) > 1)
                            <button
                                type="button"
                                wire:click="removeAddress({{ $index }})"
                                class="btn btn-danger btn-sm"
                            >
                                <i class="las la-trash"></i>
                            </button>
                        @endif

                    </div>

                    <div class="d-gril-row">

                        <div class="d-gril-col-12">
                            <div class="d-gril-group">
                                <x-form.input
                                    label=""
                                    wire:model="addresses.{{ $index }}.address"
                                />
                            </div>
                        </div>

                        <div class="d-gril-col-6">
                            <div class="d-gril-group">
                                <x-form.input
                                    label="Latitude"
                                    wire:model="addresses.{{ $index }}.latitude"
                                />
                            </div>
                        </div>

                        <div class="d-gril-col-6">
                            <div class="d-gril-group">
                                <x-form.input
                                    label="Longitude"
                                    wire:model="addresses.{{ $index }}.longitude"
                                />
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        @endforeach


        <div class="d-gril-col-12" style="margin-top: 10px">
            <h5>Determinez les blocs à affichir dans l'invitation.</h5>
        </div>

        <div class="d-gril-col-12 d-gril-md-6 d-gril-12">
            <x-form.toggle label="Afficher adresse" wire:model="v_address" />
            <x-form.toggle label="Afficher programme" wire:model="v_programme" />
            <x-form.toggle label="Afficher detail_event" wire:model="v_detail_event" />
            <x-form.toggle label="Afficher livre" wire:model="v_livre" />
            <x-form.toggle label="Afficher infos invité" wire:model="v_infos_invite" />
            <x-form.toggle label="Afficher bouton validé" wire:model="v_btn_valide" />
            <x-form.toggle label="Afficher date de début" wire:model="v_date_debut" />
            <x-form.toggle label="Afficher date de fin" wire:model="v_date_fin" />
        </div>

        <div class="d-gril-col-12 d-gril-md-6 d-gril-12" style="margin-top: 10px">
            <div class="d-gril-group">
                <button class="btn btn-primary">
                    {{ $isEdit ? 'Modifier' : 'Créer' }}
                </button>
            </div>
        </div>

    </form>
</div>