<?php

namespace GuitarFeelingBundle\EventListener;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LoginHandler implements AuthenticationSuccessHandlerInterface
{
   public function onAuthenticationSuccess(Request $request, TokenInterface $token)
   {
      $referer = $request->headers->get('referer');
      return new RedirectResponse($referer);
   }
}
