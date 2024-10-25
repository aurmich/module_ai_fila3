<x-filament-panels::page>
<<<<<<< HEAD
    <x-filament-panels::form wire:submit="completion">
        {{ $this->completionForm }}

        <x-filament-panels::form.actions
            :actions="$this->getCompletionFormActions()"
        />

=======
    <x-filament-panels::form>
        {{ $this->completionForm }}
>>>>>>> 608c8b3 (up)
    </x-filament-panels::form>
</x-filament-panels::page>
