<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

class AppController extends Controller
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');

        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'username',
                        'password' => 'password'
                    ]
                ]
            ],
            'loginAction' => [
                'controller' => 'Login',
                'action' => 'index'
            ],
            'loginRedirect' => [
                'controller' => 'Questions',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'Login',
                'action' => 'index'
            ],
            'unauthorizedRedirect' => [
                'controller' => 'Login',
                'action' => 'index'
            ],
            'authError' => 'ログインが必要です'
        ]);
        $this->Auth->allow(['display', 'index', 'view']);
    }
}
