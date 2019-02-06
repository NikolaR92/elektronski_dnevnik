<?php
/**
 * Created by PhpStorm.
 * User: nikola
 * Date: 30.1.19.
 * Time: 09.09
 */

namespace App\Controller;


use App\Entity\Administrator;
use App\Entity\Nastavnik;
use App\Entity\Ucenik;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LogInController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show()
    {
        return $this->render('logingPage.html');
    }

    /**
     * @param Request $request
     * @Route("/loging", name="loginPage")
     */
    public function login(Request $request)
    {
        $email    = $request->get('email');
        $password = $request->get('password');
        $user     = $request->get('user');

        $filter = [
            'email'    => $email,
            'sifra' => $password,
        ];

        $token = 'token';

        if ($user === 'nastavnik') {

            $user = $this->getDoctrine()->getRepository(Nastavnik::class)->findOneBy($filter);
            if ($user) {
                return $this->redirect($this->generateUrl('spisakOdeljenjaNastavnik', ['token' => $token, 'nastavnik' =>$user->getId()]) );
            }
        } else if ($user === 'administrator') {
            $user = $this->getDoctrine()->getRepository(Administrator::class)->findOneBy($filter);
            if ($user) {
                return $this->redirect($this->generateUrl('razredi', ['token' => $token]));
            }
        } else if ($user === 'ucenik') {
            $user = $this->getDoctrine()->getRepository(Ucenik::class)->findOneBy($filter);
            if ($user) {
                return $this->redirect($this->generateUrl('ucenik', ['token' => $token]));
            }
        }

        return $this->redirect('login');
    }

}