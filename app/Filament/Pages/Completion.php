<?php

declare(strict_types=1);

namespace Modules\AI\Filament\Pages;

use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
use Modules\Xot\Filament\Pages\XotBasePage;
=======
>>>>>>> ca0cef7 (.)
=======
use Filament\Pages\Page;
>>>>>>> c657866 (.)
=======
use Modules\Xot\Filament\Pages\XotBasePage;
>>>>>>> 2019a7e (.)
=======
>>>>>>> e7a042c (.)
=======
use Modules\Xot\Filament\Pages\XotBasePage;
>>>>>>> ccf901318 (.)
=======
use Modules\Xot\Filament\Pages\XotBasePage;
>>>>>>> 96b93fe (.)
use Filament\Support\Exceptions\Halt;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Modules\AI\Actions\CompletionAction;
use Modules\AI\Actions\SentimentAction;
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
use Modules\Xot\Filament\Pages\XotBasePage;
=======
>>>>>>> c657866 (.)
=======
>>>>>>> 2019a7e (.)
=======
>>>>>>> 96b93fe (.)
use Webmozart\Assert\Assert;

/**
 * @property ComponentContainer $form
 * @property ComponentContainer $completionForm
 */
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 2019a7e (.)
=======
>>>>>>> 96b93fe (.)
class Completion extends XotBasePage implements HasForms
{
    use InteractsWithForms;

<<<<<<< HEAD
<<<<<<< HEAD
    //protected static ?string $navigationIcon = 'heroicon-o-document-text';
<<<<<<< HEAD
=======
class Completion extends Page implements HasForms
=======
class Completion extends XotBasePage implements HasForms
>>>>>>> ccf901318 (.)
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
>>>>>>> c657866 (.)
=======
>>>>>>> 2019a7e (.)
=======
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
>>>>>>> e7a042c (.)
=======
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
>>>>>>> 96b93fe (.)

    protected static string $view = 'ai::filament.pages.completion';

    public ?array $completionData = [];

    public function mount(): void
    {
        $this->fillForms();
    }

    public function completionForm(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('prompt')
                    ->required(),
            ])
            ->model($this->getUser())
            ->statePath('completionData');
    }

    public function completion(): void
    {
        try {
            $data = $this->completionForm->getState();
            Assert::string($prompt = $data['prompt']);
<<<<<<< HEAD
            // dddx($prompt);
            // $res = app(CompletionAction::class)->execute($prompt);
            // The quality of tools in the PHP ecosystem has greatly improved in recent years
            $res = app(SentimentAction::class)->execute($prompt);

            // $this->handleRecordUpdate($this->getUser(), $data);
        } catch (Halt $exception) {
            return;
        }
    }

    protected function getForms(): array
    {
        return [
            'completionForm',
        ];
    }

    protected function getCompletionFormActions(): array
    {
        return [
            Action::make('completionAction')
                ->label(__('filament-panels::pages/auth/edit-profile.form.actions.save.label'))
                ->submit('completionForm'),
        ];
=======

            $action = new CompletionAction();
            $result = $action->execute($prompt);

            $this->dispatch('completion-completed', result: $result);
        } catch (Halt $exception) {
            // Form validation failed
        }
    }

    public function sentiment(): void
    {
        try {
            $data = $this->completionForm->getState();
            Assert::string($prompt = $data['prompt']);

            $action = new SentimentAction();
            $result = $action->execute($prompt);

            $this->dispatch('sentiment-completed', result: $result);
        } catch (Halt $exception) {
            // Form validation failed
        }
>>>>>>> 96b93fe (.)
    }

    protected function getUser(): Authenticatable&Model
    {
        $user = Filament::auth()->user();

<<<<<<< HEAD
        if (! $user instanceof Model) {
            throw new \Exception('The authenticated user object must be an Eloquent model to allow the profile page to update it.');
        }

        return $user;
    }

    protected function fillForms(): void
    {
        /** @var array<string, mixed> $data */
        $data = $this->getUser()->attributesToArray();

        $this->completionForm->fill($data);
=======
        if (null === $user) {
            throw new \RuntimeException('Nessun utente autenticato trovato.');
        }

        if (! $user instanceof Model) {
            throw new \RuntimeException('L\'utente autenticato deve essere un modello Eloquent per permettere aggiornamenti.');
        }

        /* @var Authenticatable&Model $user */
        return $user;
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('completion')
                ->label('Generate Completion')
                ->action('completion')
                ->color('primary'),

            Action::make('sentiment')
                ->label('Analyze Sentiment')
                ->action('sentiment')
                ->color('secondary'),
        ];
>>>>>>> 96b93fe (.)
    }
}
