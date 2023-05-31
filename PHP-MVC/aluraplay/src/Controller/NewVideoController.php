<?php 

namespace Alura\Mvc\Controller;

use Alura\Mvc\Entity\Video;
use Alura\Mvc\Repository\VideoRepository;
use PDO;

class NewVideoController implements Controller
{
    
    public function __construct(private VideoRepository $videoRepository)
    {     
    }

    
    public function processaRequisicao(): void
    {
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

        if ($this->videoRepository->add($video) === false){
            header('location: /?sucesso=0');
        } else {
            header('location: /?sucesso=1');
        }
    }
}