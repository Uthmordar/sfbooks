<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Book;

class BookController extends Controller
{
    /**
     * @Route("/book", name="indexBook")
     */
    public function indexAction(){
        $bookRepo=$this->getDoctrine()->getRepository("AppBundle:Book");
        
        $books=$bookRepo->findAll();
        
        $params=[
            'books'=>$books
        ];
        return $this->render('book/index.html.twig', $params);
    }
    
    /**
     * @Route("/book/{id}", name="showBook")
     * @return type
     */
    public function showAction($id){
        $bookRepo=$this->getDoctrine()->getRepository("AppBundle:Book");
        $book=$bookRepo->find($id);
        
        return $this->render('book/show.html.twig', compact('book'));
    }
}
