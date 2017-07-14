<?php

class Maker extends \Bugotech\Phar\Maker
{
    /**
     * Executar evento.
     * @param $filename
     */
    protected function fireEvent($filename)
    {
        echo '..' . $filename . "\r\n";
    }
}