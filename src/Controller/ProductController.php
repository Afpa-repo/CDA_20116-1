<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/nos-produits", name="products")
     */
    public function index(): Response
    {
        $products = $this->entityManager->getRepository(Product::class)->findAll(); // Permet de récupérer tous les objets produits dans un tableau

        return $this->render('product/index.html.twig', [
            'products' => $products
        ]);
    }

    // On indique ici que l'url contient le slug du produit en question
    /**
     * @Route("/produit/{slug}", name="product")
     */
    public function detail($slug): Response // Cette fonction a besoin du slug du produuit qui se trouve dans l'url, elle le 'sais' grace à {slug} ci dessus
    {
        $product = $this->entityManager->getRepository(Product::class)->findOneBySlug($slug); // On récupère le produit via son slug

        return $this->render('product/detail.html.twig', [
            'product' => $product
        ]);
    }
}
