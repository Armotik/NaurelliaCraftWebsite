<?php

namespace App\Controller;

use App\Entity\ShopItem;
use App\Repository\ShopItemRepository;
use http\Client\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IngameShopController extends AbstractController
{
    /**
     * Display the ingame shop
     * @return Response A response instance
     */
    #[Route('/ingame/shop', name: 'app_ingame_shop')]
    public function index(ShopItemRepository $shopItemRepository): Response
    {
        // If user is not logged in, redirect to login page
        if ($this->getUser() === null) {
            return $this->redirectToRoute('app_login');
        }

        // If user is logged in, display the shop
        return $this->render('ingame_shop/index.html.twig', [
            'shopItems' =>  $shopItemRepository->findAll(),
        ]);
    }

    /**
     * Display the ingame shop item
     * @param int $id The id of the shop item
     * @param ShopItem $shopItem The shop item
     * @return Response A response instance
     */
    #[Route('/ingame/shop/{id}', name: 'app_ingame_shop_item', requirements: ["id"=> "[1-9]\d*"])]
    public function item(int $id, ShopItem $shopItem): Response
    {

        // If user is not logged in, redirect to login page
        if ($this->getUser() === null) {
            return $this->redirectToRoute('app_login');
        }

        // If the shop item is invalid, redirect to the shop
        if ($shopItem->getId() !== $id || !$shopItem->isOnShop() || $shopItem->getPrice() === null || $shopItem->getPrice() <= 0 || $shopItem->getPrice() > 10000) {
            return $this->redirectToRoute('app_ingame_shop');
        }

        // If user is logged in, display the shop item
        return $this->render('ingame_shop/item.html.twig', [
            'shopItem' => $shopItem,
        ]);
    }

    /**
     * Buy the ingame shop item
     * @param int $id The id of the shop item
     * @param ShopItem $shopItem The shop item
     * @return Response A response instance
     */
    #[Route('/ingame/shop/{id}/buy', name: 'app_ingame_shop_item_buy', requirements: ["id"=> "[1-9]\d*"])]
    public function buy(int $id, ShopItem $shopItem): Response
    {

        // If user is not logged in, redirect to login page
        if ($this->getUser() === null) {
            return $this->redirectToRoute('app_login');
        }

        // If the shop item is invalid, redirect to the shop
        if ($shopItem->getId() !== $id || !$shopItem->isOnShop() || $shopItem->getPrice() === null || $shopItem->getPrice() <= 0 || $shopItem->getPrice() > 10000) {
            return $this->redirectToRoute('app_ingame_shop');
        }

        // If user is logged in, display the shop item
        return $this->render('ingame_shop/buy.html.twig', [
            'shopItem' => $shopItem,
        ]);
    }

}
