<x-action-section>
    <x-slot name="title">
        {{ __('Kétlépcsős Hitelesítés') }}
    </x-slot>

    <x-slot name="description">
        {{ __('További biztonságot adhat a fiókjának a kétlépcsős hitelesítés használatával.') }}
    </x-slot>

    <x-slot name="content">
        <h3 class="text-lg font-medium text-gray-900">
            @if ($this->enabled)
                @if ($showingConfirmation)
                    {{ __('Kétlépcsős hitelesítés befejezése.') }}
                @else
                    {{ __('Be van kapcsolva a kétlépcsős hitelesítés.') }}
                @endif
            @else
                {{ __('Nincs bekapcsolva a kétlépcsős hitelesítés.') }}
            @endif
        </h3>

        <div class="mt-3 max-w-xl text-sm text-gray-600">
            <p>
                {{ __('Amikor a kétlépcsős hitelesítés engedélyezve van, egy biztonságos, véletlenszerű token-t fog kérni az azonosítás során. Ezt a tokent a telefonod Google Authenticator alkalmazásából kaphatod.') }}
            </p>
        </div>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        @if ($showingConfirmation)
                            {{ __('A kétlépcsős hitelesítés befejezéséhez olvassa be a következő QR kódot a telefonjának hitelesítő alkalmazásával, vagy adja meg a beállítási kulcsot, és adja meg a generált OTP kódot.') }}
                        @else
                            {{ __('Most be van kapcsolva a kétlépcsős hitelesítés. Olvassa be a következő QR kódot a telefonjának hitelesítő alkalmazásával, vagy adja meg a beállítási kulcsot.') }}
                        @endif
                    </p>
                </div>

                <div class="mt-4 p-2 inline-block bg-white">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>

                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        {{ __('Beállítási Kulcs') }}: {{ decrypt($this->user->two_factor_secret) }}
                    </p>
                </div>

                @if ($showingConfirmation)
                    <div class="mt-4">
                        <x-label for="code" value="{{ __('Kód') }}" />

                        <x-input id="code" type="text" name="code" class="block mt-1 w-1/2" inputmode="numeric" autofocus autocomplete="one-time-code"
                                 wire:model="code"
                                 wire:keydown.enter="confirmTwoFactorAuthentication" />

                        <x-input-error for="code" class="mt-2" />
                    </div>
                @endif
            @endif

            @if ($showingRecoveryCodes)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        {{ __('Tárolja ezeket a helyreállítási kódokat egy biztonságos jelszókezelőben. Ezekkel a kódokkal visszanyerheti a fiókjához való hozzáférést, ha elveszíti a kétlépcsős hitelesítő eszközét.') }}
                    </p>
                </div>

                <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="mt-5">
            @if (! $this->enabled)
                <x-confirms-password wire:then="enableTwoFactorAuthentication">
                    <x-button type="button" wire:loading.attr="disabled">
                        {{ __('Engedélyezés') }}
                    </x-button>
                </x-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-confirms-password wire:then="regenerateRecoveryCodes">
                        <x-secondary-button class="me-3">
                            {{ __('Helyreállítási Kódok Újragenerálása') }}
                        </x-secondary-button>
                    </x-confirms-password>
                @elseif ($showingConfirmation)
                    <x-confirms-password wire:then="confirmTwoFactorAuthentication">
                        <x-button type="button" class="me-3" wire:loading.attr="disabled">
                            {{ __('Megerősítés') }}
                        </x-button>
                    </x-confirms-password>
                @else
                    <x-confirms-password wire:then="showRecoveryCodes">
                        <x-secondary-button class="me-3">
                            {{ __('Helyreállítási Kódok Megjelenítése') }}
                        </x-secondary-button>
                    </x-confirms-password>
                @endif

                @if ($showingConfirmation)
                    <x-confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-secondary-button wire:loading.attr="disabled">
                            {{ __('Mégse') }}
                        </x-secondary-button>
                    </x-confirms-password>
                @else
                    <x-confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-danger-button wire:loading.attr="disabled">
                            {{ __('Letiltás') }}
                        </x-danger-button>
                    </x-confirms-password>
                @endif

            @endif
        </div>
    </x-slot>
</x-action-section>
