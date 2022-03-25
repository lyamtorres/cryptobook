<?php

namespace App\Controller;

use App\Entity\Crypto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CryptoController extends AbstractController
{
    /**
     * @Route(
     *     "/{_locale}/crypto",
     *     name="app_crypto",
     *     requirements={
     *         "_locale": "en|es|fr",
     *     }
     * )
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
     * @Route(
     *     "/{_locale}/details/{nom}",
     *     name="crypto_info",
     *     requirements={
     *         "_locale": "en|es|fr",
     *     }
     * )
     *
     * * Affiche les détails d'une cryptomonnaie après avoir cliqué sur l'option 'voir plus'
     */

    public function cryptoShow(Crypto $crypto): Response
    {
        return $this->render('crypto/details_show.html.twig', [
            'crypto' => $crypto
        ]);
    }
}
