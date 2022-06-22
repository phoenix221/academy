<?php

class DatabanksController
{
    function index()
    {
        d()->banks_list = d()->Databank;
    }
}