<?php
namespace Vin\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdvertController extends Controller
{
    protected $listAdverts = [];

    public function __construct()
    {
        $this->listAdverts = [
            2 => [
                'id' => 2,
                'title' => 'Recherche développeur Symfony 2',
                'author' => 'Vin',
                'date' => new \DateTime(),
                'content' => 'Un contenu',
            ],
            5 => [
                'id' => 5,
                'title' => 'Mission de webmaster',
                'author' => 'Vin',
                'date' => new \DateTime(),
                'content' => 'Un contenu',
            ],
            9 => [
                'id' => 9,
                'title' =>'Offre de stage webdesigner',
                'author' => 'Vin',
                'date' => new \DateTime(),
                'content' => 'Un contenu',
            ],
        ];
    }

    public function menuAction()
    {
        return $this->render('PlatformBundle:Advert:menu.html.twig', [
            'listAdverts' => $this->listAdverts,
        ]);
    }

    public function indexAction($page)
    {
        if ($page < 1) {
            throw new NotFoundHttpException(sprintf('Page %d inexistante.', $page));
        }

        return $this->render('PlatformBundle:Advert:index.html.twig', [
            'listAdverts' => $this->listAdverts,
        ]);
    }

    public function viewAction($id)
    {
        return $this->render('PlatformBundle:Advert:view.html.twig', [
            'advert' => $this->listAdverts[$id],
        ]);
    }

    public function viewSlugAction($year, $slug, $_format)
    {
        $url = $this->generateUrl(
            'platform_view',
            array('id' => 5)
        );

        return new Response(sprintf(
            "On pourrait afficher l'annonce correspondant au slug '%s', créée en %d et au format %s. url : %s",
            $slug,
            $year,
            $_format,
            $url
        ));
    }

    public function addAction(Request $request)
    {
        $antispam = $this->get('platform.antispam');

        if ($request->isMethod('POST')) {
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

            return $this->redirect($this->generateUrl('platform_view', ['id' => 5]));
        }

        return $this->render('PlatformBundle:Advert:add.html.twig');
    }

    public function editAction($id, Request $request)
    {
        return $this->render('PlatformBundle:Advert:edit.html.twig', [
            'advert' => $this->listAdverts[$id],
        ]);
    }

    public function deleteAction($id)
    {
        return $this->render('PlatformBundle:Advert:delete.html.twig');
    }
}