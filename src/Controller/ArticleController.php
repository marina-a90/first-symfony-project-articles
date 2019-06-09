<?php 

    namespace App\Controller;

    use App\Entity\Article;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    class ArticleController extends Controller {
        /**
         * @Route("/")
         * @Method({"GET"})
         */
        public function index() {

            // hard-coded data 
            // $articles = ['article 1', 'article 2', 'article 3'];

            // DB data
            $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();

            // return new Response('<html><body>Cao Toske!</body></html>');
            return $this->render('articles/index.html.twig', array('name' => 'Marina', 'articles' => $articles));
        }

        // /**
        //  * @Route("/article/save")
        //  */
        // public function save() {
        //     // ne koristiti inace ovo za update, sad za ucenje ovako!
        //     $entityManager = $this->getDoctrine()->getManager();

        //     $article = new Article();
        //     $article->setTitle('new article');
        //     $article->setBody('body text');

        //     $entityManager->persist($article);
        //     // persist - we want to eventually save it
        //     // to actually save it, use flush
        //     $entityManager->flush();

        //     // da vidim response - inace nema funkc, nego samo da indikuje da je zapravo snimljen clanak
        //     return new Response('saved an article with id: ' . $article->getId());
        // }
    }