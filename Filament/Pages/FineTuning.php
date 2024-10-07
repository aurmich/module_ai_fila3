<?php

namespace Modules\AI\Filament\Pages;

use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\Action;
use Filament\Pages\Page;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class FineTuning extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static string $view = 'ai::filament.pages.fine-tuning';

    public string $learning_rate = '0.001';
    public int $batch_size = 32;
    public int $epochs = 10;
    public string $dataset = 'dataset1';

    /**
     * Schema del form
     */
    protected function getFormSchema(): array
    {
        return [
            TextInput::make('learning_rate')
                ->label(__('ai::fine_tuning.learning_rate'))  // Usiamo la traduzione per il label
                ->required()
                ->numeric()
                ->minValue(0)
                ->helperText(__('ai::fine_tuning.learning_rate_helper')),

            TextInput::make('batch_size')
                ->label(__('ai::fine_tuning.batch_size'))  // Traduzione per batch size
                ->required()
                ->numeric()
                ->minValue(1)
                ->helperText(__('ai::fine_tuning.batch_size_helper')),

            TextInput::make('epochs')
                ->label(__('ai::fine_tuning.epochs'))  // Traduzione per epochs
                ->required()
                ->numeric()
                ->minValue(1)
                ->helperText(__('ai::fine_tuning.epochs_helper')),

            Select::make('dataset')
                ->label(__('ai::fine_tuning.dataset'))  // Traduzione per dataset
                ->options([
                    'dataset1' => __('ai::fine_tuning.dataset1'),
                    'dataset2' => __('ai::fine_tuning.dataset2'),
                ])
                ->required(),
            Forms\Components\FileUpload::make('dataset_file')
                ->label(__('ai::fine_tuning.dataset_file'))
                ->required()
                ->helperText(__('ai::fine_tuning.dataset_file_helper')),
        ];
    }

    /**
     * Avvia il processo di fine-tuning
     */
    public function startFineTuning(): void
    {
        $data = [
            'learning_rate' => (float) $this->learning_rate,
            'batch_size' => (int) $this->batch_size,
            'epochs' => (int) $this->epochs,
            'dataset' => $this->dataset,
        ];

        if ($this->dataset_file) {
            $data['dataset_file'] = $this->dataset_file->getRealPath(); // Percorso del file caricato
        }

        $apiEndpoint = Config::get('ai.backend_api.fine_tuning_url');

        $response = $this->sendFineTuningRequest($data, $apiEndpoint);

        if ($response->successful()) {
            Notification::make()
                ->title(__('ai::fine_tuning.success_title'))  // Traduzione per il titolo di successo
                ->body(__('ai::fine_tuning.success_body'))    // Traduzione per il messaggio di successo
                ->success()
                ->send();
        } else {
            Notification::make()
                ->title(__('ai::fine_tuning.error_title'))  // Traduzione per il titolo di errore
                ->body(__('ai::fine_tuning.error_body'))    // Traduzione per il messaggio di errore
                ->danger()
                ->send();
        }
    }

    protected function sendFineTuningRequest(array $data, string $endpoint): Response
    {
        //return Http::post($endpoint, $data);
        return Http::attach('dataset_file', file_get_contents($data['dataset_file']), basename($data['dataset_file']))
        ->post($endpoint, $data);
    }

    /**
     * Restituisce le azioni del form, come il pulsante per avviare il fine-tuning
     */
    protected function getFormActions(): array
    {
        return [
            Action::make('submit')
                ->label(__('ai::fine_tuning.action_label'))
                ->action('startFineTuning')
                ->color('primary'),
        ];
    }
}
