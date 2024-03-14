<?php
/**
 * To set config
 *
 * @param  mixed  $name
 * @param  mixed  $data
 */
function config_set($name, $data): void
{
    if (is_array($data)) {
        foreach ($data as $key => $value) {
            Illuminate\Support\Facades\Config::set($name.'.'.$key, $value);
        }
    } else {
        Illuminate\Support\Facades\Config::set($name, $data);
    }
}
