<?php

function getInt($string) {
    return preg_replace("/\D/", "", $string);
}