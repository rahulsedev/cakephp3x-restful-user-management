<?php
use Cake\Core\Configure;
use Cake\Routing\Router;
$cntxtPrfx = !empty($_SERVER['CONTEXT_PREFIX']) ? $_SERVER['CONTEXT_PREFIX'] : ''; 
define('SWAGGER_API_PATH', Router::url('/', true));
$appFolder = str_replace([$_SERVER['DOCUMENT_ROOT'], 'webroot'], ['', ''], getcwd());
if (!empty($appFolder) && $appFolder != '/') {
    $cntxtPrfx = $cntxtPrfx . $appFolder;
}
define('SWAGGER_BASE_PATH', $cntxtPrfx . 'api/');
return [
    'Swagger' => [
        'ui' => [
            'title' => 'Navitas User Management APIs',
            'validator' => true,
            'api_selector' => true,
            'route' => '/api-spec/',
            'schemes' => ['http', 'https']
        ],
        'docs' => [
            'crawl' => Configure::read('debug'),
            'route' => '/swagger/docs/',
            'cors' => [
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET, POST',
                'Access-Control-Allow-Headers' => 'X-Requested-With'
            ]
        ],
        'library' => [
            'api' => [
                'include' => ROOT . DS . 'src' . DS . 'Controller' . DS . 'UserController.php',
                'exclude' => [
                    '/Editor/'
                ]
            ],
            'editor' => [
                'include' => [
                    ROOT . DS . 'src' . DS . 'Controller' . DS . 'AppController.php',
                    ROOT . DS . 'src' . DS . 'Controller' . DS . 'Editor',
                    ROOT . DS . 'src' . DS . 'Model'
                ]
            ]
        ]
    ]
];