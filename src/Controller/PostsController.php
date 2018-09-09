<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class PostsController extends AbstractController
{
    /**
     * @Route("/posts", name="posts")
     */
    public function index(PostRepository $repo)
    {
        // $repo = $this->getDoctrine()->getRepository(Post::class);
        $posts = $repo->findBy(array(), array('CreatedAt' => 'desc'));
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
     * @Route("/post/new", name="post_create")
     * @Route("/post/{id}/edit", name="post_edit")
     */
    public function form(Post $post = null, Request $request)
    {
        if(!$post) {
            $post = new Post();
        }

        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            if(!$post->getId()) {
                $post->setCreatedAt(new \DateTime());
            }
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('post_show', ['id' => $post->getId()]);
        }

        return $this->render('posts/create.html.twig', [
            'formPost' => $form->createView(),
            'editMode' => $post->getId() !== null
        ]);
    }

    /**
     * @Route("/post/{id}", name="post_show")
     */
    public function show(PostRepository $repo, $id)
    {
        $post = $repo->find($id);
        return $this->render('posts/show.html.twig', [
            'post' => $post
        ]);
    }

    /**
     * @Route("/posts/delete/{id}", name="post_delete")
     */
    public function delete(Post $post, Request $request )
    {
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();

        return $this->redirectToRoute('posts');
    }



}
