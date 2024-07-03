<?php

namespace App\View\Components\Admin;

use App\Models\User;
use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Navbar extends Component
{

    public $user;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->user = User::with('userProfile')->find(auth()->user()->id);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.navbar');
    }
}
