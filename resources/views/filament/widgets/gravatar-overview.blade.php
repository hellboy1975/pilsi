<x-filament-widgets::widget>
    <x-filament::section>
    <div class="flex items-center gap-x-3">
            
            <div class="flex-1">
                <h2
                    class="grid flex-1 text-base font-semibold leading-6 text-gray-950 dark:text-white"
                >
                    Avatars
                </h2>

                <p class="text-sm text-gray-500 dark:text-gray-400">
                    You can setup your Avatar using the site <a href="https://gravatar.com">Gravatar</a>
                </p>
            </div>

            @csrf
            <form action="https://gravatar.com">
                <x-filament::button
                    color="gray"
                    icon="heroicon-m-link"
                    icon-alias="panels::widgets.account.logout-button"
                    labeled-from="sm"
                    tag="button"
                    type="submit"
                >
                    Gravatar.com
                </x-filament::button>
            </form>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
