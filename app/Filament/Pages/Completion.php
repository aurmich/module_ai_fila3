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
use Modules\Xot\Filament\Pages\XotBasePage;
=======
>>>>>>> 5409c9c (.)
use Filament\Support\Exceptions\Halt;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Modules\AI\Actions\CompletionAction;
use Modules\AI\Actions\SentimentAction;
<<<<<<< HEAD
=======
use Modules\Xot\Filament\Pages\XotBasePage;
>>>>>>> 5409c9c (.)
use Webmozart\Assert\Assert;

/**
 * @property ComponentContainer $form
 * @property ComponentContainer $completionForm
 */
class Completion extends XotBasePage implements HasForms
{
    use InteractsWithForms;

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
            $action = new CompletionAction();
=======
            $action = new CompletionAction;
>>>>>>> 5409c9c (.)
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
            $action = new SentimentAction();
=======
            $action = new SentimentAction;
>>>>>>> 5409c9c (.)
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
        if (null === $user) {
=======
        if ($user === null) {
>>>>>>> 5409c9c (.)
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
    }
}
