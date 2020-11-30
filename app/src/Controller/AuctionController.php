<?php

namespace App\Controller;

use App\Entity\Auction;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\AuctionType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface as UserInterface;

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

    public function detail(Auction $auction)
    {
        if(!$auction){
            return $this->redirectToRoute('auctions');
        }

        return $this->render('auction/detail.html.twig', [
            'auction' => $auction
        ]);
    }

    public function create(Request $request, UserInterface $user)
    {
        $auction = new Auction();
        $form = $this->createForm(AuctionType::class, $auction);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $auction->setCreatedAt(new \Datetime('now'));
            $auction->setUpdatedAt(new \Datetime('now'));
            $auction->setUser($user);

            $em = $this->getDoctrine()->getManager();
            $em->persist($auction);
            $em->flush();

            return $this->redirect($this->generateUrl('auction_detail', ['id' => $auction->getId()]));

        }

        return $this->render('auction/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function edit(Request $request, UserInterface $user, Auction $auction)
    {
        if(!$user || $user->getId() != $auction->getUser()->getId()){
            return $this->redirectToRoute('auctions');
        }

        $form = $this->createForm(AuctionType::class, $auction);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $auction->setCreatedAt(new \Datetime('now'));
            $auction->setUpdatedAt(new \Datetime('now'));
            $auction->setUser($user);

            $em = $this->getDoctrine()->getManager();
            $em->persist($auction);
            $em->flush();

            return $this->redirect($this->generateUrl('auction_detail', ['id' => $auction->getId()]));

        }

        return $this->render('auction/create.html.twig', [
            'edit' => true,
            'form' => $form->createView()
        ]);
    }

    public function delete(UserInterface $user, Auction $auction)
    {
        if(!$user || $user->getId() != $auction->getUser()->getId()){
            return $this->redirectToRoute('auctions');
        }

        if(!$auction){
            return $this->redirectToRoute('auctions');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($auction);
        $em->flush();

        return $this->redirectToRoute('auctions');
    }
}
