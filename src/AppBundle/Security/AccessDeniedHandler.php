<?php
/**
 * Created by IntelliJ IDEA.
 * User: Raimondas
 * Date: 6/27/2017
 * Time: 1:53 AM
 */

namespace AppBundle\Security;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;

class AccessDeniedHandler implements AccessDeniedHandlerInterface
{
    /**
     * Handles an access denied failure.
     *
     * @param Request $request
     * @param AccessDeniedException $accessDeniedException
     *
     * @return Response may return null
     */
    public function handle(Request $request, AccessDeniedException $accessDeniedException)
    {
        $content = '<h1>We are very very sorry :( Accsess denied. Please return <a href="/">HOME</a></h1>';
        return new Response($content, 403);
    }

}