<?php
/**
 * Created by PhpStorm.
 * User: nikola
 * Date: 30.1.19.
 * Time: 11.01
 */

namespace App\Controller;


use App\Entity\Razred;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PregledRazredaController extends AbstractController
{

    /**
     * @param Request $request
     * @Route("/razredi_administrator", name="razredi")
     */
    public function pregledRazreda(Request $request)
    {
        $token = $request->get('token');
        if ( $token ) {
            $razredi = $this->getDoctrine()->getRepository(Razred::class)->findAll();
            return $this->render('pregledRazreda.html.twig', [
                'razredList' => $razredi,
                'token' => $token
            ]);
        }
        return $this->redirect('login');
    }

}