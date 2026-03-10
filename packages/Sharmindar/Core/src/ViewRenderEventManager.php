<?php

namespace Sharmindar\Core;

use Illuminate\Support\Facades\Event;

class ViewRenderEventManager
{
    /**
     * Contains all templates
     *
     * @var array
     */
    protected $templates = [];

    /**
     * Parameters passed with event
     *
     * @var array
     */
    protected $params;

    protected static $eventStack = [];

    /**
     * Fires event for rendering template
     *
     * @param  string  $eventName
     * @param  array|null  $params
     * @return array
     */
    public function handleRenderEvent($eventName, $params = null)
    {
        if (in_array($eventName, static::$eventStack)) {
            return [];
        }

        static::$eventStack[] = $eventName;

        $this->params = $params ?? [];

        Event::dispatch($eventName, $this);

        array_pop(static::$eventStack);

        return $this->templates;
    }

    /**
     *  get params
     *
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     *  get param
     *
     * @return mixed
     */
    public function getParam($name)
    {
        return optional($this->params)[$name];
    }

    /**
     * Add templates for render
     *
     * @param  string  $template
     * @return void
     */
    public function addTemplate($template)
    {
        array_push($this->templates, $template);
    }

    /**
     * Renders templates
     *
     * @return string
     */
    public function render()
    {
        $string = '';

        foreach ($this->templates as $template) {
            if (view()->exists($template)) {
                $string .= view($template, $this->params)->render();
            }
            elseif (is_string($template)) {
                $string .= $template;
            }
        }

        return $string;
    }
}
