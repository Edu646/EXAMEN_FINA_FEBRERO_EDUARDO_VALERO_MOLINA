<?php 
namespace Services;

use Repositories\MedicoRepository;
use Models\Producto;
use \PDO;

class MedicoService {
    private $MedicoRepository;
   
    public function __construct(MedicoRepository $MedicoRepository)
    {
        $this->MedicoRepository = $MedicoRepository;
    }

    public function getAllMedicos()
    {
        return $this->MedicoRepository->findAll();
    }


    

}    