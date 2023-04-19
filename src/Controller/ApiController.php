<?php

namespace App\Controller;

use App\Entity\ShopItem;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * Display all shop items in JSON format
     * @param ManagerRegistry $managerRegistry The Doctrine manager registry
     * @return Response A JSON response
     */
    #[Route('/api/shop', name: 'app_api')]
    public function index(ManagerRegistry $managerRegistry): Response
    {

        // Get all shop items
        $shop = $managerRegistry->getRepository(ShopItem::class)->findAll();

        $data = [];

        // Loop through all shop items and add them to the data array
        foreach ($shop as $item) {
            $data[] = [
                'id' => $item->getId(),
                'reference' => $item->getReference(),
                'designation' => $item->getDesignation(),
                'description' => $item->getDescription(),
                'advantages' => $item->getAdvantages(),
                'price' => $item->getPrice(),
                'quantity' => $item->getQuantity(),
            ];
        }

        return $this->json($data);
    }
}
