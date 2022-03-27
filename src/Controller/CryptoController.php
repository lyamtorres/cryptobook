<?php

namespace App\Controller;

use App\Entity\Crypto;
use App\Form\CryptoType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;


class CryptoController extends AbstractController
{
    /**
     * @[Route('/')]
     */
    public function indexNoLocale(): Response
    {
        return $this->redirectToRoute('app_crypto', ['_locale' => 'fr']);
    }

    /**
     * @Route(
     *     "/{_locale}",
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
     *     "/{_locale}/user/{nom}",
     *     name="crypto_info",
     *     requirements={
     *         "_locale": "en|es|fr",
     *     }
     * )
     */
    public function cryptoShow(Crypto $crypto): Response
    {
        return $this->render('crypto/details_show.html.twig', [
            'crypto' => $crypto
        ]);
    }

    /**
     * @Route("/my_cryptos", name="app_my_crypto")
     */
    public function myCryptosShow(): Response
    {
        $cryptos = $this->getDoctrine()
            ->getRepository(Crypto::class)
            ->findBy(array('createur' => $this->getUser()));

        return $this->render('crypto/my_cryptos.html.twig', [
            'cryptos' => $cryptos,
        ]);
    }

    /**
     * Créer une nouvelle crypto
     * @isGranted("ROLE_USER")
     * @Route("/new", name="new_crypto")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */
    public function create(Request $request, EntityManagerInterface $em) : Response
    {
        $user = $this->getUser();

        $crypto = new Crypto();
        $crypto->setCreateur($user);

        $form = $this->createForm(CryptoType::class, $crypto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($crypto);
            $em->flush();
            return $this->redirectToRoute('app_crypto');
        }
        return $this->render('crypto/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
