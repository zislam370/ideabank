<?php

Validator::extend('alpha_space', function ($attribute,$value,$parameters) {
    return preg_match("/^[\s\n\-+:?#~'\/\(\)_,!.a-zA-Z0-9\pL\pN_-]+$/um",$value);
});

Validator::extend('mobile', function ($attribute,$value,$parameters) {
    return preg_match("/^[0]{1}[1]{1}[156789]{1}[0-9]{4}[0-9]{4}$/um",$value);
});
