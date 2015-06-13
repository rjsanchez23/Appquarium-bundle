<?php


namespace AppquariumBundle\Aquarium\Library;


use Exception;

class Upload {

    private $name;
    private $tmp_name;
    private $type;
    private $size;
    private $error;
    private $uploadPath;
    private $imageNameHasher;

    public function __construct(ImageNameHasherInterface $imageNameHasher){

        $this->imageNameHasher = $imageNameHasher;
    }
    public function __invoke(Array $file, $uploadPath)
    {
        $this->name = $this->imageNameHasher->hash($file["name"]);
        $this->tmp_name = $file["tmp_name"];
        $this->type = $file["type"];
        $this->size = $file["size"];
        $this->error = $file["error"];
        $this->uploadPath = $uploadPath;
    }

    public function upload(Array $file, $uploadDir = null){

        if(is_null($uploadDir)){
            $uploadDir = mkdir("uploads/", 0700);
        }
        $this->__invoke($file, $uploadDir);
        $full_path = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . $this->uploadPath . $this->name;
        $status = move_uploaded_file($this->tmp_name, $full_path);

        if (!$status) {
            throw new Exception('Upload: No ha sido posible subir la imagen.');
        }
        return $this->name;

    }

}