<?php

namespace Eshop\ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Eshop\ShopBundle\Entity\Category;
use Eshop\ShopBundle\Entity\Manufacturer;

class LayoutsUtilityController extends Controller
{

    /**
     * render categories menu
     */
    public function categoriesMenuAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categoryRepository = $em->getRepository(Category::class);

        $settings = $this->get('app.site_settings');
        $showEmpty = $settings->getShowEmptyCategories();

        $categories = $categoryRepository->getAllCategories($showEmpty);

        return $this->render('ShopBundle:Partials:categoriesMenu.html.twig',
                        ['categories' => $categories]);
    }

    /**
     * render manufacturers menu
     */
    public function manufacturersMenuAction()
    {
        $em = $this->getDoctrine()->getManager();
        $manufacturerRepository = $em->getRepository(Manufacturer::class);

        $settings = $this->get('app.site_settings');
        $showEmpty = $settings->getShowEmptyManufacturers();

        $manufacturers = $manufacturerRepository->getAllManufacturers($showEmpty);

        return $this->render('ShopBundle:Partials:manufacturersMenu.html.twig',
                        ['manufacturers' => $manufacturers]);
    }

    /**
     * render top menu with static pages headers.
     */
    public function staticPagesMenuAction()
    {
        $em = $this->getDoctrine()->getManager();
        $headers = $em->getRepository('ShopBundle:StaticPage')->getHeaders();
        return $this->render('ShopBundle:Partials:staticPagesMenu.html.twig', ['headers' => $headers]);
    }

}
