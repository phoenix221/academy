<?php
//Автоматически регистрировать все контроллеры
route_all();

route('/error_404', 'error_404');
route('/', 'pages#');

route('/index', 'pages#main_pages');
route('/databank/index', 'main', 'databanks#index');
route('/instrukciyu/index', 'main','databanks#instrukciyu');

route('/get/session', 'main', 'get_session');
route('/get/server', 'main', 'get_server');

route('/ajax/size_width', 'main','ajax_size_width');
route('/ajax/get_cart', 'main','databanks#show');
route('/ajax/authentication', 'main','authentication');
route('/ajax/check_url_genereator', 'main','ajax_check_url_genereator');


//route('/news/index', 'content', 'news#index');
//route('/news/index', 'news#index');
//зарегистрировать контроллер newscontroller по адресу /news/
//route('news');
//зарегистрировать контроллер newscontroller по адресу /press/
//route('/press/','news#');


