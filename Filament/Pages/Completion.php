<?php

declare(strict_types=1);

namespace Modules\AI\Filament\Pages;

<<<<<<< HEAD
use Exception;
use Filament\Actions\Action;
=======
>>>>>>> 608c8b3 (up)
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
<<<<<<< HEAD
use Filament\Support\Exceptions\Halt;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Modules\AI\Actions\CompletionAction;
use Modules\AI\Actions\SentimentAction;
=======
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
>>>>>>> 608c8b3 (up)

/**
 * @property ComponentContainer $form
 * @property ComponentContainer $completionForm
 */
class Completion extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'ai::filament.pages.completion';

<<<<<<< HEAD
    public ?array $completionData = [];
=======
    public ?array $data = [];
>>>>>>> 608c8b3 (up)

    public function mount(): void
    {
        $this->fillForms();
    }

<<<<<<< HEAD
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
            $prompt = $data['prompt'];
            // dddx($prompt);
            // $res = app(CompletionAction::class)->execute($prompt);
            // The quality of tools in the PHP ecosystem has greatly improved in recent years
            $res = app(SentimentAction::class)->execute((string) $prompt);

            // $this->handleRecordUpdate($this->getUser(), $data);
        } catch (Halt $exception) {
            return;
        }
    }

=======
>>>>>>> 608c8b3 (up)
    protected function getForms(): array
    {
        return [
            'completionForm',
        ];
    }

<<<<<<< HEAD
    protected function getCompletionFormActions(): array
    {
        return [
            Action::make('completionAction')
                ->label(__('filament-panels::pages/auth/edit-profile.form.actions.save.label'))
                ->submit('completionForm'),
        ];
=======
    public function completionForm(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Profile Information')
                    ->description('Update your account\'s profile information and email address.')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required(),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true),
                    ]),
            ])
            ->model($this->getUser())
            ->statePath('profileData');
>>>>>>> 608c8b3 (up)
    }

    protected function getUser(): Authenticatable&Model
    {
        $user = Filament::auth()->user();

        if (! $user instanceof Model) {
<<<<<<< HEAD
            throw new Exception('The authenticated user object must be an Eloquent model to allow the profile page to update it.');
=======
            throw new \Exception('The authenticated user object must be an Eloquent model to allow the profile page to update it.');
>>>>>>> 608c8b3 (up)
        }

        return $user;
    }

    protected function fillForms(): void
    {
        $data = $this->getUser()->attributesToArray();

        $this->completionForm->fill($data);
    }
}
