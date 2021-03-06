<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Todo;

class TodoController extends AbstractController
{
    public function new($description)
    {
        $todo = new Todo();
        $todo->setDescription($description);
        $todo->setTsCreated(new \DateTime());

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($todo);
        $manager->flush();
    }

    public function list($all)
    {
        if ($all)
        {
            return $this->getDoctrine()
                ->getRepository(Todo::class)
                ->findAll()
            ;
        }
        else
        {
            return $this->getDoctrine()
                ->getRepository(Todo::class)
                ->findBy(["done" => null])
            ;
        }
    }

    public function remove($id)
    {
        $todo = $this->getDoctrine()
            ->getRepository(Todo::class)
            ->find($id)
        ;

        if (!$todo) throw $this->createNotFoundException();

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($todo);
        $manager->flush();
    }

    public function done($id)
    {
        $todo = $this->getDoctrine()
            ->getRepository(Todo::class)
            ->find($id)
        ;

        if (!$todo) throw $this->createNotFoundException();

        $todo->setTsDone(new \DateTime());
        $todo->setDone(true);

        $manager = $this->getDoctrine()->getManager();
        $manager->flush();
    }

    public function clear()
    {
        $todos = $this->getDoctrine()
            ->getRepository(Todo::class)
            ->findAll()
        ;

        $manager = $this->getDoctrine()->getManager();

        foreach ($todos as $todo)
        {
            if ($todo->getDone())
            {
                $manager->remove($todo);
            }
        }

        $manager->flush();
    }
}
