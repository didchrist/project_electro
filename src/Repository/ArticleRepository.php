<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Article>
 *
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function save(Article $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Article $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function findAllArticle(int $page = 1, string $univers = 'a.univers', string $famille = null, string $sous_famille = null, int $limit = 30): array
    {
        $limit = abs($limit);

        $result = [];

        if ($univers === 'a.univers') {
            $query = $this->getEntityManager()->createQueryBuilder()
                ->select('a')
                ->from('App\Entity\Article', 'a')
                ->where("a.univers = $univers")
                ->orderBy('a.univers', 'ASC')
                ->setMaxResults($limit)
                ->setFirstResult($page * $limit - $limit);
        } else {
            if ($famille != null) {
                if ($sous_famille != null) {
                    $query = $this->getEntityManager()->createQueryBuilder()
                        ->select('a')
                        ->from('App\Entity\Article', 'a')
                        ->where("a.famille = '$famille' and a.sous_famille = '$sous_famille'")
                        ->orderBy('a.marque', 'ASC')
                        ->setMaxResults($limit)
                        ->setFirstResult($page * $limit - $limit);
                } else {
                    $query = $this->getEntityManager()->createQueryBuilder()
                        ->select('a')
                        ->from('App\Entity\Article', 'a')
                        ->where("a.famille = '$famille'")
                        ->orderBy('a.marque', 'ASC')
                        ->setMaxResults($limit)
                        ->setFirstResult($page * $limit - $limit);
                }
            } else {
                $query = $this->getEntityManager()->createQueryBuilder()
                    ->select('a')
                    ->from('App\Entity\Article', 'a')
                    ->where("a.univers = '$univers'")
                    ->orderBy('a.marque', 'ASC')
                    ->setMaxResults($limit)
                    ->setFirstResult($page * $limit - $limit);
            }
        }

        $paginator = new Paginator($query);
        $data = $paginator->getQuery()->getResult();

        if (empty($data)) {
            return $result;
        }

        //nombre de pages
        $pages = ceil($paginator->count() / $limit);

        $result['data'] = $data;
        $result['pages'] = $pages;
        $result['page'] = $page;
        $result['limit'] = $limit;

        return $result;
    }
    public function findByRecherche(string $filtre) {

        $filtreMarqueCode = strtoupper($filtre);
        $query = $this->getEntityManager()->createQueryBuilder()
            ->select('a.marque')
            ->from('App\Entity\Article', 'a')
            ->where("a.marque LIKE '$filtreMarqueCode%'")
            ->groupBy("a.marque")
            ->orderBy('a.marque', 'ASC')
            ->setMaxResults(5);

        $filtreCategorie = ucfirst($filtre);
        $query2 = $this->getEntityManager()->createQueryBuilder()
            ->select('a.univers')
            ->from('App\Entity\Article', 'a')
            ->where("a.univers LIKE '$filtreCategorie%'")
            ->groupBy("a.univers")
            ->orderBy('a.univers', 'ASC')
            ->setMaxResults(2);

        $query3 = $this->getEntityManager()->createQueryBuilder()
            ->select('a.famille')
            ->from('App\Entity\Article', 'a')
            ->where("a.famille LIKE '$filtreCategorie%'")
            ->groupBy("a.famille")
            ->orderBy('a.famille', 'ASC')
            ->setMaxResults(3);

        $query4 = $this->getEntityManager()->createQueryBuilder()
            ->select('a.sous_famille')
            ->from('App\Entity\Article', 'a')
            ->where("a.sous_famille LIKE '$filtreCategorie%'")
            ->groupBy("a.sous_famille")
            ->orderBy('a.sous_famille', 'ASC')
            ->setMaxResults(2);
        
        $query5 = $this->getEntityManager()->createQueryBuilder()
            ->select('a.code_article')
            ->from('App\Entity\Article', 'a')
            ->where("a.code_article LIKE '$filtreMarqueCode%'")
            ->groupBy("a.code_article")
            ->orderBy('a.code_article', 'ASC')
            ->setMaxResults(4);
        
        $dataMarque = $query->getQuery()->getResult();
        $dataUnivers = $query2->getQuery()->getResult();
        $dataFamille = $query3->getQuery()->getResult();
        $dataSousFamille = $query4->getQuery()->getResult();
        $dataCode = $query5->getQuery()->getResult();

        $result['marque'] = $dataMarque;
        $result['univers'] = $dataUnivers;
        $result['famille'] = $dataFamille;
        $result['sousFamille'] = $dataFamille;
        $result['code'] = $dataCode;

        dd($result);

        return $result;
    }

    //    /**
    //     * @return Article[] Returns an array of Article objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Article
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}