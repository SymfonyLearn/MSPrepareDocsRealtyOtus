<?php

namespace App\Controller;

use App\Entity\User;
use App\Model\Entity\Ad;
use App\Model\ValueObject\AdCategory;
use App\Model\ValueObject\Address;
use App\Model\ValueObject\Area;
use App\Model\ValueObject\DateCreated;
use App\Model\ValueObject\Description;
use App\Model\ValueObject\Floor;
use App\Model\ValueObject\Id;
use App\Model\ValueObject\Price;
use App\Model\ValueObject\Rooms;
use App\Model\ValueObject\SellerId;
use App\Repository\AdRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestVOController extends AbstractController
{
    /**
     * @Route("/test_vo", name="test_vo")
     */
    public function index(AdRepository $adRepository, UserRepository $userRepository): Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();


        $ad = $adRepository
            ->find(15);

        dump($ad);
        dump($ad->getAddress());
        //dd($ad->getAddress()->value());

        $user = $userRepository
            ->find(1);
        //dd($user);

        dump($user->getAds());

        //die();


        $ad = new Ad(
            new Id(1),
            new DateCreated(new \DateTimeImmutable()),
            new AdCategory('Квартира'),
            new Address('312'),
            new Description('dfghjkhgfhj'),
            new Price(123),
            new Rooms(3),
            new Area(2.4),
            new Floor(3),
            $user
        );

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($ad);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        /*

        $product = $productRepository
            ->find($id);

        */

        $ad = $adRepository
            ->find($ad->getId()->value());

        dump($ad);

        return new Response('Saved new product with id '.$ad->getId()->value());
    }
}
