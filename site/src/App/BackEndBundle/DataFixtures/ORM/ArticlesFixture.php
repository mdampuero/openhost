<?php

//
//  Created by Mauricio Ampuero <mdampuero@gmail.com>.
//  Copyright. All rights reserved.
//

namespace App\BackEndBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use App\BackEndBundle\Entity\Article;

class ArticlesFixture extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{

    private $container;
    private $dataDummy=[
        [
            "title" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
            "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nulla sem, tempus quis consectetur ut, feugiat quis purus. In vehicula tincidunt justo sit amet varius. Nunc feugiat tempor arcu, ut dapibus dolor. Proin eleifend tortor id ipsum tristique auctor. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.",
            "body" => "Proin eleifend tortor id ipsum tristique auctor. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin suscipit imperdiet risus. Maecenas sollicitudin, eros in elementum malesuada, nisl massa hendrerit justo, in pharetra odio risus id tellus.",
            "picture" => "https://images.unsplash.com/photo-1457369804613-52c61a468e7d?q=80&w=1740&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
        ],
        [
            "title" => "Vivamus tincidunt lorem ac ligula auctor bibendum.",
            "description" => "Aenean porttitor metus ac commodo ornare. Etiam at ipsum eget tortor commodo volutpat. ",
            "body" => "Vivamus sagittis ipsum ac sollicitudin eleifend. Donec sagittis tortor mi, nec tempor dolor congue feugiat. Pellentesque sodales, lacus quis venenatis placerat, orci lectus pharetra libero, ac tempus est dui ut nisi. Sed congue, urna ac rutrum commodo, massa lacus dapibus sapien, non ultricies arcu nisl et ex.

Morbi id lacus tempus, semper est vitae, ornare elit. Vivamus congue libero lectus, sed interdum lacus volutpat tincidunt. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam mattis egestas justo sit amet finibus. Fusce in magna id justo volutpat condimentum. Duis maximus lectus accumsan tortor scelerisque, eu viverra nibh posuere. Aliquam laoreet ligula a ante efficitur auctor. Curabitur vitae nisi vitae nulla pharetra accumsan posuere at tortor. Sed eu eros augue. Proin blandit posuere urna, eget tempus mauris. Etiam nec suscipit ipsum. Cras vel nunc ac sapien varius viverra. Sed diam ipsum, viverra sit amet vehicula sed, efficitur vitae est.",
            "picture" => "https://images.unsplash.com/photo-1481349518771-20055b2a7b24?q=80&w=2139&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
        ],
        [
            "title" => "Ut sed nunc condimentum, eleifend sapien sodales.",
            "description" => "Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In id pharetra dolor. ",
            "body" => "Vivamus pharetra lectus non diam molestie, a bibendum diam maximus. Ut mattis orci ligula, et pulvinar enim tincidunt a. Suspendisse potenti. Donec vel massa et erat euismod laoreet.

Nunc sed ullamcorper turpis. Aliquam vel hendrerit felis. Sed eleifend mauris in mi pulvinar, ut tincidunt urna semper. Vivamus faucibus rutrum eros, eu eleifend metus posuere vitae. Phasellus in odio nunc. Sed eget enim a orci volutpat ornare. Mauris laoreet finibus ornare.",
            "picture" => "https://images.unsplash.com/photo-1458682625221-3a45f8a844c7?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
        ]
    ];

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        foreach($this->dataDummy as $data){
            $entity = new Article();
            $entity->setTitle($data["title"]);
            $entity->setDescription($data["description"]);
            $entity->setBody($data["body"]);
            $entity->setPicture($data["picture"]);
            $manager->persist($entity);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
