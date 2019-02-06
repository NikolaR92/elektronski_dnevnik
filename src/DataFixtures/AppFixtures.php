<?php

namespace App\DataFixtures;

use App\Entity\Predmet;
use App\Entity\Razred;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $predmetSrpski = new Predmet();
        $predmetSrpski -> setNaziv('Srpski');
        $manager ->persist($predmetSrpski);


        $predmetMatematika = new Predmet();
        $predmetMatematika -> setNaziv('Matematika');
        $manager ->persist($predmetMatematika);


        $predmetFizika = new Predmet();
        $predmetFizika -> setNaziv('Fizika');
        $manager ->persist($predmetFizika);

        $predmetMuzicko = new Predmet();
        $predmetMuzicko -> setNaziv('Muzicko');
        $manager ->persist($predmetMuzicko);

        $manager->flush();

        $nastavnik1 = new \App\Entity\Nastavnik();
        $nastavnik1 -> setIme('Milan');
        $nastavnik1 -> setPrezime('Pavlovic');
        $nastavnik1 -> setJmbg('abv1234567891');
        $nastavnik1 -> setAdresa('Milete Cerovca 53');
        $nastavnik1 -> setTelefon( '12345678');
        $nastavnik1 -> setEmail('milan.pavlovic@skola.rs');
        $nastavnik1 -> setSifra('12345');
        $nastavnik1 -> addPredmet($predmetSrpski);
        $manager->persist($nastavnik1);

        $nastavnik2 = new \App\Entity\Nastavnik();
        $nastavnik2 -> setIme('Filip');
        $nastavnik2 -> setPrezime('Maric');
        $nastavnik2 -> setJmbg('abv1234567891');
        $nastavnik2 -> setAdresa('Milete Cerovca 53');
        $nastavnik2 -> setTelefon( '12345678');
        $nastavnik2 -> setEmail('filip.maric@skola.rs');
        $nastavnik2 -> setSifra('12345');
        $nastavnik2 ->addPredmet($predmetMatematika);
        $manager->persist($nastavnik2);


        $nastavnik3 = new \App\Entity\Nastavnik();
        $nastavnik3 -> setIme('Jovana');
        $nastavnik3 -> setPrezime('Jelenkovic');
        $nastavnik3 -> setJmbg('abv1234567891');
        $nastavnik3 -> setAdresa('Milete Cerovca 53');
        $nastavnik3 -> setTelefon( '12345678');
        $nastavnik3 -> setEmail('jovana.jelenkovic@skola.rs');
        $nastavnik3 -> setSifra('12345');
        $nastavnik3 ->addPredmet($predmetFizika);
        $manager ->persist($nastavnik3);

        $nastavnik4 = new \App\Entity\Nastavnik();
        $nastavnik4 -> setIme('Jelena');
        $nastavnik4 -> setPrezime('Jelenkovic');
        $nastavnik4 -> setJmbg('abv1234567891');
        $nastavnik4 -> setAdresa('Milete Cerovca 53');
        $nastavnik4 -> setTelefon( '12345678');
        $nastavnik4 -> setEmail('jelena.jelenkovic@skola.rs');
        $nastavnik4 -> setSifra('12345');
        $nastavnik4 ->addPredmet($predmetFizika);
        $manager ->persist($nastavnik4);

        $nastavnik5 = new \App\Entity\Nastavnik();
        $nastavnik5 -> setIme('Petar');
        $nastavnik5 -> setPrezime('Peric');
        $nastavnik5 -> setJmbg('abv1234567891');
        $nastavnik5 -> setAdresa('Milete Cerovca 53');
        $nastavnik5 -> setTelefon( '12345678');
        $nastavnik5 -> setEmail('petar.peric@skola.rs');
        $nastavnik5 -> setSifra('12345');
        $nastavnik5 ->addPredmet($predmetMuzicko);
        $manager ->persist($nastavnik5);

        $manager->flush();

        $plan = new \App\Entity\Plan();
        $plan ->addPredmet($predmetSrpski);
        $plan -> addPredmet($predmetMuzicko);
        $plan -> addPredmet($predmetFizika);
        $plan -> addPredmet($predmetMatematika);
        $manager ->persist($plan);

        $plan1 = new \App\Entity\Plan();
        $plan1 ->addPredmet($predmetSrpski);
        $plan1 -> addPredmet($predmetMuzicko);
        $plan1 -> addPredmet($predmetFizika);
        $plan1 -> addPredmet($predmetMatematika);
        $manager ->persist($plan1);

        $plan2 = new \App\Entity\Plan();
        $plan2 ->addPredmet($predmetSrpski);
        $plan2 -> addPredmet($predmetMuzicko);
        $plan2 -> addPredmet($predmetFizika);
        $plan2 -> addPredmet($predmetMatematika);
        $manager ->persist($plan2);

        $plan3 = new \App\Entity\Plan();
        $plan3 ->addPredmet($predmetSrpski);
        $plan3 -> addPredmet($predmetMuzicko);
        $plan3 -> addPredmet($predmetFizika);
        $plan3 -> addPredmet($predmetMatematika);
        $manager ->persist($plan3);

        $plan4 = new \App\Entity\Plan();
        $plan4 ->addPredmet($predmetSrpski);
        $plan4 -> addPredmet($predmetMuzicko);
        $plan4 -> addPredmet($predmetFizika);
        $plan4 -> addPredmet($predmetMatematika);
        $manager ->persist($plan4);

        $plan5 = new \App\Entity\Plan();
        $plan5 ->addPredmet($predmetSrpski);
        $plan5 -> addPredmet($predmetMuzicko);
        $plan5 -> addPredmet($predmetFizika);
        $plan5 -> addPredmet($predmetMatematika);
        $manager ->persist($plan5);

        $plan6 = new \App\Entity\Plan();
        $plan6 ->addPredmet($predmetSrpski);
        $plan6 -> addPredmet($predmetMuzicko);
        $plan6 -> addPredmet($predmetFizika);
        $plan6 -> addPredmet($predmetMatematika);
        $manager ->persist($plan6);

        $plan7 = new \App\Entity\Plan();
        $plan7 ->addPredmet($predmetSrpski);
        $plan7 -> addPredmet($predmetMuzicko);
        $plan7 -> addPredmet($predmetFizika);
        $plan7 -> addPredmet($predmetMatematika);
        $manager ->persist($plan7);

        $razredi =  new Razred();
        $razredi -> setOznaka('I');
        $razredi ->setPlan($plan);
        $manager ->persist($razredi);

        $razredi2 =  new Razred();
        $razredi2 -> setOznaka('II');
        $razredi2 ->setPlan($plan1);
        $manager ->persist($razredi2);


        $razredi3 =  new Razred();
        $razredi3 -> setOznaka('III');
        $razredi3 ->setPlan($plan2);
        $manager ->persist($razredi3);


        $razredi4 =  new Razred();
        $razredi4 -> setOznaka('IV');
        $razredi4 ->setPlan($plan3);
        $manager ->persist($razredi4);


        $razredi5 =  new Razred();
        $razredi5 -> setOznaka('V');
        $razredi5 ->setPlan($plan4);
        $manager ->persist($razredi5);


        $razredi6 =  new Razred();
        $razredi6 -> setOznaka('VI');
        $razredi6 ->setPlan($plan5);
        $manager ->persist($razredi6);


        $razredi7 =  new Razred();
        $razredi7 -> setOznaka('VII');
        $razredi7 ->setPlan($plan6);
        $manager ->persist($razredi7);


        $razredi8 =  new Razred();
        $razredi8 -> setOznaka('VIII');
        $razredi8 ->setPlan($plan7);
        $manager ->persist($razredi8);



        $manager->flush();
    }
}
