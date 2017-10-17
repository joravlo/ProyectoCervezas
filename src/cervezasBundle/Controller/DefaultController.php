<?php

namespace cervezasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('cervezasBundle:Default:index.html.twig');
    }

    public function detalleAction()
    {
        return $this->render('cervezasBundle:Default:detalle.html.twig');
    }
}
