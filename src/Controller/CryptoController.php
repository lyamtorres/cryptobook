<?php

namespace App\Controller;

use App\Entity\Crypto;
use App\Entity\Comment;
use App\Form\CryptoType;
use App\Form\CommentFormType;
use App\Form\SearchFormType;
use App\Events\CommentCreatedEvent;
use App\Repository\CryptoRepository;
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
    public function index(Request $request, CryptoRepository $cryptoRepository): Response
    {
        $cryptos = $this->getDoctrine()
            ->getRepository(Crypto::class)
            ->findAll();

        $form = $this->createForm(SearchFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $nom = $form["nom"]->getData();
            $symbole = $form["symbole"]->getData();
            $categorie = $form["categorie"]->getData();
            $createur = $form["createur"]->getData();

            $cryptos = $this->getDoctrine()
                ->getRepository(Crypto::class)
                ->findMultipleByFields($nom, $symbole, $categorie, $createur);
        }

        return $this->render('crypto/index.html.twig', [
            'cryptos' => $cryptos,
            'researchForm' => $form->createView()
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
     * @isGranted("ROLE_USER")
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
    public function createCrytpo(Request $request, EntityManagerInterface $em) : Response
    {
        $user = $this->getUser();

        $crypto = new Crypto();
        $crypto->setCreateur($user);

        $form = $this->createForm(CryptoType::class, $crypto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($crypto);
            $em->flush();
          
            return $this->redirectToRoute('app_my_crypto');
        }
        return $this->render('crypto/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/comment/{cryptoName}/new", methods={"POST"}, name="comment_new")
     * @ParamConverter("crypto", options={"mapping": {"cryptoName" : "nom"}})
     * @isGranted("ROLE_USER")
     */
    public function commentNew(Request $request, Crypto $crypto, EventDispatcherInterface $eventDispatcher): Response
    {
        $comment = new Comment();
        $comment->setAuthor($this->getUser());
        $comment->setCryptocurrency($crypto);
        $comment->setPublishedAt(new \DateTimeImmutable('now'));
        $crypto->addComment($comment);

        $form = $this->createForm(CommentFormType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            $eventDispatcher->dispatch(new CommentCreatedEvent($comment));

            return $this->redirectToRoute('crypto_info', ['nom' => $crypto->getNom()]);
        }

        return $this->render('blog/comment_form_error.html.twig', [
            'crypto' => $crypto,
        ]);
    }
     /**
     * @isGranted("ROLE_USER")
     * @Route("my_cryptos/{nom}/edit", name="edit_crypto")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */
    public function editCrypto(Request $request, Crypto $crypto, EntityManagerInterface $em) : Response
    {
        $date = new \DateTime();
        $crypto->setDateMaj($date);
        $form = $this->createForm(CryptoType::class, $crypto);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('app_my_crypto');
        }
        return $this->render('crypto/create.html.twig', [
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

    /**
     * This controller is called directly via the render() function in the
     * blog/post_show.html.twig template. That's why it's not needed to define
     * a route name for it.
     *
     * The "id" of the Post is passed in and then turned into a Post object
     * automatically by the ParamConverter.
     */
    public function myCommentForm(Crypto $crypto): Response
    {
        $form = $this->createForm(MyCommentFormType::class);

        $comments = $this->getDoctrine()
            ->getRepository(Comment::class)
            ->findBy(array('author' => $this->getUser()));

        return $this->render('crypto/details_show.html.twig', [
            'crypto' => $crypto,
            'formMyComments' => $form->createView(),
            'comments' => $comments
        ]);
    }

     /**
     * @isGranted("ROLE_USER")
     * @Route("stage/{nom}/delete", name="delete_crypto")
     * @param Request $request
     * @param Crypto $crypto
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function delete(Request $request, Crypto $crypto, EntityManagerInterface $em) : Response
    {
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('delete_crypto', ['nom' => $crypto->getNom()]))
            ->getForm();
        $form->handleRequest($request);
        if (!$form->isSubmitted() || ! $form->isValid()) {
            return $this->render('crypto/delete.html.twig', [
                'crypto' => $crypto,
                'form' => $form->createView(),
            ]);
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($crypto);
        $em->flush();
        return $this->redirectToRoute('app_my_crypto');
    }

}
