<?php

//
//  Created by Mauricio Ampuero <mdampuero@gmail.com>.
//  Copyright. All rights reserved.
//

namespace App\BackOfficeBundle\Controller;

use App\BackEndBundle\Entity\Article;
use App\BackEndBundle\Form\Article\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticlesController extends Controller
{

    public function indexAction()
    {
        return $this->render(
            'AppBackOfficeBundle:Articles:index.html.twig',
            array(
                'formDelete' => $this->createFormBuilder()
                    ->setAction($this->generateUrl('api_articles_delete', array('id' => ':ENTITY_ID')))
                    ->setMethod('DELETE')
                    ->getForm()->createView(),
            )
        );
    }

    public function addAction()
    {
        return $this->render('AppBackOfficeBundle:Articles:form.html.twig', array('entity' => new Article()));
    }

    public function editAction($id)
    {
        return $this->render('AppBackOfficeBundle:Articles:form.html.twig', array('entity' => $this->getDoctrine()->getRepository(Article::class)->find($id)));
    }

    public function landingAction($id)
    {
        return $this->render('AppBackOfficeBundle:Articles:landing.html.twig', array('id' => $id));
    }

    public function getAction($id)
    {
        return $this->render('AppBackOfficeBundle:Articles:_partials/get.html.twig', array('entity' => $this->getDoctrine()->getRepository(Article::class)->find($id)));
    }

    public function form($entity)
    {
        $method = 'POST';
        $action = $this->generateUrl('api_articles_post');
        if ($entity->getId()) {
            $method = 'PUT';
            $action = $this->generateUrl('api_articles_put', array('id' => $entity->getId()));
        }
        return $this->render(
            'AppBackOfficeBundle:Articles:_partials/form.html.twig',
            array(
                'entity' => $entity,
                'form' => $this->createForm(
                    ArticleType::class,
                    $entity,
                    array(
                        'method' => $method,
                        'action' => $action
                    )
                )->createView()
            )
        );
    }
}
