<?php

namespace App\View\Components\Student;

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
        $userId = auth()->user()->id;
        $user = UserService::getAuthenticatedUser($userId)->fetch();
        // $name = "a";
        return view('components.student.navbar')
            ->with('user', $user);
    }
}
