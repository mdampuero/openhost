<?php

//
//  Created by Mauricio Ampuero <mdampuero@gmail.com>.
//  Copyright. All rights reserved.
//

namespace App\ApiBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\BackEndBundle\Entity\Article;
use App\BackEndBundle\Form\Article\ArticleType;
use FOS\RestBundle\Controller\FOSRestController;

class ArticlesController extends FOSRestController
{

    public function indexAction(Request $request)
    {
        $offset = $request->query->get('start', 0);
        $query = $request->query->get('query');
        $limit = $request->query->get('length', 30);
        $sort = $request->query->get('sort', null);
        $direction = $request->query->get('direction', null);
        return $this->handleView($this->view(
            array(
                'data' => $this->getDoctrine()->getRepository(Article::class)->search($query, $limit, $offset, $sort, $direction, [])->getQuery()->getResult(),
                'recordsTotal' => $this->getDoctrine()->getRepository(Article::class)->total(),
                'recordsFiltered' => $this->getDoctrine()->getRepository(Article::class)->searchTotal($query, $limit, $offset, null, null, []),
                'offset' => $offset,
                'limit' => $limit,
            )
        )
        );
    }

    public function getAction($id)
    {
        if (!$entity = $this->getDoctrine()->getRepository(Article::class)->find($id))
            return $this->handleView($this->view(null, Response::HTTP_NOT_FOUND));
        return $this->handleView($this->view($entity));
    }

    public function postAction(Request $request)
    {
        $entity = new Article();
        $form = $this->createForm(ArticleType::class, $entity);
        $form->submit(json_decode($request->getContent(), true));
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            return $this->handleView($this->view($entity, Response::HTTP_OK));
        }
        return $this->handleView($this->view($form->getErrors(), Response::HTTP_BAD_REQUEST));
    }

    public function putAction(Request $request, $id)
    {
        if (!$entity = $this->getDoctrine()->getRepository(Article::class)->find($id))
            return $this->handleView($this->view(null, Response::HTTP_NOT_FOUND));
        $form = $this->createForm(ArticleType::class, $entity);
        $form->submit(json_decode($request->getContent(), true));
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            return $this->handleView($this->view($entity, Response::HTTP_OK));
        }
        return $this->handleView($this->view($form->getErrors(), Response::HTTP_BAD_REQUEST));
    }

    public function deleteAction(Request $request, $id)
    {
        if (!$entity = $this->getDoctrine()->getRepository(Article::class)->find($id))
            return $this->handleView($this->view(null, Response::HTTP_NOT_FOUND));
        $form = $this->createFormBuilder(null, array('csrf_protection' => false))->setMethod('DELETE')->getForm();
        $form->submit(json_decode($request->getContent(), true));
        if ($form->isSubmitted() && $form->isValid()) {
            $entity->setIsDelete(true);
            $this->getDoctrine()->getManager()->flush();
            return $this->handleView($this->view($entity, Response::HTTP_OK));
        }
        return $this->handleView($this->view($form->getErrors(), Response::HTTP_BAD_REQUEST));
    }

}