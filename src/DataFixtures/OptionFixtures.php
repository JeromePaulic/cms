<?php

namespace App\DataFixtures;

use App\Entity\Option;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class OptionFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //$options[] = new Option('Titre du site web', 'website_title', 'Mon site web', TextType::class);
        $options[] = new Option('Texte du copyright', 'website_copyright', 'Tous droits réservés', TextType::class);
        $options[] = new Option("Nombre d'articles par page", "website_articles_limit", 5, NumberType::class);
        $options[] = new Option('A propos', 'website_about', 'A propos de moi', TextType::class);
        $options[] = new Option("Tout le monde peut s'inscrire", "users_can_register", true, CheckboxType::class);
        $options[] = new Option('Suivez-moi ( Lien )', 'website_social_network_url', 'https://www.facebook.com/VotrePage', TextType::class);
        $options[] = new Option('Suivez-moi ( Nom du lien )', 'website_social_network_name', 'Suivez-moi sur Facebook', TextType::class);
        $options[] = new Option('Favicon', 'website_favicon', 'uploads/favicon.ico', TextType::class);
        $options[] = new Option('Logo', 'website_logo', 'uploads/logo.png', TextType::class);

        foreach ($options as $option) {
            $manager->persist($option);
        }

        $manager->flush();
    }
}