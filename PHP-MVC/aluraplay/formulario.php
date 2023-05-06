<?php


$dbpath = __DIR__ . "/banco.sqlite";
$pdo = new PDO("sqlite:$dbpath");

// trazer o id 
//verificar id diferente de false
    //statmente = entao, faço meu prepare no select 
    //bindvalue no meu statement
    // trago o dado selecionado com statement->fetch()
// colocar video padrao em braco caso acontecça algum erro 

$id = filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);

$video = [
    'url' => '',
    'titulo' => ''
];

if ($id !== false && $id !== null){
    $statement = $pdo->prepare('SELECT * FROM videos WHERE id = ?;');
    $statement->bindValue(1,$id, PDO::PARAM_INT);

    $statement->execute();

    $video = $statement->fetch(\PDO::FETCH_ASSOC);
}


var_dump($video['url']);
var_dump($video['titulo']);


?>
<?php require_once 'inicio-html.php'; ?>

    <main class="container">

        <form class="container__formulario"
            method="post">
            <h2 class="formulario__titulo">Envie um vídeo!</h2>
                <div class="formulario__campo">
                    <label class="campo__etiqueta" for="url">Link embed</label>
                    <input name="url"
                    value = "<?= $video['url']; ?>"
                     class="campo__escrita" 
                     required
                     placeholder="Por exemplo: https://www.youtube.com/embed/FAY1K2aUg5g" 
                     id='url' />
                </div>


                <div class="formulario__campo">
                    <label class="campo__etiqueta" for="titulo">Titulo do vídeo</label>
                    <!-- add o valor que desejo editar -->
                    <input name="titulo" 
                    value = "<?= $video['titulo']; ?>"
                    class="campo__escrita" 
                    required 
                    placeholder="Neste campo, dê o nome do vídeo"
                    id='titulo' />
                </div>

                <input class="formulario__botao" type="submit" value="Enviar" />
        </form>

    </main>
<?php require_once 'fim-html.php'; ?>