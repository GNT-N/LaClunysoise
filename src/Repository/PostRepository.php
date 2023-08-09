<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Post>
 *
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 *
 * La classe PostRepository étend ServiceEntityRepository pour fournir des méthodes de récupération de données.
 */
class PostRepository extends ServiceEntityRepository
{
    /**
     * Constructeur de la classe PostRepository.
     *
     * @param ManagerRegistry $registry Le registre des gestionnaires.
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    /**
     * Enregistre une entité Post dans la base de données.
     *
     * @param Post $entity L'entité à enregistrer.
     * @param bool $flush Si vrai, flush les changements dans la base de données.
     */
    public function save(Post $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Supprime une entité Post de la base de données.
     *
     * @param Post $entity L'entité à supprimer.
     * @param bool $flush Si vrai, flush les changements dans la base de données.
     */
    public function remove(Post $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}