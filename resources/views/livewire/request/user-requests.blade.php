<div>
    <div class="app-tab-container">

    <!-- HEADER -->
    <div class="app-tab-header">
        <h2 class="app-tab-title">Mes demandes</h2>

        <input 
            type="text" 
            class="app-tab-search" 
            placeholder="Rechercher..." 
            wire:model.live="search"
        >
    </div>

    <!-- TABLE -->
    <div class="app-tab-wrapper">
        <table class="app-tab-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Plan</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Statut</th>
                    <th>Fichiers</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($requests as $i => $req)
                    <tr wire:key="{{ $req->id }}">
                        <td>{{ $i + 1 }}</td>

                        <td>{{ $req->subscription->plan->name ?? '-' }}</td>

                        <td>{{ Str::limit($req->description, 40) }}</td>

                        <td>{{ $req->created_at->translatedFormat('d F Y à H:i') }}</td>

                        <td>
                            <span class="app-tab-badge 
                                {{ $req->status == 'approved' ? 'success' : ($req->status == 'rejected' ? 'danger' : 'warning') }}">
                                {{ ucfirst($req->status) }}
                            </span>
                        </td>

                        <td>
                            {{ $req->getMedia('requests')->count() }} fichier(s)
                        </td>

                        <td>
                            <!-- VOIR -->
                            <button 
                                class="app-tab-btn btn-primary"
                                wire:click="show({{ $req->id }})"
                            >
                                <i class="la la-eye"></i>
                            </button>

                            <!-- DELETE -->
                            <button 
                                class="app-tab-btn btn-danger"
                                wire:click="confirmDelete({{ $req->id }})"
                            >
                                <i class="las la-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">
                            Aucune demande trouvée
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- PAGINATION -->
    <div class="forms-pagination">
        <x-pagination :paginator="$requests" />
    </div>

</div>

<!-- 🔥 MODAL DETAIL -->
<x-centered-modal title="Détail de la demande" width="60%">
    
    @if($selectedRequest)
        <div class="request-card">

            <!-- HEADER -->
            <div class="request-header">
                <div>
                    <h3 class="request-title">
                        <i class="las la-file-alt  request-icon"></i>
                        Détail de la demande
                    </h3>
                    <span class="request-date">
                        <i class="las la-calendar"></i>
                        {{ $selectedRequest->created_at->translatedFormat('d F Y à H:i') }}
                    </span>
                </div>

                <span class="request-status 
                    request-status-{{ $selectedRequest->status }}">
                    <i class="las la-info-circle  request-icon"></i>
                    {{ ucfirst($selectedRequest->status) }}
                </span>
            </div>

            <!-- BODY -->
            <div class="request-body">

                <!-- PLAN -->
                <div class="request-item">
                    <i class="las la-layer-group request-icon"></i>
                    <div>
                        <span class="request-label">Plan</span>
                        <p class="request-value">
                            {{ $selectedRequest->subscription->plan->name ?? '-' }}
                        </p>
                    </div>
                </div>

                <!-- DESCRIPTION -->
                <div class="request-item">
                    <i class="las la-align-left request-icon"></i>
                    <div>
                        <span class="request-label">Description</span>
                        <p class="request-description">
                            {{ $selectedRequest->description }}
                        </p>
                    </div>
                </div>

                <!-- MEDIA -->
                <div class="request-media">
                    <span class="request-label">
                        <i class="las la-paperclip  request-icon"></i> Fichiers
                    </span>

                    <div class="request-media-grid">
                        @forelse($selectedRequest->getMedia('requests') as $media)
                            
                            @php
                                $url = asset('storage/' . $media->getPathRelativeToRoot());
                                $isImage = str_contains($media->mime_type, 'image');
                            @endphp

                            <div class="request-media-item">
                                
                                @if($isImage)
                                    <!-- IMAGE PREVIEW -->
                                    <a href="{{ $url }}" target="_blank">
                                        <img src="{{ $url }}" class="request-img" />
                                    </a>
                                @else
                                    <!-- FILE -->
                                    <a href="{{ $url }}" target="_blank" class="request-file">
                                        <i class="las la-file-alt"></i>
                                        <span>{{ $media->name }}</span>
                                    </a>
                                @endif

                            </div>

                        @empty
                            <p class="request-empty">Aucun fichier</p>
                        @endforelse
                    </div>
                </div>

            </div>

        </div>
    @endif

    <x-slot name="footer">
        <button @click="$wire.showModalInterne = false" class="btn btn-danger">Fermer</button>
    </x-slot>

</x-centered-modal>

<!-- DELETE MODAL -->
<x-confirm-modal 
    wire:model="confirmingDelete"
    title="Suppression"
    message="Supprimer cette demande ?"
    wire:confirm="delete"
/>

</div>