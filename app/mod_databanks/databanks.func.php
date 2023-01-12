<?php

class DatabanksController
{
    function index()
    {
        if(substr(url(), -6)!='/index'){
            header("HTTP/1.1 301 Moved Permanently");
            header('Location: /'.url().'/');
            exit;
        }
        if(url(1)!='databank' || url(2)!='index'){
            d()->page_not_found();
        }

        d()->banks_list = d()->Databank;
        if($_GET['clear']){
            unset($_SESSION['post']);
        }
        if($_POST){
            $_SESSION['post'] = $_POST;
            if($_POST['search']){
                d()->banks_list = d()->banks_list->search('id', 'mapdx', 'description', 'pol', 'dvmr', 'education', 'profession', 'marriage', 'children', 'parents', 'relatives', 'friends', 'moving', 'finance', 'health', 'spirituality', 'peculiarities', 'related_cards', $_POST['search']);
                /*$search_string = 'id="'.$_POST['search'].'" OR mapdx LIKE "%'.$_POST['search'].'%" OR description LIKE "%'.$_POST['search'].'%"';
                $search_string .= ' OR pol LIKE "%'.$_POST['search'].'%" OR dvmr LIKE "%'.$_POST['search'].'%"';
                $search_string .= ' OR education LIKE "%'.$_POST['search'].'%" OR profession LIKE "%'.$_POST['search'].'%"';
                $search_string .= ' OR marriage LIKE "%'.$_POST['search'].'%" OR children LIKE "%'.$_POST['search'].'%"';
                $search_string .= ' OR parents LIKE "%'.$_POST['search'].'%" OR relatives LIKE "%'.$_POST['search'].'%"';
                $search_string .= ' OR friends LIKE "%'.$_POST['search'].'%" OR moving LIKE "%'.$_POST['search'].'%"';
                $search_string .= ' OR finance LIKE "%'.$_POST['search'].'%" OR health LIKE "%'.$_POST['search'].'%"';
                $search_string .= ' OR spirituality LIKE "%'.$_POST['search'].'%" OR peculiarities LIKE "%'.$_POST['search'].'%"';
                $search_string .= ' OR related_cards LIKE "%'.$_POST['search'].'%"';
                d()->banks_list = d()->Databank->where($search_string);*/
            }
            $filter = d()->Filter();
            if(!$filter->is_empty){
                foreach ($filter as $key_f=>$value_f){
                    if($_POST[$value_f->title]){
                        d()->banks_list = d()->banks_list->search('id', 'mapdx', 'description', 'pol', 'dvmr', 'education', 'profession', 'marriage', 'children', 'parents', 'relatives', 'friends', 'moving', 'finance', 'health', 'spirituality', 'peculiarities', 'related_cards', $_POST[$value_f->title]);
                    }
                }
            }
        }

        d()->QUERY_STRING = $_SERVER['QUERY_STRING'];
        d()->QS_NOT_PAGE = '';
        foreach($_GET as $k=>$v){
            if($k=='page')continue;

            if(d()->QS_NOT_PAGE)d()->QS_NOT_PAGE .= '&';
            d()->QS_NOT_PAGE .= $k.'='.$v;
        }
        if($_GET['action']=='logout'){
            d()->Auth->logout();
            header('Location: /databank/');
            exit;
        }

        d()->banks_list->paginate(15)->order_by('id ASC');
        d()->paginator = d()->Paginator->custom_template("/app/mod_tpl/paginator.html")->generate(d()->banks_list);
    }

    function show()
    {
        if($_SESSION['auth'] || $_SESSION['admin']){
            d()->this = d()->Databank($_POST['id'])->fast_all_of($_POST['str']);
        }else{
            return 'auth';
        }
    }

    function instrukciyu(){
        if(substr(url(), -6)!='/index'){
            header("HTTP/1.1 301 Moved Permanently");
            header('Location: /'.url().'/');
            exit;
        }
        if(url(1)!='instrukciyu' || url(2)!='index'){
            d()->page_not_found();
        }

        d()->this = d()->Page->where('url = "instrukciyu/"');
        $_SESSION['dbg1'] = d()->this->id;
    }

    function show_blocks(){
        if($_SESSION['auth'] || $_SESSION['admin']){
            d()->databanks = d()->Databank($_POST['id'])->to_array();
            $str = d()->databanks[0][$_POST['str']];
            return $str;
        }else{
            return 'auth';
        }
    }
}