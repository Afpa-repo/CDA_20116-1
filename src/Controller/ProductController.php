<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\Product;
use App\Form\SearchType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function index(Request $request): Response
    {
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $products = $this->entityManager->getRepository(Product::class)->findWithSearch($search);
            // Permet de récupérer tous les objets produits dans un tableau filtrer via la méthode findWithSearch définie à la mano dans le Repository Product
        }
        else
        {
            $products = $this->entityManager->getRepository(Product::class)->findAll(); // Permet de récupérer tous les objets produits dans un tableau
        }

        return $this->render('product/index.html.twig', [
            'products' => $products,
            'form' => $form->createView()
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
