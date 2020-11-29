<?php

namespace App\Controller;

use App\Entity\Auction;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuctionController extends AbstractController
{

    public function index(): Response
    {
        // prueba de entidades
        $em = $this->getDoctrine()->getManager();
        $auction_repo = $this->getDoctrine()->getRepository(Auction::class);
        $auctions = $auction_repo->findAll();

        foreach ($auctions as $auction){
            echo $auction->getUser()->getEmail().':'.$auction->getTitle();
        }

        return $this->render('auction/register.html.twig', [
            'controller_name' => 'AuctionController',
        ]);
    }
}
