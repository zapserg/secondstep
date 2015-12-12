<?php

namespace Acme\SecondBazBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
    */
    public function showTovarAction()
        {
            $tovar=$this->getDoctrine()->getRepository('AcmeSecondBazBundle:Tovar')->findAll();
             
             if(!$tovar)
               {
               throw $this->createNotFoundException('No tovar found');
               }
         
            // Creating pagnination
            $paginator  = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                $tovar,
            $this->get('request')->query->get('page', 1),3);

            return $this->render('AcmeSecondBazBundle::index.html.twig', array('pagination' => $pagination)); 
        }

    /**
     * @Route("/kategor")
     * @Template()
    */

    public function showKategorAction()
        {
            $kategor=$this->getDoctrine()->getRepository('AcmeSecondBazBundle:Kategor')->findAll();
             
            if(!$kategor)
                {
                throw $this->createNotFoundException('No kategor found');
                }

            return $this->render('AcmeSecondBazBundle:category:name/categor.html.twig', array('articles' => $kategor));      
        }       

    /**
     * @Route("/tovar/{idtovar}")
     * @Template()
    */
     public function showProductAction($idtovar)
        {
            $category = $this->getDoctrine()
                ->getRepository('AcmeSecondBazBundle:Kategor')
                ->find($idtovar);

            $products = $category->getIdtovar();

             // Creating pagnination
            $paginator  = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                $products,
                $this->get('request')->query->get('page', 1),3);

            return $this->render('AcmeSecondBazBundle:item:name/product.html.twig', array('products' => $pagination));
        }

}
