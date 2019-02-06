<?php
/**
 * Created by PhpStorm.
 * User: nikola
 * Date: 2.2.19.
 * Time: 22.22
 */

namespace App\Controller;


use App\Entity\Nastavnik;
use App\Entity\Odeljenje;
use App\Entity\Plan;
use App\Entity\Predmet;
use App\Entity\Razred;
use App\Entity\Razredni;
use App\Entity\Ucenik;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class OdeljenjeController extends  AbstractController
{
    /**
     * @Route("/odeljenjeAdministrator/{razredId}", name="odeljenjeAdministrator")
     */
    public function spisakOdeljenja($razredId, Request $request)
    {
        $token = $request->get('token');

        if ($token) {
            $razred = $this->getDoctrine()->getRepository(Razred::class)->find($razredId);
            $odeljenja = $razred->getOdeljenja();

            return $this->render('pregledOdeljenja.html.twig', [
                'odeljenjeList' => $odeljenja,
                'token' => $token,
                'razred' => $razredId
                ]);
        }
        return $this->redirect('../login');
    }

    /**
     * @Route("/odeljenje/{odeljenjeId}", name="odeljenje")
     */
    public function odeljenje($odeljenjeId, Request $request)
    {
        $token = $request->get('token');
        $odeljenje = $this->getDoctrine()->getRepository(Odeljenje::class)->find($odeljenjeId);
        $razredId = $request->get('razredId');

        if ($odeljenje instanceof Odeljenje){
            $razredni = $odeljenje->getRazredni();
            if ($razredni instanceof Razredni)
            $razredniString['naziv'] = $razredni->getIme().' '.$razredni->getPrezime();

            $razred = $odeljenje->getRazred();
            $nastavnici = $odeljenje->getNastavnike();
            $ucenici = $odeljenje->getUcenici();

            $plan = $razred->getPlan();
            $predmeti = $plan->getPredmeti();
            $predmetiString = [];
            foreach ($predmeti as $predmet) {
                $nastavniciPredmeta = $predmet->getNastavnici();
                foreach ($nastavniciPredmeta as $nastavnik) {
                    if ($nastavnici->contains($nastavnik)) {
                        $predmetString = [
                          'naziv' => $predmet->getNaziv(),
                          'nastavnik' => [
                              'naziv' => $nastavnik->getIme().' '.$nastavnik->getPrezime(),
                          ]
                        ];
                        array_push($predmetiString,$predmetString);
                    }
                }
            }
            $uceniciString = [];
            foreach ( $ucenici as $ucenik) {
                $ucenikString = [
                    'naziv' => $ucenik->getIme().' '.$ucenik->getPrezime(),
                ];
                array_push($uceniciString,$ucenikString);
            }
        }
        $parameters = [
            'token' => $token,
            'razredni' => $razredniString,
            'predmeti' => $predmetiString,
            'ucenici'  => $uceniciString,
            'razredId' => $razredId,
        ];

        return $this->render('odeljenje.html.twig', $parameters);

    }

    /**
     * @param Request $request
     * @Route("/dodajOdeljenje", name="dodajOdeljenje")
     */
    public function dodajOdeljenje(Request $request)
    {
        $token = $request->get('token');
        $predmeti = $request->get('predmeti');
        $razredni = $request->get('razredni');
        $ucenici = $request->get( 'ucenici');
        $razredId = $request->get('razredId');

        if ($token) {

            if ($predmeti=='') {
                $razred = $this->getDoctrine()->getRepository(Razred::class)->find((int)$razredId);
                $predmeti=[];
                $plan = $razred->getPlan();

                if ($plan instanceof Plan) {
                    $predmetiList = $plan->getPredmeti();
                    $i=0;
                    foreach ($predmetiList as $predmet) {
                        $predmeti[$i] = [
                            'id' => $predmet->getId(),
                            'naziv' => $predmet->getNaziv(),
                            'nastavnik' => '',
                        ];
                        $i++;
                    }
                }
            }


            $parameters = [
                'razredId' => $razredId,
                'token' => $token,
                'predmeti' => $predmeti,
                'razredni' => $razredni,
                'ucenici'  => $ucenici
            ];
            return $this->render('formiranjeOdeljenja.html.twig',$parameters);
        }
    }

    /**
     * @param Request $request
     * @Route("/spisakOdeljenjaNastavnik", name="spisakOdeljenjaNastavnik")
     */
    public function spisakOdeljenjaNastavnik(Request $request)
    {
        $token = $request->get('token');
        $nastavnikId = $request->get('nastavnik');

        if ($token) {
            $nastavnik = $this->getDoctrine()->getRepository(Nastavnik::class)->find($nastavnikId);

            if ($nastavnik instanceof Nastavnik) {

                $odeljenjeList = $nastavnik->getOdeljenja();
            }

            $parameters = [
              'token' => $token,
              'nastavnik' => $nastavnikId,
                'odeljenjeList' => $odeljenjeList,
            ];

            return $this->render( 'pregledOdeljenjaNastavnik.html.twig', $parameters);

        }
    }

    /**
     * @param Request $request
     * @Route("/sacuvajOdeljenje", name="sacuvajOdeljenje")
     */
    public function sacuvajOdeljenje(Request $request) {
        $token = $request->get('token');
        $razredId = $request->get('razredId');
        $predmeti = $request->get('predmeti');
        $razredni = $request->get('razredni');
        $ucenici = $request->get('ucenici');



        $entityManager = $this->getDoctrine()->getManager();
        $newOdeljenje = new Odeljenje();

        $razred = $this->getDoctrine()->getRepository(Razred::class)->find($razredId);
        if ($razred instanceof Razred) {
            $newOdeljenje->setRazred($razred);
        }

        $nastavnik = $this->getDoctrine()->getRepository(Nastavnik::class)->find($razredni['id']);
        if ($nastavnik instanceof Nastavnik) {
            $razredni = new Razredni();
            $razredni->setIme($nastavnik->getIme());
            $razredni->setPrezime($nastavnik->getPrezime());
            $razredni->setJmbg($nastavnik->getJmbg());
            $razredni->setAdresa($nastavnik->getAdresa());
            $razredni->setTelefon($nastavnik->getTelefon());
            $razredni->setEmail($nastavnik->getEmail());
            $razredni->setSifra($nastavnik->getSifra());
            $entityManager->persist($razredni);

        }

        foreach ($predmeti as $predmet) {
            $nastavnik = $this->getDoctrine()->getRepository(Nastavnik::class)->find($predmet['nastavnik']['id']);
            if ($nastavnik instanceof Nastavnik) {
                $newOdeljenje->addNastavnik($nastavnik);
            }
        }

        foreach ($ucenici as $ucenik) {
            $newUcenik = new Ucenik();
            $newUcenik->setIme($ucenik['ime']);
            $newUcenik->setPrezime($ucenik['prezime']);
            $newUcenik->setTelefon($ucenik['telefon']);
            $newUcenik->setAdresa($ucenik['adresa']);
            $newUcenik->setEmail($ucenik['email']);
            $newUcenik->setSifra($ucenik['sifra']);
            $newOdeljenje->addUcenik($newUcenik);
            $entityManager->persist($newUcenik);
        }
        $oznaka = 1;
        $odeljenja = $this->getDoctrine()->getRepository(Odeljenje::class)->findAll();
        foreach ($odeljenja as $odeljenje) {
            $oznaka++;
        }
        $newOdeljenje->setRazredni($razredni);
        $newOdeljenje->setOznaka($oznaka);
        $entityManager->persist($newOdeljenje);
        $entityManager->flush();

        $parameters = [
            'razredId' => $razredId,
            'token'    => $token,
        ];

        return $this->redirect($this->generateUrl('odeljenjeAdministrator', $parameters));
    }

}