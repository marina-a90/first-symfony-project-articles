<?php 

    namespace App\Controller;

    // use Symfony\Component\HttpFoundation\Response;
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
            $articles = ['article 1', 'article 2', 'article 3'];

            // return new Response('<html><body>Cao Toske!</body></html>');
            return $this->render('articles/index.html.twig', array('name' => 'Marina', 'articles' => $articles));
        }
    }