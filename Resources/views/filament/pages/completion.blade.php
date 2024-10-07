<x-filament-panels::page>
    <x-filament-panels::form wire:submit="completion">
        {{ $this->completionForm }}

<<<<<<< HEAD
        <x-filament-panels::form.actions
=======
        <x-filament-panels::form.actions 
>>>>>>> fd7d110 (up)
            :actions="$this->getCompletionFormActions()"
        />

    </x-filament-panels::form>
</x-filament-panels::page>
