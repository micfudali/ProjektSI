<?php
/**
 * Comment controller.
 */

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use App\Repository\CommentRepository;
use App\Form\Type\CommentType;
use App\Service\CommentServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class CommentController.
 */
#[Route('{post_id}/comment')]
class CommentController extends AbstractController
{
    /**
     * Comment repository.
     *
     */
    private CommentRepository $commentRepository;

    /**
     * Comment service.
     *
     */
    private CommentServiceInterface $commentService;

    /**
     * Translator.
     */
    private TranslatorInterface $translator;

    /**
     * Constructor.
     *
     * @param CommentRepository     $commentRepository Comment repository
     */
    public function __construct(CommentRepository $commentRepository, CommentServiceInterface $commentService, TranslatorInterface $translator)
    {
        $this->commentRepository = $commentRepository;
        $this->commentService = $commentService;
        $this->translator = $translator;
    }
    /**
     * Create action.
     *
     * @param Request $request HTTP request
     *
     * @return Response HTTP response
     */
    #[Route(
        '/create',
        name: 'comment_create',
        methods: 'GET|POST',
    )]
    public function create(Request $request, Post $post): Response
    {
        $comment = new Comment();
        $comment->setPost($post);
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->commentService->save($comment);

            return $this->redirectToRoute('post_index');
        }

        return $this->render(
            'comment/create.html.twig',
            ['form' => $form->createView()]
        );
    }

}
