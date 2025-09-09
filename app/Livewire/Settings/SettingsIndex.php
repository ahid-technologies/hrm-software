<?php

namespace App\Livewire\Settings;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Settings')]
class SettingsIndex extends Component
{
    public $activeTab = 'notifications';

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('settings.settings-index');
    }
}
