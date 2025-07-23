<?php

namespace App\Livewire;

use Livewire\Component;

class Contact extends Component
{
    public function render()
    {
        return <<<'HTML'
        <div class="text-center mt-30">
            <h1 class="text-3xl font-semibold">Contact Page</h1>
        </div>
        HTML;
    }
}
