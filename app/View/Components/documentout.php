<?php

namespace App\View\Components;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class documentout extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $documentout;
    public function __construct(Model $data)
    {   
        $this->documentout = $data;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.documentout');
    }
}
