<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PostsController extends AbstractController
{
    /**
     * @Route("/posts", name="posts")
     */
    public function index()
    {
        return $this->render('posts/index.html.twig', [
            'controller_name' => 'PostsController',
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('posts/home.html.twig', [
            'title' => 'coucou',
        ]);
    }

    /**
     * @Route("/posts/12", name="posts_show")
     */
    public function show()
    {
        return $this->render('posts/show.html.twig', [
            'title' => 'coucou',
        ]);
    }
}
