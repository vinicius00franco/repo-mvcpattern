<?php

use Alura\Mvc\Repository\VideoRepository;

$dbpath = __DIR__ . "/banco.sqlite";
$pdo = new PDO("sqlite:$dbpath");

$repository = new VideoRepository($pdo);
$videoList = $repository->all();

var_dump($videoList);

var_dump($videoList['url']);
var_dump($videoList['titulo']);

require_once 'inicio-html.php'; ?>

    <ul class="videos__container" alt="videos alura">
        <?php foreach ($videoList as $video): ?>
            <?php if (!str_starts_with($video->url,'http')) {
                $video->url = "";
            }?>    
            <li class="videos__item">
                <iframe width="100%" height="72%" src="<?= $video->url; ?>"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
                <div class="descricao-video">
                    <img src="./img/logo.png" alt="logo canal alura">
                    <h3><?= $video->titulo ?></h3>
                    <div class="acoes-video">
                        <a href="/editar-video?id=<?= $video->id; ?>">Editar</a>
                        <a href="/remover-video?id=<?= $video->id; ?>">Excluir</a>
                    </div>
                </div>
            </li>
                
        <?php endforeach; ?>
    </ul>
<?php require_once 'fim-html.php'; ?>