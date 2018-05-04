<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContaController extends Controller
{
    /**
     * @Route("/conta", name="conta")
     */
    public function index()
    {
        return $this->render('conta/index.html.twig', [
            'controller_name' => 'ContaController',
        ]);
    }
}
