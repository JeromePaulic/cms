<?php

namespace App\Controller;


use App\Entity\Option;
use App\Form\Type\InstallType;
use App\Repository\CategoryRepository;
use App\Service\ArticleService;
use App\Service\OptionService;
use Doctrine\ORM\EntityManagerInterface;
use InstallModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ArticleService $articleService, CategoryRepository $categoryRepo): Response
    {
        return $this->render('home/index.html.twig', [
            'articles' => $articleService->getPaginatedArticles(),
            'categories' => $categoryRepo->findAll()

        ]);
    }

    #[Route('/install', name: 'app_install')]
    public function install(Request $request,
                            EntityManagerInterface $em,
                            UserPasswordHasherInterface $passwordHasher,
                            OptionService $optionService
    ): Response
    {

        if ($optionService->getValue(InstallModel::SITE_INSTALLED_NAME)) {
            return $this->redirectToRoute('app_home');
        }

        $installForm = $this->createForm(InstallType::class, new InstallModel());

        $installForm->handleRequest($request);

        if ($installForm->isSubmitted() && $installForm->isValid()) {
            /** @var  InstallModel $data */
            $data = $installForm->getData();

            $siteTile = new Option(InstallModel::SITE_TITLE_LABEL, InstallModel::SITE_TITLE_NAME, $data->getSiteTitle(), TextType::class);
            $siteInstalled = new Option(InstallModel::SITE_INSTALLED_LABEL, InstallModel::SITE_INSTALLED_NAME, true, null);

            $user = new($data->getUsername());
            $user->setRoles(['ROLE_ADMIN']);
            $user->setPassword($passwordHasher->hashPassword($user, $data->getPassword()));

            $em->persist($siteTile);
            $em->persist($siteInstalled);
            $em->persist($user);

            $em->flush();

            return $this->redirectToRoute('app_home');


        }

        return $this->render('home/install.html.twig', [
            'form' => $installForm->createView()
        ]);
    }


}
