<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Square;
use App\Form\Type\SquareFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SquareController extends AbstractController
{

    /**
     * @Route("/square", name="square_controller")
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function new(Request $request)
    {
        $square = new Square();
        $square->setLatitudeA(0.0);
        $square->setLongitudeA(0.0);
        $square->setLatitudeB(0.0);
        $square->setLongitudeB(0.0);

        $form = $this->createForm(SquareFormType::class, $square);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->submitForm($form->getData());

            return $this->render('form/new.html.twig', [
              'form' => $form->createView(),
              'square' => $square,
            ]);
        }

        return $this->render('form/new.html.twig', [
          'form' => $form->createView(),
        ]);
    }

    protected function submitForm(Square $square): void
    {
        $square->setOtherPointsOfSquare();
        $square->setPerimeterOfSquare();
        $square->calculateAreaOfSquare();
    }
}