<?php
/**
 * Created by PhpStorm.
 * User: nikola
 * Date: 3.2.19.
 * Time: 16.43
 */

namespace App\Controller;


use App\Entity\Odeljenje;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UcenikController extends AbstractController
{
    /**
     * @param Request $request
     * @Route("/dodajUcenika",name="dodajUcenika" )
     */
    public function dodajUcenika(Request $request)
    {
        $token = $request->get('token');
        $predmeti = $request->get('predmeti');
        $razredni = $request->get('razredni');
        $ucenici = $request->get( 'ucenici');
        $razredId = $request->get('razredId');

        if ($token) {


            $parameters = [
                'razredId' => $razredId,
                'token' => $token,
                'predmeti' => $predmeti,
                'razredni' => $razredni,
                'ucenici'  => $ucenici
            ];
            return $this->render('dodajUcenika.html.twig',$parameters);
        }
    }

    /**
     * @param Request $request
     * @Route("/sacuvajUcenika", name="sacuvajUcenika")
     */
    public function sacuvajUcenika(Request $request)
    {
        $token = $request->get('token');
        $predmeti = $request->get('predmeti');
        $razredni = $request->get('razredni');
        $ucenici = $request->get( 'ucenici');
        $razredId = $request->get('razredId');

        $ime = $request->get('ime');
        $prezime = $request->get('prezime');
        $adresa = $request->get('adresa');
        $telefon = $request->get('telefon');
        $email = $request->get('email');
        $sifra = $request->get('sifra');

        if ($token) {

            $ucenik = [
                'ime' => $ime,
                'prezime' => $prezime,
                'adresa'  => $adresa,
                'telefon' => $telefon,
                'email'   => $email,
                    'sifra' => $sifra,
                'naziv' => $ime.' '.$prezime,
            ];
            if ($ucenici=='') {
                $ucenici = [];
            }

            array_push($ucenici,$ucenik);

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
     * @Route("/spisakUcenika", name="spisakUcenika")
     * @param Request $request
     */
    public function spisakUcenika(Request $request)
    {
        $token = $request->get('token');
        $odeljenjeId = $request->get('odeljenjeId');
        $nastavnik = $request->get('nastavnik');
        $predmetId = $request->get('predmetId');

        $odeljenje = $this->getDoctrine()->getRepository(Odeljenje::class)->find($odeljenjeId);
        if ($odeljenje instanceof Odeljenje) {
            $ucenici = $odeljenje->getUcenici();
        }

        $newUcenici = [];
        foreach ($ucenici as $ucenik) {

            $ocene = $ucenik->getOcene();
            $oceneString = '';
            foreach ($ocene as $ocena) {
                if ($ocena->getPredmet()->getId()==$predmetId) {
                    $oceneString = $oceneString . ',' . $ocena->getValue();
                }
            }
            $newUcenik = [
                'id' => $ucenik->getId(),
                'naziv' => $ucenik->getIme().' '.$ucenik->getPrezime(),
                'ocene' => $oceneString,
            ];
            array_push($newUcenici,$newUcenik);
        }

        $parameters = [
          'token' => $token,
            'odeljenjeId' => $odeljenjeId,
            'nastavnik' => $nastavnik,
            'ucenici' => $newUcenici,
            'predmetId' => $predmetId,
        ];

        return $this->render('pregledUcenika.html.twig',$parameters);
    }

}