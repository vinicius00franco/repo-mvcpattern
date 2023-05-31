<?php 

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;
use PDO;

class EditVideoController implements Controller
{
    
    public function __construct(private VideoRepository $videoRepository)
    {     
    }

    
    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);
        if ($id === false || $id === null){
            header('location: /?sucesso=0');
            return;
        }

        $url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
        if ($url === false){
            header('location: /?sucesso=0');
            return;
        }

        $titulo = filter_input(INPUT_POST, 'titulo');
        if ($titulo === false){
            header('location: /?sucesso=0');
            return;
        }
        $video = new Video($url,$titulo);
        $video->setId($id);


        if ($this->videoRepository->update($video) === false){
            header('location: /?sucesso=0');
        } else {
            header('location: /?sucesso=1');
        }
    }
}