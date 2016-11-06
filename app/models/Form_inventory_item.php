<?php

class Form_inventory_item extends Eloquent {
    protected $guarded = array();

    public static $rules = array(

    );
    public function parent()
    {
        return $this->belongsTo('Form_inventory', 'form_inventory_id');
    }
}
