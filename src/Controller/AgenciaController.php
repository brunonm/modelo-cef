<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use League\Tactician\CommandBus;
use Ramsey\Uuid\Uuid;
use App\Service\Query\AgenciaQuery;
use App\Service\Command\RegistrarAgenciaCommand;

class AgenciaController extends Controller
{
    /**
     * @var CommandBus
     */
    private $commandBus;

    /**
     * @var AgenciaQuery
     */
    private $agenciaQuery;

    public function __construct(CommandBus $commandBus, AgenciaQuery $agenciaQuery)
    {
        $this->commandBus = $commandBus;
        $this->agenciaQuery = $agenciaQuery;
    }

    /**
     * @Route("/agencia", name="agencia")
     */
    public function index()
    {
        return $this->render('agencia/index.html.twig');
    }

    /**
     * @Route("/agencia/listar", name="agencia_listar")
     */
    public function listar()
    {
        return $this->render('agencia/listar.html.twig', [
            'agencias' => $this->agenciaQuery->listar()
        ]);
    }

    /**
     * @Route("/agencia/registrar", name="agencia_registrar")
     */
    public function registrar(Request $request)
    {
        $command = new RegistrarAgenciaCommand(
            Uuid::uuid4()->toString(), 
            $request->get('cgc'), 
            $request->get('nome')
        );
        
        $this->commandBus->handle($command);

        return $this->redirectToRoute('agencia');
    }
}
