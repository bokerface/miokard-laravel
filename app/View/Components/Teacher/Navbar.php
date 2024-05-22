<?php

namespace App\View\Components\Teacher;

use App\Http\Services\UserService;
use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Navbar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $userId = auth()->id();
        $user = UserService::getAuthenticatedUser($userId)->fetch();
        return view('components.teacher.navbar')
            ->with(compact('user'));
    }
}
