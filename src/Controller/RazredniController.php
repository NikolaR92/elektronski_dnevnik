<?php
/**
 * Created by PhpStorm.
 * User: nikola
 * Date: 3.2.19.
 * Time: 16.42
 */

namespace App\Controller;


use App\Entity\Nastavnik;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RazredniController extends AbstractController
{

    /**
     * @param Request $request
     * @Route("/dodajRazrednog", name="dodajRazrednog")
     */
    public function dodajRazrednog(Request $request) {
        $token = $request->get('token');
        $predmeti = $request->get('predmeti');
        $razredni = $request->get('razredni');
        $ucenici = $request->get( 'ucenici');
        $razredId = $request->get('razredId');

        if ($token) {

            $nastavnici = $this->getDoctrine()->getRepository(Nastavnik::class)->findAll();
            $nastavniciList = [];
            foreach ($nastavnici as $nastavnik) {
                if ($nastavnik instanceof Nastavnik) {
                    $nastavnikNovi = [
                        'id' => $nastavnik->getId(),
                        'naziv' => $nastavnik->getIme().' '.$nastavnik->getPrezime(),
                        ];
                    array_push($nastavniciList, $nastavnikNovi);
                }
            }

            $parameters = [
                'razredId' => $razredId,
                'token' => $token,
                'predmeti' => $predmeti,
                'razredni' => $razredni,
                'ucenici'  => $ucenici,
                'nastavnici' => $nastavniciList,
            ];
            return $this->render('dodajRazrednog.html.twig',$parameters);
        }
    }

}