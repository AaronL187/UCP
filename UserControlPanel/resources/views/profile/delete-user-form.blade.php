<x-action-section>
    <x-slot name="title">
        {{ __('Fiók Törlése') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Véglegesen törölje fiókját.') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            {{ __('Miután fiókja törölve lett, minden adata véglegesen törlődik. A fiók törlése előtt kérjük, töltse le azokat az adatokat vagy információkat, amelyeket meg szeretne őrizni.') }}
        </div>

        <div class="mt-5">
            <x-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                {{ __('Fiók Törlése') }}
            </x-danger-button>
        </div>

        <!-- Törlés megerősítése Modal -->
        <x-dialog-modal wire:model.live="confirmingUserDeletion">
            <x-slot name="title">
                {{ __('Fiók Törlése') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Biztosan törölni szeretné fiókját? Miután fiókja törölve lett, minden erőforrása és adata véglegesen törlődik. Kérjük, írja be jelszavát a fiók végleges törlésének megerősítéséhez.') }}

                <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-input type="password" class="mt-1 block w-3/4"
                             autocomplete="current-password"
                             placeholder="{{ __('Jelszó') }}"
                             x-ref="password"
                             wire:model="password"
                             wire:keydown.enter="deleteUser" />

                    <x-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    {{ __('Mégse') }}
                </x-secondary-button>

                <x-danger-button class="ms-3" wire:click="deleteUser" wire:loading.attr="disabled">
                    {{ __('Fiók Törlése') }}
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>
    </x-slot>
</x-action-section>
