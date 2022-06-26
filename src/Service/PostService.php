<?php
/**
 * Post service.
 */

namespace App\Service;

use App\Entity\Post;
use App\Repository\PostRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\ORM\NonUniqueResultException;

/**
 * Class PostService.
 */
class PostService implements PostServiceInterface
{
    /**
     * Post repository.
     */
    private PostRepository $postRepository;

    /**
     * Category service.
     */
    private CategoryServiceInterface $categoryService;

    /**
     * Paginator.
     */
    private PaginatorInterface $paginator;

    /**
     * Constructor.
     *
     * @param PostRepository           $postRepository
     * @param PaginatorInterface       $paginator
     * @param CategoryServiceInterface $categoryService
     */
    public function __construct(PostRepository $postRepository, PaginatorInterface $paginator, CategoryServiceInterface $categoryService)
    {
        $this->postRepository = $postRepository;
        $this->paginator = $paginator;
        $this->categoryService = $categoryService;
    }

    /**
     * Get paginated list.
     *
     * @param int   $page
     * @param array $filters
     *
     * @return PaginationInterface
     *
     * @throws NonUniqueResultException
     */
    public function getPaginatedList(int $page, array $filters = []): PaginationInterface
    {
        $filters = $this->prepareFilters($filters);

        return $this->paginator->paginate(
            $this->postRepository->queryAll($filters),
            $page,
            PostRepository::PAGINATOR_ITEMS_PER_PAGE
        );
    }

    /**
     * Save entity.
     *
     * @param Post $post
     *
     * @return void
     */
    public function save(Post $post): void
    {
        if (null == $post->getId()) {
            $post->setCreatedAt(new \DateTimeImmutable());
        }

        $this->postRepository->save($post);
    }

    /**
     * Delete entity.
     *
     * @param Post $post
     *
     * @return void
     */
    public function delete(Post $post): void
    {
        $this->postRepository->delete($post);
    }

    /**
     * Prepare filters for the posts list.
     *
     * @param array $filters
     *
     * @return array
     *
     * @throws NonUniqueResultException
     */
    private function prepareFilters(array $filters): array
    {
        $resultFilters = [];
        if (!empty($filters['category_id'])) {
            $category = $this->categoryService->findOneById($filters['category_id']);
            if (null !== $category) {
                $resultFilters['category'] = $category;
            }
        }

        return $resultFilters;
    }
}
