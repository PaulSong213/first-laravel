<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Table extends Component
{
    /**
     * The alert datas.
     *
     * @var string
     */
    public $datas;

    /**
     * The alert title.
     *
     * @var string
     */
    public $title;

    /**
     * Create the component instance.
     *
     * @param  string  $datas
     * @param  string  $title
     * @return void
     */
    public function __construct($datas, $title)
    {
        $this->datas = $datas;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.table');
    }
}
