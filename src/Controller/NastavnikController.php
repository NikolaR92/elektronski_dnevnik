<?php
/**
 * Created by PhpStorm.
 * User: nikola
 * Date: 3.2.19.
 * Time: 16.50
 */

namespace App\Controller;


use App\Entity\Nastavnik;
use App\Entity\Plan;
use App\Entity\Predmet;
use App\Entity\Razred;
use App\Repository\PredmetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class NastavnikController extends AbstractController
{

    /**
     * @param Request $request
     * @Route("/dodajNastavnike", name="dodajNastavnike")
     */
    public function dodajNastavnike(Request $request)
    {
        $token = $request->get('token');
        $predmeti = $request->get('predmeti');
        $razredni = $request->get('razredni');
        $ucenici = $request->get( 'ucenici');
        $razredId = $request->get('razredId');
        $nastavnik = $request->get('nastavnik');
        $predmetId = $request->get('predmetId');
        if ($token) {
            $dodeljeni = 'nesto';
            if ($nastavnik!=='' && $predmetId!=='') {

                $newArray=[];
                    foreach ($predmeti as $predmet) {
                        if ($predmet['id']===$predmetId){
                            $predmet['nastavnik']=$nastavnik;
                        } else if ($predmet['nastavnik']==='') {
                            $dodeljeni = '';
                        }
                        array_push($newArray,$predmet);
                    }
            }




            $parameters = [
                'razredId' => $razredId,
                'token' => $token,
                'predmeti' => $newArray,
                'razredni' => $razredni,
                'ucenici'  => $ucenici,
                'dodeljeni' => $dodeljeni
            ];
            return $this->render('dodelaProfesora.html.twig',$parameters);
        }
    }

    /**
     * @Route("/izborNastavnika", name="izborNastavnika")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */
    public function izborNastavnika(Request $request)
    {
        $token = $request->get('token');
        $predmeti = $request->get('predmeti');
        $razredni = $request->get('razredni');
        $ucenici = $request->get( 'ucenici');
        $razredId = $request->get('razredId');
        $predmetId = $request->get('predmetId');
        $nastavniciLista = [];
        if ($token) {

            if ($predmetId!=='') {
                $predmet = $this->getDoctrine()->getRepository(Predmet::class)->find($predmetId);
                if ($predmet instanceof Predmet) {
                    $nastavnici = $predmet->getNastavnici();
                        foreach ($nastavnici as $nastavnik) {
                            $nastavnikFormat = [
                                'id' => $nastavnik->getId(),
                                'naziv' => $nastavnik->getIme() . ' ' . $nastavnik->getPrezime(),
                            ];
                            array_push($nastavniciLista, $nastavnikFormat);
                        }

                }
            }


            $parameters = [
                'razredId' => $razredId,
                'token' => $token,
                'predmeti' => $predmeti,
                'razredni' => $razredni,
                'ucenici'  => $ucenici,
                'nastavnici' => $nastavniciLista,
                'predmetId' => $predmetId,
            ];
            return $this->render('izaberiNastavnika.html.twig',$parameters);
        }
    }

    /**
     * @Route("/izborOperacije", name="izborOperacije")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function izborOperacije(Request $request)
    {
        $token = $request->get('token');
        $odeljenjeId = $request->get('odeljenjeId');
        $nastavnik = $request->get('nastavnik');

        $parameters = [
            'token' => $token,
            'odeljenjeId' => $odeljenjeId,
            'nastavnik' => $nastavnik,
        ];
        return $this->render('izborRadnje.html.twig',$parameters);
    }

}