<?php

namespace cervezasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('cervezasBundle:Default:index.html.twig');
    }

    public function detalleAction($idCerveza)
    {
      //Repositorio de la entidad
        $repository = $this->getDoctrine()->getRepository('cervezasBundle:Cervezas');
        $cerveza = $repository->find($idCerveza);
        return $this->render('cervezasBundle:Default:detalle.html.twig',array('cerveza'=>$cerveza));
    }
}
