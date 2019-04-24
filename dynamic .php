<?php

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $error = false;
    foreach($_POST as $key => $value)
    {
        if(strpos($key, 'field') === 0)
        {
            if($value == '')
            {
                $error = true;
                break;
            }
        }
    }

    if($error)
    {
        // not all fields have a value - show message
    }
}