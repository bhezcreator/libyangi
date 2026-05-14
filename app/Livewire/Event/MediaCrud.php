<?php

namespace App\Livewire\Event;

use App\Models\Media;
use Intervention\Image\Facades\Image;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class MediaCrud extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'custom';

    public $event_id;
    public $media_id;

    public $files = [];
    public $type;
    public $visibility = 'public';

    public $search = '';
    public $showModalInterne = false;
    public $confirmingDelete = false;

    public $deleteId;
    public $isPrivate = false;
    public $isEdit = false;

    protected function rules()
    {
        return [

            'files.*' => [
                'nullable',
                'mimes:jpg,jpeg,png,webp,mp4,mov,avi',
                'max:10240'
            ],
            'visibility' => 'required',
        ];
    }

    public function mount($event_id)
    {
        $this->event_id = $event_id;
        $this->clearFiles();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function updatedFiles()
    {
        $this->files = collect($this->files)
            ->filter(fn($item) => is_object($item) && method_exists($item, 'temporaryUrl'))
            ->values()
            ->toArray();
    }

    /* =========================
        CREATE
    ========================= */
    public function create()
    {
        $this->resetForm();
        $this->clearFiles();

        $this->isEdit = false;
        $this->showModalInterne = true;
    }

    /* =========================
    SAVE
    ========================= */
    public function save()
    {
        $this->validate();

        if ($this->media_id) {
            $media = Media::where('event_id', $this->event_id)
                ->where('id', $this->media_id)
                ->firstOrFail();

            // update uniquement visibilité
            $media->update([
                'visibility' => $this->isPrivate ? 'private' : 'public',
            ]);

            // si nouveau fichier uploadé
            if (!empty($this->files)) {

                $media->clearMediaCollection('images');

                foreach ($this->files as $file) {

                    // 🔥 type TOUJOURS calculé depuis le fichier
                    $type = str_contains($file->getMimeType(), 'video')
                        ? 'video'
                        : 'image';

                    // update type réel
                    $media->update([
                        'type' => $type,
                    ]);

                    $this->handleUpload($media, $file);
                }
            }
        } else {

            foreach ($this->files as $file) {
                $type = str_contains($file->getMimeType(), 'video') ? 'video' : 'image';

                $media = Media::create([
                    'event_id' => $this->event_id,
                    'type' => $type,
                    'visibility' => $this->isPrivate ? 'private' : 'public',
                ]);

                $this->handleUpload($media, $file);
            }
        }

        $this->dispatch(
            'toast',
            type: 'success',
            message: $this->media_id ? 'Média modifié' : 'Médias ajoutés'
        );

        $this->resetForm();
        $this->showModalInterne = false;
    }

    protected function handleUpload($model, $files)
    {
        try {

            /*
        |--------------------------------------------------------------------------
        | IMAGE
        |--------------------------------------------------------------------------
        */
            if (str_contains($files->getMimeType(), 'image')) {

                // dossier temp
                $tempDir = storage_path('app/temp');

                if (!File::exists($tempDir)) {
                    File::makeDirectory($tempDir, 0755, true);
                }

                // nom unique
                $fileName = uniqid('media_') . '.jpeg';

                // chemin temp
                $tempPath = $tempDir . '/' . $fileName;

                // traitement image
                $image = Image::make($files->getRealPath())
                    ->orientate()
                    ->resize(1400, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->encode('jpeg', 75);

                // sauvegarde physique TEMPORAIRE
                $image->save($tempPath);

                // vérification
                if (!file_exists($tempPath)) {

                    throw new \Exception(
                        'Le fichier image temporaire n’a pas été créé.'
                    );
                }

                // ajout media
                $mediaItem = $model
                    ->addMedia($tempPath)
                    ->usingFileName($fileName)
                    ->usingName(pathinfo($files->getClientOriginalName(), PATHINFO_FILENAME))
                    ->toMediaCollection('images', 'public');

                // suppression temp
                if (file_exists($tempPath)) {
                    unlink($tempPath);
                }
            } else {

                /*
            |--------------------------------------------------------------------------
            | AUTRES FICHIERS
            |--------------------------------------------------------------------------
            */

                $mediaItem = $model
                    ->addMedia($files->getRealPath())
                    ->usingFileName($files->getClientOriginalName())
                    ->usingName(pathinfo($files->getClientOriginalName(), PATHINFO_FILENAME))
                    ->toMediaCollection('images', 'public');
            }

            /*
        |--------------------------------------------------------------------------
        | VERIFICATION FINALE
        |--------------------------------------------------------------------------
        */

            $finalPath = $mediaItem->getPath();

            if (!file_exists($finalPath)) {

                Log::error('Media introuvable après upload', [
                    'path' => $finalPath,
                    'url' => $mediaItem->getUrl(),
                ]);

                throw new \Exception(
                    'Le fichier final n’existe pas physiquement.'
                );
            }

            return $mediaItem;
        } catch (\Throwable $e) {

            Log::error('Erreur upload média', [
                'message' => $e->getMessage(),
            ]);

            throw $e;
        }
    }

    /* =========================
        EDIT
    ========================= */
    public function edit(Int $id)
    {
        $media = Media::where(
            'event_id',
            $this->event_id
        )->findOrFail($id);

        $this->media_id = $media->id;
        $this->type = $media->type;
        $this->visibility = $media->visibility;
        $this->isPrivate = $media->visibility == 'public' ? false : true;

        $this->clearFiles();
        $this->isEdit = true;
        $this->showModalInterne = true;
    }

    /* =========================
        DELETE
    ========================= */
    public function confirmDelete(Int $id)
    {
        $this->deleteId = $id;

        $this->confirmingDelete = true;
    }

    public function confirm()
    {
        $media = Media::where(
            'event_id',
            $this->event_id
        )->findOrFail($this->deleteId);

        $media->clearMediaCollection('images');

        $media->delete();

        $this->confirmingDelete = false;

        $this->dispatch(
            'toast',
            type: 'success',
            message: 'Média supprimé'
        );
    }

    public function clearFiles()
    {
        $this->files = [];
    }

    /* =========================
        RESET
    ========================= */
    public function resetForm()
    {
        $this->reset([
            'media_id',
            'type',
            'visibility',
        ]);

        $this->type = 'image';
        $this->isPrivate = false;
        $this->visibility = 'public';
    }

    /* =========================
        RENDER
    ========================= */
    public function render()
    {
        $medias = Media::where(
            'event_id',
            $this->event_id
        )

            ->where(function ($query) {

                $query
                    ->where(
                        'type',
                        'like',
                        "%{$this->search}%"
                    )

                    ->orWhere(
                        'visibility',
                        'like',
                        "%{$this->search}%"
                    );
            })

            ->latest()

            ->paginate(10);

        return view(
            'livewire.event.media-crud',
            compact('medias')
        );
    }
}
