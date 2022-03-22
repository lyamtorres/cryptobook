<?php

namespace App\Controller;

use App\Entity\Crypto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CryptoController extends AbstractController
{
    /**
     * @Route("/crypto", name="app_crypto")
     */
    public function index(): Response
    {
        $cryptos = $this->getDoctrine()
            ->getRepository(Crypto::class)
            ->findAll();

        return $this->render('crypto/index.html.twig', [
            'cryptos' => $cryptos,
        ]);
    }

    /**
     * @Route("/details/{nom}", methods={"GET"}, name="crypto_info")
     *
     * Affiche les détails d'une cryptomonnaie après avoir cliqué sur l'option 'voir plus'
     */
    public function cryptoShow(Crypto $crypto): Response
    {
        return $this->render('crypto/details_show.html.twig', [
            'crypto' => $crypto
        ]);
    }
}
