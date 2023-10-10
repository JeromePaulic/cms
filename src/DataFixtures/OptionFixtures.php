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
        $options[] = new Option('Suivez-moi ( URL )', 'website_social_network_url', 'https://www.facebook.com/VotrePage', TextType::class);
        $options[] = new Option('Suivez-moi ( Nom du lien )', 'website_social_network_name', 'Suivez-moi sur Facebook', TextType::class);
        $options[] = new Option('Suivez-moi ( Icône du lien )', 'website_social_network_icon', '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
  <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
</svg>', TextType::class);
        $options[] = new Option('Favicon', 'website_favicon', 'uploads/favicon.ico', TextType::class);
        $options[] = new Option('Logo', 'website_logo', 'uploads/logo.png', TextType::class);

        foreach ($options as $option) {
            $manager->persist($option);
        }

        $manager->flush();
    }
}