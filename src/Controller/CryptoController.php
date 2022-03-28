<?php

namespace App\Controller;

use App\Entity\Crypto;
use App\Entity\Comment;
use App\Form\CryptoType;
use App\Form\CommentFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;


class CryptoController extends AbstractController
{
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

    /**
     * @Route("/comment/{cryptoName}/new", methods={"POST"}, name="comment_new")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     * @ParamConverter("name", options={"mapping": {"cryptoName": "name"}})
     *
     * NOTE: The ParamConverter mapping is required because the route parameter
     * (postSlug) doesn't match any of the Doctrine entity properties (slug).
     * See https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/converters.html#doctrine-converter
     */
    public function commentNew(Request $request, Crypto $crypto, EventDispatcherInterface $eventDispatcher): Response
    {
        $comment = new Comment();
        $comment->setAuthor($this->getUser());
        $crypto->addComment($comment);

        $form = $this->createForm(CommentFormType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            // When an event is dispatched, Symfony notifies it to all the listeners
            // and subscribers registered to it. Listeners can modify the information
            // passed in the event and they can even modify the execution flow, so
            // there's no guarantee that the rest of this controller will be executed.
            // See https://symfony.com/doc/current/components/event_dispatcher.html
            $eventDispatcher->dispatch(new CommentCreatedEvent($comment));

            return $this->redirectToRoute('crypto_info', ['name' => $crypto->getNom()]);
        }

        return $this->render('blog/comment_form_error.html.twig', [
            'crypto' => $crypto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * This controller is called directly via the render() function in the
     * blog/post_show.html.twig template. That's why it's not needed to define
     * a route name for it.
     *
     * The "id" of the Post is passed in and then turned into a Post object
     * automatically by the ParamConverter.
     */
    public function commentForm(Crypto $crypto): Response
    {
        $form = $this->createForm(CommentFormType::class);

        return $this->render('crypto/_comment_form.html.twig', [
            'crypto' => $crypto,
            'form' => $form->createView(),
        ]);
    }

}
