<?php
/**
 * Created by PhpStorm.
 * User: nikola
 * Date: 4.2.19.
 * Time: 14.04
 */

namespace App\Controller;


use App\Entity\Nastavnik;
use App\Entity\Ocena;
use App\Entity\Predmet;
use App\Entity\Ucenik;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class OcenController extends AbstractController
{
    /**
     * @Route("/unosOcene", name="unosOcene")
     * @param Request $request
     */
    public function unosOcene(Request $request) {
        $token = $request->get('token');
        $odeljenjeId = $request->get('odeljenjeId');
        $nastavnikId = $request->get('nastavnik');
        $ucenikId = $request->get('ucenikId');
        $predmetId = $request->get('predmetId');

        $parameters = [
          'token' => $token,
          'odeljenjeId' => $odeljenjeId,
          'nastavnik' => $nastavnikId,
          'ucenikId' => $ucenikId,
            'predmetId' => $predmetId,
        ];

        return $this->render('unosOcene.html.twig',$parameters);
    }

    /**
     * @Route("/sacuvajOcenu", name="sacuvajOcenu")
     * @param Request $request
     */
    public function sacuvajOcenu(Request $request) {
        $token = $request->get('token');
        $odeljenjeId = $request->get('odeljenjeId');
        $nastavnikId = $request->get('nastavnik');
        $ucenikId = $request->get('ucenikId');
        $predmetId = $request->get('predmetId');
        $ocena = $request->get('ocena');
        $gradivo = $request->get('gradivo');

        $nastavnik = $this->getDoctrine()->getRepository(Nastavnik::class)->find((int)$nastavnikId);
        $ucenik = $this->getDoctrine()->getRepository(Ucenik::class)->find((int)$ucenikId);
        $predmet = $this->getDoctrine()->getRepository(Predmet::class)->find((int)$predmetId);

        if ($nastavnik instanceof Nastavnik) {
            if ($ucenik instanceof Ucenik) {
                if ($predmet instanceof Predmet) {
                    $ocenaNew = new Ocena();
                    $ocenaNew->setValue($ocena);
                    $ocenaNew->setGradivo($gradivo);
                    $ocenaNew->addNastavnik($nastavnik);
                    $ocenaNew->addPRedmet($predmet);
                    $ocenaNew->setUcenik($ucenik);
                    $ocenaNew->setDatum(new \DateTime("now"));
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($ocenaNew);
                    $entityManager->flush();

                    $parameters = [
                        'token' => $token,
                        'odeljenjeId' => $odeljenjeId,
                        'nastavnik' => $nastavnikId,
                        'predmetId' => $predmetId
                    ];

                    return $this->redirect($this->generateUrl('spisakUcenika', $parameters));
                }
            }
        }
    }
}