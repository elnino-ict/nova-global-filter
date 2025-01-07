<?php

namespace Marshmallow\NovaGlobalFilter;

use Laravel\Nova\Card;

class NovaGlobalFilter extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    protected $filters;

    public $inline = false;

    public $resettable = false;

    public $width = 'full';

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'nova-global-filter';
    }


    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function jsonSerialize(): array
    {
        return array_merge(parent::jsonSerialize(), [
            'filters' => collect($this->filters ?? [])->map(function ($filter) {
                return $filter->jsonSerialize();
            })->values()->all(),
            'inline' => $this->inline,
            'resettable' => $this->resettable,
            'width' => $this->width,
        ]);
    }

    public function width($width = "full")
    {
        $this->width = $width;
        return $this;
    }

    public function inline()
    {
        $this->inline = true;
        return $this;
    }

    public function resettable()
    {
        $this->resettable = true;
        return $this;
    }
}
