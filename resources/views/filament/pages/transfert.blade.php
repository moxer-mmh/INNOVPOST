<x-filament::page>
    <form wire:submit.prevent="send">
        <div class="space-y-4">
            <label>Account Number</label>
            <div class="border-2 border-black rounded-md">
                <x-filament::input wire:model="recipient_account_number" id="recipient_account_number" type="text" class="border-2 border-black" />
            </div>

            <label class="mt-3">Amount</label>
            <div class="border-2 mt-2 border-black rounded-md">
                <x-filament::input wire:model="amount" id="amount" type="number" />
            </div>
            @error('recipient_account_number')
            <p  > $message </p>
            @enderror
            <x-filament::button type="submit" color="success" size="lg">
                Send Money
            </x-filament::button>
        </div>
    </form>

</x-filament::page>
