<?php

namespace App\View\Components\Admin\User;

use App\Models\Role;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    public $user;
    public $roles;
    /**
     * Create a new component instance.
     */
    public function __construct($user = null)
    {
        $this->user = $user;
        $this->roles = Role::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.user.form');
    }
}
