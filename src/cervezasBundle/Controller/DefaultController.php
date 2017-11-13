<?php

namespace cervezasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use cervezasBundle\Entity\Cervezas;
use cervezasBundle\Form\CervezasType;
use Symfony\Component\HttpFoundation\Request;

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

    public function insertarAction($nombre, $pais, $poblacion)
    {
        $em = $this->getDoctrine()->getManager();

        //Creamos un objecto cerveza y le pasamos los parametros
        $cerveza = new Cervezas();
        $cerveza->setNombre($nombre);
        $cerveza->setPais($pais);
        $cerveza->setPoblacion($poblacion);
        $cerveza->setTipo("Tostada");
        $cerveza->setImportacion(true);
        $cerveza->setTamano(250);
        $cerveza->setFechaAlmacen(new \DateTime("03-11-2017"));
        $cerveza->setCantidad(25);
        $cerveza->setFoto("");

        //Insertamos el objeto cerveza
        $em->persist($cerveza);
        $em->flush();

      //Redireccionamos a la pagina que muestra el detalle de la cerveza segun el id
      return $this->redirect($this->generateUrl('cervezas_detalle', array('idCerveza' => $cerveza->getId())));
    }

    public function nuevaCervezaAction(Request $request)
    {
      $cerveza = new Cervezas();
      $form = $this->createForm(CervezasType::class);

      $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

        $cerveza = $form->getData();

        $em = $this->getDoctrine()->getManager();
        $em->persist($cerveza);
        $em->flush();

        return $this->redirect($this->generateUrl('cervezas_detalle', array('idCerveza' => $cerveza->getId())));

    }

      return $this->render('cervezasBundle:Default:nuevaCerveza.html.twig',array('form'=> $form->createView()));
}

public function actualizarCervezaAction(Request $request, $idCerveza)
{
  $em = $this->getDoctrine()->getManager();
  $cerveza = $em->getRepository(Cervezas::Class)->find($idCerveza);
  $form = $this->createForm(CervezasType::class, $cerveza);

  $form->handleRequest($request);
if ($form->isSubmitted() && $form->isValid()) {

    $cerveza = $form->getData();
    $em->persist($cerveza);
    $em->flush();
    return $this->redirect($this->generateUrl('cervezas_detalle', array('idCerveza' => $cerveza->getId())));
}

  return $this->render('cervezasBundle:Default:actualizarCerveza.html.twig',array('form'=> $form->createView()));
}

}
