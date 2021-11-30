<?php

namespace App\Controllers;

use App\Request;
use App\Response\LayoutResponse;
use App\Response\RedirectResponse;
use App\Response\Response;
use App\Router;
use App\ServiceContainer;
use App\Session\Session;

class DoLoginController implements ControllerInterface
{
    /**
     * @var Session
     */
    private Session $session;

    /**
     * @var Router
     */
    private Router $router;

    /**
     * @param Session $session
     * @param Router $router
     */
    public function __construct(Session $session, Router $router)
    {
        $this->session = $session;
        $this->router = $router;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $response = new RedirectResponse(
            $this->router->generate('home')
        );
        $username = "Arek";
        $password = "pass123";

        $isPost = $request->isPost();
        if (!$isPost) {
            return $response;
        }

        if ($request->getPost('login') != $username ||
            $request->getPost('password') != $password) {

            return $response;
        }

        $this->session->regenerate();
        $this->session->set('user', $request->getPost('login'));

        return $response;
    }
}