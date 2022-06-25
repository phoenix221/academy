<?php
//Автоматически регистрировать все контроллеры
route_all();

route('/error_404', 'error_404');
route('/', 'pages#main_pages');
route('/databank/index', 'main', 'databanks#index');

route('/get/session', 'main', 'get_session');
route('/get/server', 'main', 'get_server');

route('/ajax/size_width', 'main','ajax_size_width');
route('/ajax/get_cart', 'main','databanks#show');


//route('/news/index', 'content', 'news#index');
//route('/news/index', 'news#index');
//зарегистрировать контроллер newscontroller по адресу /news/
//route('news');
//зарегистрировать контроллер newscontroller по адресу /press/
//route('/press/','news#');


