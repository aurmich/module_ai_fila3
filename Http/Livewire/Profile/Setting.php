<?php

declare(strict_types=1);

namespace Modules\Blog\Http\Livewire\Profile;

use Filament\Actions\Action;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Modules\Blog\Models\Profile;
use Modules\Xot\Actions\GetViewAction;
use Webmozart\Assert\Assert;

/**
 * @property ComponentContainer $form
 */
class Setting extends Page implements HasForms
{
    use InteractsWithForms;

    public string $tpl = 'setting';
    public string $version = 'v1';
    public Profile $model;
    public array $data = [];

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public function mount(
        Profile $model,
        string $tpl = 'v1'
    ): void {
        $this->model = $model;
        $this->tpl = $tpl;
        // dddx($this->model->toArray());

        $this->data['name'] = $this->model->user_name;

        $this->form->fill($this->data);
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        /**
         * @phpstan-var view-string
         */
        $view = app(GetViewAction::class)->execute($this->version);

        $view_params = [
            'view' => $view,
        ];

        return view($view, $view_params);
    }

    public function url(string $name, array $params): string
    {
        return '#';
    }

    public function form(Form $form): Form
    {
        if (0 === \count($this->model->extra->all())) {
            $this->data['extra'] = [
                $this->model->extra->get('newsletter', ['newsletter' => false]),
                $this->model->extra->get('predix_updates', ['predix_updates' => false]),
                $this->model->extra->get('market_updates', ['market_updates' => false]),
            ];

        // dddx($this->data['extra']);
        } else {
            $this->data['extra'] = [$this->model->extra->all()];
            // dddx($this->data['extra']);
        }

        // dddx($this->data['extra'][0]);

        $schema = [];

        // $schema[] = Toggle::make($this->data['extra'][0]['newsletter'])
        //             ->label('aaa')
        //         ;
        foreach ($this->data['extra'] as $key => $field) {
            // dddx([$key, $field]);
            if (! is_iterable($field)) {
                continue;
            }
            foreach ($field as $key => $f) {
                $schema[] = Toggle::make($key)
                    ->label($key)
                ;
            }
        }

        // dddx($schema);
        return $form
            ->schema($schema)
            ->statePath('data.extra.0');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();
        // dddx($data);
        Assert::notNull($this->model->user);
        $this->model->user->update($data);
    }

    public function saveExtra(): void
    {
        $data = $this->form->getState();
        /* Property Modules\Blog\Models\Profile::$extra
        (Illuminate\Database\Eloquent\Collection<string, bool>)
        does not accept
        array<string, mixed>.
        */
        $this->model->extra->set($data);
        $this->model->save();
    }
}
