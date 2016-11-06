<?php

class Message extends Eloquent
{
    protected $guarded = array();

    public static $rules = array(

        'sender_id' => 'required',
        'recever_id' => 'required',
        'body' => 'required|min:3',



    );

}


