<?php
/**
 * Post fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Persistence\ObjectManager;

/**
 * Class TaskFixtures.
 */
class PostFixtures extends AbstractBaseFixtures
{
    /**
     * Load data.
     *
     * @param ObjectManager $manager Persistence object manager
     */
    public function loadData(): void
    {
        for ($i = 0; $i < 10; ++$i) {
            $post = new Post();
            $post->setTitle($this->faker->sentence);
            $post->setContents($this->faker->text);
            $post->setCreatedAt($this->faker->dateTimeBetween('-100 days', '-1 days'));
            $this->manager->persist($post);
        }

        $this->manager->flush();
    }
}
