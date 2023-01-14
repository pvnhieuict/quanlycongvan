<?php

namespace App\View\Components;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class Documentin extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $documentin;
    public function __construct(Model $data)
    {
        $this->documentin = $data;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.documentin');
    }
}
