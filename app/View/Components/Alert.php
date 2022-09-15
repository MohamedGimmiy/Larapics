<?php

namespace App\View\Components;

use Illuminate\Support\HtmlString;
use Illuminate\View\Component;

class Alert extends Component
{
    public $type;
    public $dismissible;
    protected $types = [
        'success',
        'danger',
        'info',
        'warning'
    ];
    protected $classes = ['alert'];
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type = 'info', $dismissible = false)
    {
        $this->type = $this->validType($type);
        $this->classes [] = "alert-{$this->type}";
        if($dismissible){
            $this->classes[]= 'alert-dismissible fade show';
        }
        $this->dismissible = $dismissible;
    }
    protected function validType($type)
    {
        return in_array($type, $this->types) ? $type : 'info';
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.alert');
    }

    public function link($text, $target = '#')
    {
        return new HtmlString("<a href='{$target}' class='alert-link'>{$text}</a>") ;
    }

    public function icon($url = null)
    {   // if not null
        $this->classes[] = 'd-flex align-items-center';
        $icon = $url ?? asset("icons/icon-{$this->type}.svg");
        return new HtmlString("<img src='{$icon}' alt='' class='me-2'/>");

    }
    public function getClasses()
    {
        return join(" ",$this->classes);
    }

}
