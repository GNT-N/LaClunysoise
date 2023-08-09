<?php

namespace App\Repository;

use App\Entity\Admin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<Admin>
 *
 * @method Admin|null find($id, $lockMode = null, $lockVersion = null)
 * @method Admin|null findOneBy(array $criteria, array $orderBy = null)
 * @method Admin[]    findAll()
 * @method Admin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 *
 * Cette classe est le dépôt pour l'entité Admin. Elle étend ServiceEntityRepository et implémente PasswordUpgraderInterface.
 */
class AdminRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    /**
     * Constructeur de la classe AdminRepository.
     *
     * @param ManagerRegistry $registry Le registre des gestionnaires.
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Admin::class);
    }

    /**
     * Enregistre une entité Admin dans la base de données.
     *
     * @param Admin $entity L'entité à enregistrer.
     * @param bool $flush Si vrai, flush les changements dans la base de données.
     */
    public function save(Admin $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Supprime une entité Admin de la base de données.
     *
     * @param Admin $entity L'entité à supprimer.
     * @param bool $flush Si vrai, flush les changements dans la base de données.
     */
    public function remove(Admin $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Utilisé pour mettre à jour (rehash) le mot de passe de l'utilisateur automatiquement avec le temps.
     *
     * @param PasswordAuthenticatedUserInterface $user L'utilisateur dont le mot de passe doit être mis à jour.
     * @param string $newHashedPassword Le nouveau mot de passe haché.
     *
     * @throws UnsupportedUserException Si l'utilisateur n'est pas une instance de Admin.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof Admin) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $user->setPassword($newHashedPassword);

        $this->save($user, true);
    }
}