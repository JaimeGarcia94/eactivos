<?php

namespace App\Controller;

use App\Entity\Auction;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuctionController extends AbstractController
{

    public function index()
    {

        $em = $this->getDoctrine()->getManager();
        $auction_repo = $this->getDoctrine()->getRepository(Auction::class);
        $auctions = $auction_repo->findAll();

        foreach ($auctions as $image){
            $image_path = $image->getImagePath();
        }

        return $this->render('auction/index.html.twig', [
            'auctions' => $auctions,
            'image_path' => $image_path,
        ]);
    }
}
