<?php
/*
	Модуль для работы с текстовыми страницами, для вывода меню, выода подстраниц
*/
class PagesController
{
	function show()
	{
		$url = url();
		d()->this = d()->Page->find_by_url($url);
		if (d()->this->is_empty) {
			d()->message="Страница не существует".d()->add(array('pages','url'=>$url));
			return d()->error('404');
		}

	}

	function main_pages()
    {
        d()->main_blocks = d()->Main_block;
        d()->school = d()->School;
        d()->teacher_list = d()->Teacher;
        d()->graduates_list = d()->Graduate;
        d()->facts_list = d()->Countfact;
    }
}

