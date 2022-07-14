<?php

function main()
{

	if(substr($_SERVER['REQUEST_URI'],-5)=='index' && !$_GET){
		header("HTTP/1.1 301 Moved Permanently");
		header('Location: '.substr($_SERVER['REQUEST_URI'],0,-5));
		exit;
	}
	if($_SESSION['admin'] != 'developer'){
        header("HTTP/1.1 301 Moved Permanently");
        header('Location: /databank/');
        exit;
    }
    if(substr(url(), -6)!='/index'){
        header("HTTP/1.1 301 Moved Permanently");
        header('Location: /'.url().'/');
        exit;
    }

	if(url(1)=='index') d()->main = 1;
	d()->content = d()->content();
	print d()->render('main_tpl');
}

function get_session(){
    if($_SESSION['admin']) {
        if($_GET['action']=='clear'){
            foreach($_SESSION as $k=>$v){
                if($k=='admin' || $k=='auth')continue;
                unset($_SESSION[$k]);
            }
            setcookie("wide_single_promo", '', time()-3600, '/');
            header('Location: /get/session');
            exit;
        }

        print '<pre>';
        print_r($_SESSION);
        print '</pre>';
        print '<a href="?action=clear">Очистить</a><br>';
        print '<hr>';
        print '<pre>';
        print_r($_COOKIE);
        print '</pre>';
        exit;
    }
    d()->page_not_found();
}

function get_server(){
    if($_SESSION['admin']) {
        print '<pre>';
        print_r($_SERVER);
        print '</pre>';
        exit;
    }
    d()->page_not_found();
}

function page_not_found()
{
    ob_end_clean();
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    header('Status: 404 Not Found');
    d()->content = d()->error_404_tpl();
    print d()->main_tpl();
    exit;
}

function ajax_size_width(){
    $_POST = json_decode(file_get_contents('php://input'), true);
    if($_POST['size']){
        $_SESSION['size'] = $_POST['size'];
    }
}

function authentication(){
    if(!$_POST['email'] || !$_POST['pass']){
        return 'error';
    }

    $u = d()->User->where('email=?', $_POST['email'])->limit(0,1);
    if(count($u)){
        $pass = md5($_POST['pass']);
        if($pass == $u->password){
            d()->Auth->login($u->id);

            /*$u->last_login = date('Y-m-d H:i:s');
            $u->save();*/
            return 'success';
        }
    }
    return 'error';
}

function ajax_check_url_genereator(){
    if($_POST['url'] && $_POST['table'] && $_POST['id']){
        $url = $_POST['url'];
        $temp_url = '';
        $w = '';
        if($_POST['id']!='add')$w = ' AND id != '.$_POST['id'];
        $c = d()->Model->sql('SELECT * FROM '.$_POST['table'].' WHERE url = "'.$url.'"'.$w);

        $i = 1;
        while(!$c->is_empty()){
            $temp_url = '-'.$i;
            $c = d()->Model->sql('SELECT * FROM '.$_POST['table'].' WHERE url = "'.$url.$temp_url.'"');
            $i++;
        }

        print $url.$temp_url;
        exit;
    }
    d()->page_not_found();
}

