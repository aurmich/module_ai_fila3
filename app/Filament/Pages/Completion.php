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
use Modules\Xot\Filament\Pages\XotBasePage;
=======
>>>>>>> 5409c9c (.)
=======
=======
use Modules\Xot\Filament\Pages\XotBasePage;
>>>>>>> 4819637 (.)
>>>>>>> db419c8 (.)
=======
>>>>>>> 168177a (.)
use Filament\Support\Exceptions\Halt;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Modules\AI\Actions\CompletionAction;
use Modules\AI\Actions\SentimentAction;
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
use Modules\Xot\Filament\Pages\XotBasePage;
>>>>>>> 5409c9c (.)
=======
use Modules\Xot\Filament\Pages\XotBasePage;
=======
>>>>>>> 4819637 (.)
>>>>>>> db419c8 (.)
=======
use Modules\Xot\Filament\Pages\XotBasePage;
>>>>>>> 168177a (.)
use Webmozart\Assert\Assert;


/**
 * @property ComponentContainer $form
 * @property ComponentContainer $completionForm
 */
class Completion extends XotBasePage 
{
    

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'ai::filament.pages.completion';

    public ?array $completionData = [];

    public function mount(): void
    {
<<<<<<< HEAD
        $this->fillForms();
=======
        $this->completionForm->fill();
>>>>>>> 5409c9c (.)
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
<<<<<<< HEAD
<<<<<<< HEAD
            $action = new CompletionAction();
=======
            $action = new CompletionAction;
>>>>>>> 5409c9c (.)
=======
            $action = new CompletionAction;
=======
            $action = new CompletionAction();
>>>>>>> 4819637 (.)
>>>>>>> db419c8 (.)
=======
>>>>>>> 168177a (.)
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

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
            $action = new SentimentAction();
=======
            $action = new SentimentAction;
>>>>>>> 5409c9c (.)
=======
            $action = new SentimentAction;
=======
            $action = new SentimentAction();
>>>>>>> 4819637 (.)
>>>>>>> db419c8 (.)
=======
>>>>>>> 168177a (.)
            $result = $action->execute($prompt);

            $this->dispatch('sentiment-completed', result: $result);
        } catch (Halt $exception) {
            // Form validation failed
        }
    }

    protected function getUser(): Authenticatable&Model
    {
        $user = Filament::auth()->user();

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
        if (null === $user) {
=======
        if ($user === null) {
>>>>>>> 5409c9c (.)
=======
        if ($user === null) {
=======
        if (null === $user) {
>>>>>>> 4819637 (.)
>>>>>>> db419c8 (.)
            throw new \RuntimeException('Nessun utente autenticato trovato.');
        }
=======
>>>>>>> 168177a (.)

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
    }
}
