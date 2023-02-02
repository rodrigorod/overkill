<?php

namespace App\Controller;

use App\Entity\Upload;
use App\Form\UploadType;
use App\Message\UploadMessage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class OverkillController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $manager,
    )
    {}

    #[Route('/', name: 'app_overkill')]
    public function index(Request $request, MessageBusInterface $messageBus): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $upload = new Upload();

        $form = $this->createForm(UploadType::class, $upload);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $upload->setUploadedBy($this->getUser());

            $this->manager->persist($upload);
            $this->manager->flush();

            $messageBus->dispatch(
                new UploadMessage(
                    $upload->getImageFile(),
                    $this->getUser()->getUserIdentifier()
                )
            );

            return $this->redirectToRoute('app_overkill');
        }

        return $this->render('overkill/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
