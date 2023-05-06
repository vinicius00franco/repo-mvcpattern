<?php 

namespace Alura\Mvc\Repository;

use Alura\Mvc\Entity\Video;
use PDO;

class VideoRepository
{

    public function __construct
    (
        private PDO $pdo
    )
    {
        
    }

    public function add(Video $video):bool
    {
        $sql = "INSERT INTO videos (url, titulo) VALUES (?,?)";
        $statement = $this->pdo->prepare($sql);

        $statement->bindValue(1,$video->url);
        $statement->bindValue(2,$video->titulo);

        $result = $statement->execute();

        $id = $this->pdo->lastInsertId();

        $video->setID(intval($id));
        return $result;
    }

    public function remove(int $id):bool
    {
        $sql = "DELETE FROM videos WHERE id=?;";

        $statement = $this->pdo->prepare($sql);

        $statement->bindValue(1,$id);

        return $statement->execute();
    }

    public function update(Video $video):bool
    {
        $sql = "UPDATE videos SET url = :url, titulo =:titulo WHERE id=:id;";

        $statement = $this->pdo->prepare($sql);

        $statement->bindValue(':url',$video->url);
        $statement->bindValue(':titulo',$video->titulo);
        $statement->bindValue(':id',$video->id, PDO::PARAM_INT);

        return $statement->execute();
    }

    /**
     * @return Video[]
     */
    public function all(): array
    {

        $videoList = $this->pdo
            ->query('SELECT * FROM videos;')
            ->fetchAll(PDO::FETCH_ASSOC);

        return array_map(
            $this->hidrateVideo(...),         
            $videoList
        );
   }

   public function find($id)
   {
       $statement = $this->pdo->prepare('SELECT  * FROM videos WHERE id = :id;');
       $statement->bindValue(':id',$id,PDO::PARAM_INT);
       $statement->execute();

       $videoData = $statement->fetch(PDO::FETCH_ASSOC);

       return $this->hidrateVideo($videoData);
   }

   public function hidrateVideo($videoData)
   {
        $video = new Video($videoData['url'], $videoData['titulo']);
        $video->setId($videoData['id']);

        return $video;
   }
}