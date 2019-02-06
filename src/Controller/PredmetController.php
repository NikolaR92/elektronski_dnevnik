<?php
/**
 * Created by PhpStorm.
 * User: nikola
 * Date: 4.2.19.
 * Time: 23.10
 */

namespace App\Controller;


use App\Entity\Nastavnik;
use App\Entity\Odeljenje;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PredmetController extends AbstractController
{

    /**
     * @param Request $request
     * @Route("/pregledPredmeta", name="pregledPredmeta")
     */
    public function pregledPredmeta(Request $request)
    {
        $token = $request->get('token');
        $nastavnikId = $request->get('nastavnik');
        $odeljenjeId = $request->get('odeljenjeId');

        $odeljenje = $this->getDoctrine()->getRepository(Odeljenje::class)->find($odeljenjeId);
        $nastavnik = $this->getDoctrine()->getRepository(Nastavnik::class)->find($nastavnikId);

        if ($odeljenje instanceof Odeljenje) {
            if ($nastavnik instanceof Nastavnik) {
                $razred = $odeljenje->getRazred();
                $plan = $razred->getPlan();
                $predmeti = $plan->getPredmeti();
                $predmetiString = [];
                foreach ($predmeti as $predmet) {
                    $nastavnici = $predmet->getNastavnici();
                    if ($nastavnici->contains($nastavnik)) {
                        $predmetString['id']= $predmet->getId();
                        $predmetString['naziv']= $predmet->getNaziv();
                        array_push($predmetiString,$predmetString);
                    }
                }
            }
        }
        $parameters = [
          'token' => $token,
          'nastavnik' => $nastavnikId,
          'odeljenjeId' =>$odeljenjeId,
          'predmeti' => $predmetiString,
        ];

        return $this->render('pregledPredmeta.html.twig', $parameters);
    }
}