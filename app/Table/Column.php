<?php
namespace App\Table;

class Column
{
    public string $component = 'columns.column';

    public string $key;

    public string $label;

    public function __construct($key, $label,$sortable=false)
    {
        $this->key = $key;
        $this->sortable = $sortable;
        $this->label = $label;
    }

    public static function make($key, $label, $sortable=false)
    {
        return new static($key, $label, $sortable);
    }
    public function component($component)
    {
        $this->component = $component;

        return $this;
    }

}
