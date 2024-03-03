<?php

namespace App\Livewire;

use Jeffgreco13\FilamentBreezy\Livewire\MyProfileComponent;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Facades\Filament;
use Filament\Forms\Components\Group;
use Jeffgreco13\FilamentBreezy\Livewire\PersonalInfo;

class PilsiProfileComponent extends PersonalInfo
{
    public array $only = ['name', 'email', 'location'];

    protected function getProfileFormSchema()
    {
        $groupFields = Group::make([
            $this->getNameComponent(),
            $this->getEmailComponent(),
            $this->getLocationComponent(),
        ])->columnSpan(2);

        return ($this->hasAvatars)
            ? [filament('filament-breezy')->getAvatarUploadComponent(), $groupFields]
            : [$groupFields];
    }

    protected function getLocationComponent(): TextInput
    {
        return TextInput::make('location')
            ->required()
            ->label(__('Location'));
    }
}
