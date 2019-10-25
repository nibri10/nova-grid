<?php

namespace Nibri10\NovaGrid;

use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class NovaGrid extends Tool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        Nova::script('nova-grid', __DIR__.'/../dist/js/tool.js');
        Nova::style('nova-grid', __DIR__.'/../dist/css/tool.css');
    }

    /**
     * Build the view that renders the navigation links for the tool.
     *
     * @return void
     */
    public function renderNavigation()
    {
        return ;
    }
}
