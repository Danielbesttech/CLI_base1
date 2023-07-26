<?php

namespace App\Midlewares\Http;

class Guest
{
    public function handle(): bool
    {
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<p><i>O middleware <b>Guest</b> foi executado!</i></p>";
      die;
        $guest = true;
        if ($guest) {
            return true;
        }
        return false;
    }
}
