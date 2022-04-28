<?php

if(!function_exists('flash'))
{
    function flash($message, $type = 'success')
    {
        session()->flash('message', $message);
        session()->flash('message_type', $type);
    }
}

if(!function_exists('pushall'))
{
    function push_all($title = null, $text = null)
    {
        if(is_null($title) || is_null($text)) {
            return app(\App\Service\Pushall::class);
        }

        return  app(\App\Service\Pushall::class)->send($title, $text);
    }
}