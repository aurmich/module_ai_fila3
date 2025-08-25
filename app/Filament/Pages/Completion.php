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
use Filament\Support\Exceptions\Halt;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Modules\AI\Actions\CompletionAction;
use Modules\AI\Actions\SentimentAction;
<<<<<<< HEAD
<<<<<<< HEAD
use Modules\Xot\Filament\Pages\XotBasePage;
=======
>>>>>>> c657866 (.)
=======
>>>>>>> 2019a7e (.)
use Webmozart\Assert\Assert;

/**
 * @property ComponentContainer $form
 * @property ComponentContainer $completionForm
 */
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 2019a7e (.)
class Completion extends XotBasePage implements HasForms
{
    use InteractsWithForms;

<<<<<<< HEAD
    //protected static ?string $navigationIcon = 'heroicon-o-document-text';
<<<<<<< HEAD
=======
class Completion extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
>>>>>>> c657866 (.)
=======
>>>>>>> 2019a7e (.)
=======
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
>>>>>>> e7a042c (.)

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
    }

    protected function getUser(): Authenticatable&Model
    {
        $user = Filament::auth()->user();

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
    }
}
