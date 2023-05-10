<?php

    namespace App\Repository;

    use App\Entity\Wish;
    use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
    use Doctrine\ORM\Tools\Pagination\Paginator;
    use Doctrine\Persistence\ManagerRegistry;

    /**
     * @extends ServiceEntityRepository<Wish>
     *
     * @method Wish|null find($id, $lockMode = null, $lockVersion = null)
     * @method Wish|null findOneBy(array $criteria, array $orderBy = null)
     * @method Wish[]    findAll()
     * @method Wish[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
     */
    class WishRepository extends ServiceEntityRepository
    {
        public function __construct(ManagerRegistry $registry)
        {
            parent::__construct($registry, Wish::class);
        }

        public function save(Wish $entity, bool $flush = false): void
        {
            $this->getEntityManager()->persist($entity);

            if ($flush) {
                $this->getEntityManager()->flush();
            }
        }

        public function remove(Wish $entity, bool $flush = false): void
        {
            $this->getEntityManager()->remove($entity);

            if ($flush) {
                $this->getEntityManager()->flush();
            }
        }

        public function getAllWishes()
        {
            $queryBuilder = $this->createQueryBuilder('w');
            $queryBuilder->leftJoin('w.category', 'c')
                ->addSelect('c');
            $queryBuilder->orderBy('w.dateCreated', 'DESC');
            $queryBuilder->andWhere('w.isPublished = true');
            $query = $queryBuilder->getQuery();

            return new Paginator($query);
        }
    }
