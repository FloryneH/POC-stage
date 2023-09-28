<?php

// src/Controller/OAuthController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;


class OAuthController extends AbstractController
{
    #[Route('/google/oauth/authorize', name: 'google_oauth_authorize')]
    public function authorize()
    {
        $clientId = $_ENV['GOOGLE_OAUTH_CLIENT_ID'];
        $redirectUri = $_ENV['GOOGLE_OAUTH_REDIRECT_URI'];
        $scope = 'https://www.googleapis.com/auth/calendar';

        $authUrl = "https://accounts.google.com/o/oauth2/auth?"
            . "client_id=$clientId&"
            . "redirect_uri=$redirectUri&"
            . "scope=$scope&"
            . "response_type=code";

        return $this->redirect($authUrl);
    }
}
