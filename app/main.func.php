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

