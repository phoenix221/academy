<?php

class DatabanksController
{
    function index()
    {
        d()->banks_list = d()->Databank;
        if($_POST['search']){
            $search_string = 'id="'.$_POST['search'].'" OR mapdx LIKE "%'.$_POST['search'].'%" OR description LIKE "%'.$_POST['search'].'%"';
            $search_string .= ' OR pol LIKE "%'.$_POST['search'].'%" OR dvmr LIKE "%'.$_POST['search'].'%"';
            $search_string .= ' OR education LIKE "%'.$_POST['search'].'%" OR profession LIKE "%'.$_POST['search'].'%"';
            $search_string .= ' OR marriage LIKE "%'.$_POST['search'].'%" OR children LIKE "%'.$_POST['search'].'%"';
            $search_string .= ' OR parents LIKE "%'.$_POST['search'].'%" OR relatives LIKE "%'.$_POST['search'].'%"';
            $search_string .= ' OR friends LIKE "%'.$_POST['search'].'%" OR moving LIKE "%'.$_POST['search'].'%"';
            $search_string .= ' OR finance LIKE "%'.$_POST['search'].'%" OR health LIKE "%'.$_POST['search'].'%"';
            $search_string .= ' OR spirituality LIKE "%'.$_POST['search'].'%" OR peculiarities LIKE "%'.$_POST['search'].'%"';
            $search_string .= ' OR related_cards LIKE "%'.$_POST['search'].'%"';
            d()->banks_list = d()->Databank->where($search_string);
        }
    }

    function show()
    {
        d()->this = d()->Databank($_POST['id']);
    }
}