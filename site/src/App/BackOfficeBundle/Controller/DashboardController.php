<?php

//
//  Created by Mauricio Ampuero <mdampuero@gmail.com>.
//  Copyright. All rights reserved.
//

namespace App\BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\BackEndBundle\Entity\Article;

class DashboardController extends Controller
{
    public function indexAction()
    {
        return $this->render('AppBackOfficeBundle:Dashboard:index.html.twig',
            [
                'byDay' => [ 
                    "title" => 'DAY',
                    "data" => $this->getDoctrine()->getRepository(Article::class)->getTotalByDay(),
                ]
            ]
        );
    }

}
