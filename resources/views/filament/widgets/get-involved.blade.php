<x-filament-widgets::widget>
    <x-filament::section>
    <div class="flex items-center gap-x-3">
            
            <div class="flex-1">
                <h2
                    class="grid flex-1 text-base font-semibold leading-6 text-gray-950 dark:text-white"
                >
                    Get Involved!
                </h2>

                <p class="text-sm text-gray-500 dark:text-gray-400">
                    You can get involved in the development of this site via our <a href="https://github.com/hellboy1975/pilsi">Github.</a>  You can use this to make suggestions, and discuss those made by others.  You can even contribute code if you're super keen!
                </p>
            </div>

            @csrf
            <form action="https://github.com/hellboy1975/pilsi">
                <x-filament::button
                    color="gray"
                    icon="heroicon-m-code-bracket"
                    icon-alias="panels::widgets.account.logout-button"
                    labeled-from="sm"
                    tag="button"
                    type="submit"
                >
                    Github
                </x-filament::button>
            </form>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
