<?php 

    namespace App\Controller;

    use App\Entity\Article;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\TextareaType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;

    class ArticleController extends Controller {
        /**
         * @Route("/", name="home")
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


        /**
         * @Route("/article/new", name="new_article")
         * Method({"GET", "POST"})
         */
        public function create(Request $request) {
            $article = new Article();

            $form = $this->createFormBuilder($article)
                ->add('title', TextType::class, array(
                    'attr' => array('class' => 'form-control')))
                ->add('body', TextareaType::class, array(
                    'required' => false, 
                    // everything required by default
                    'attr' => array('class' => 'form-control')))
                ->add('save', SubmitType::class, array(
                    'label' => 'Create new article', 
                    'attr' => array('class' => 'btn btn-primary mt-3 mb-3')))
                ->getForm();

            //iznad samo loadovanje forme, dalje handle-ovanje
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()) {
                $article = $form->getData();

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($article);
                $entityManager->flush();

                return $this->redirectToRoute('home');
            }

            return $this->render('articles/new.html.twig', array(
                'form' => $form->createView()
            ));
        }

        /**
         * @Route("/article/{id}", name="article_show")
         */
        // show mora biti ispod jer je bitan redosled citanja
        // da je iznad, citao bi /article/{id} umesto new i vodio bi na show
        public function show($id) {
            $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

            return $this->render('articles/show.html.twig', array('article' => $article));
        }

    }