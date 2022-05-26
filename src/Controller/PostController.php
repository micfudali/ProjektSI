<?php
/**
 * Post controller.
 */

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PostController.
 */
#[Route('/post')]
class PostController extends AbstractController
{
    /**
     * Index action.
     *
     * @param PostRepository $postRepository Post repository
     *
     * @return Response HTTP response
     */
    #[Route(
        name: 'post_index',
        methods: 'GET'
    )]
    public function index(PostRepository $postRepository): Response
    {
        $posts = $postRepository->findAll();

        return $this->render(
            'post/index.html.twig',
            ['posts' => $posts]
        );
    }

    /**
     * Show action.
     *
     * @param Post $post Post entity
     *
     * @return Response HTTP response
     */
    #[Route(
        '/{id}',
        name: 'post_show',
        requirements: ['id' => '[1-9]\d*'],
        methods: 'GET',
    )]
    public function show(Post $post): Response
    {
        return $this->render(
            'post/show.html.twig',
            ['post' => $post]
        );
    }
}
