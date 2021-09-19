<?php

class Kur extends ActiveRecord
{

    function f_category()
    {
        if($this->get('category') == 1) return 'Астрология';
        if($this->get('category') == 2) return 'Васту';
        if($this->get('category') == 3) return 'Хиромантия';
        return '';
    }
}