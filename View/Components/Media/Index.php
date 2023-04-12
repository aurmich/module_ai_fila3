<?php

declare(strict_types=1);

namespace Modules\Media\View\Components\Media;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\Component;
use Modules\Cms\Actions\GetViewAction;
use Modules\Media\Traits\WithAccessingMedia;
use Spatie\MediaLibrary\HasMedia;

class Index extends Component {
    use WithAccessingMedia;
    public string $tpl = 'v1';

    public string $name;
    public HasMedia $model;
    public string $collection;

    public string $rules;
    public ?int $maxItems;
    public bool $sortable;
    public bool $editableName = true;

    public array $media;

    public ?string $componentView;
    public ?string $listView;
    public ?string $itemView;
    public ?string $propertiesView;
    public ?string $fieldsView;

    public bool $multiple = true;

    public function __construct(
        string $name,
        HasMedia $model,
        string $collection = null,
        string $rules = '',
        ?int $maxItems = null,
        bool $sortable = true,
        bool $editableName = true,
        ?string $view = null,
        ?string $listView = null,
        ?string $itemView = null,
        ?string $propertiesView = null,
        ?string $fieldsView = null,
        bool $multiple = true
    ) {
        $this->name = $name;
        $this->model = $model;
        $this->collection = $collection ?? 'default';

        $this->rules = $rules;
        $this->maxItems = $maxItems;
        $this->editableName = $editableName;
        $this->sortable = $sortable;

        $this->media = $this->getMedia($name, $model, $this->collection);

        $this->componentView = $view;
        $this->listView = $listView ?? 'media::livewire.partials.collection.list';
        $this->itemView = $itemView ?? 'media::livewire.partials.collection.item';
        $this->propertiesView = $propertiesView ?? 'media::livewire.partials.collection.properties';
        $this->fieldsView = $fieldsView ?? 'media::livewire.partials.collection.fields';

        $this->multiple = $multiple;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): Renderable {
        /**
         * @phpstan-var view-string
         */
        $view = app(GetViewAction::class)->execute($this->tpl);
        $view_params = [
            'view' => $view,
        ];

        return view($view, $view_params);
    }
}
