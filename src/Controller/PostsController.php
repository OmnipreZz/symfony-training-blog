<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;

class PostsController extends AbstractController
{
    /**
     * @Route("/posts", name="posts")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(Post::class);
        $posts = $repo->findAll();
        return $this->render('posts/index.html.twig', [
            'posts' => $posts
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
     * @Route("/post/{id}", name="posts_show")
     */
    public function show($id)
    {
        $repo = $this->getDoctrine()->getRepository(Post::class);
        $post = $repo->find($id);
        return $this->render('posts/show.html.twig', [
            'post' => $post
        ]);
    }
}
