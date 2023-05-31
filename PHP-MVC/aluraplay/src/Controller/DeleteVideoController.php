<?php 

namespace Alura\Mvc\Controller;

use Alura\Mvc\Repository\VideoRepository;
use PDO;

class DeleteVideoController implements Controller
{
    
    public function __construct(private VideoRepository $videoRepository)
    {     
    }

    
    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);
        if ($id === false || $id === null){
            header('location: /?sucesso=0');
            exit();
        }

        if ($this->videoRepository->remove($id) === false){
            header('location: /?sucesso=0');
        } else {
            header('location: /?sucesso=1');
        }
    }
}