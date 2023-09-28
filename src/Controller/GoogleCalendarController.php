<?php

namespace App\Controller;

// src/Controller/GoogleCalendarController.php
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Google\Client as GoogleClient;
use Google\Service\Calendar;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class GoogleCalendarController extends AbstractController
{

    #[Route('/google-calendar', name: 'google_calendar')]
    public function callback(Request $request, SessionInterface $session)
    {
        // Récupérez le code d'autorisation depuis la requête
        $authorizationCode = $request->query->get('code');

        // Échangez le code d'autorisation contre un jeton d'accès
        $client = HttpClient::create();
        $response = $client->request('POST', 'https://oauth2.googleapis.com/token', [
            'body' => [
                'code' => $authorizationCode,
                'client_id' => $_ENV['GOOGLE_OAUTH_CLIENT_ID'],
                'client_secret' => $_ENV['GOOGLE_OAUTH_CLIENT_SECRET'],
                'redirect_uri' => $_ENV['GOOGLE_OAUTH_REDIRECT_URI'],
                'grant_type' => 'authorization_code',
            ],
        ]);

        $data = $response->toArray();
        $accessToken = $data['access_token'];

        $session->set('google_access_token', $accessToken);
        return $this->redirectToRoute('google_calendar_show');
    }

    #[Route('/google-calendar/show', name: 'google_calendar_show')]
    public function show(SessionInterface $session)
    {
        $accessToken = $session->get('google_access_token');

        $client = new GoogleClient();
        $client->setAuthConfig($_ENV['GOOGLE_OAUTH_CREDENTIALS_JSON']);
        $client->setAccessToken($accessToken);

        $service = new Calendar($client);

        $calendarId = 'primary';
        $events = $service->events->listEvents($calendarId);

        return $this->render('google_calendar/show.html.twig', [
            'events' => $events->getItems(),
            
        ]);
    }
}

