<?php

require 'lib/database.php';

new Image;


class Image
{
    private $db;
    private $data;
    function __construct()
    {
        $this->db = Database::getInstance();

        if (isset($_GET['q'])) {
            $this->getImages();
        } else if (isset($_FILES['fileToUpload'])) {
            $this->insertImage();
        } else if (isset($_POST['primary'])) {
            $this->update();
        } else {
            $this->deleteImage();
        }
    }
    function insertImage()
    {
        //the actual name of the file
        $file_name = $_FILES['fileToUpload']['name'];
        //The directory/folder where we want to upload the file
        $target_directory = "assets/images/";
        //concatenate folder and file name
        $target_file = $target_directory . basename($file_name);
        //create a boolean value to determine if we are ok to upload
        $canUpload = 1;

        //get the file name extension
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        //check if the file exists
        if (file_exists($target_file)) {
            echo 'THe image already exists';
            $canUpload = 0;
        }
        //
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $canUpload = 0;
        }

        if ($canUpload == 0) {
            die("The file was not uploaded");
        } else {
            move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file);
            echo 'The file ' . $file_name . ' has been uploaded';
        }
        $caption = $_POST['caption'];
        $slider = (isset($_POST['slider'])) ? 'slider' : NULL;

        $sql = "INSERT INTO images(name, caption, location) VALUES(:name, :caption, :location)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':name', $file_name);
        $stmt->bindParam(':caption', $caption);
        $stmt->bindParam(':location', $slider);

        try {
            $stmt->execute();
            header('Location: ' . URLROOT . '/dashboard.php');
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['message' => $e->getMessage(), 'code' => http_response_code()]);
        }
    }
    function update()
    {
        $sql = 'UPDATE images SET caption=:caption, location=:slider WHERE id=:id';

        $slider = (isset($_POST['slider'])) ? 'slider' : null;
        $caption = filter_input(INPUT_POST, 'caption');
        $id = filter_input(INPUT_POST, 'primary');

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':caption', $caption);
        $stmt->bindParam(':slider', $slider);
        $stmt->bindParam(':id', $id);

        try {
            $stmt->execute();
            http_response_code(202);
            header('Location: ' . URLROOT . '/dashboard.php');
        } catch (\Throwable $th) {
            die($th->getMessage());
        }
    }
    function deleteImage()
    {
        $data = json_decode(file_get_contents('php://input'));

        //get the file name inorder to delete it
        $name_sql = "SELECT name from images WHERE id = :id";
        $stmt1 = $this->db->prepare($name_sql);
        $image_name = null;

        try {
            $stmt1->execute(array(':id'=>$data->primary));
            $image = $stmt1->fetchObject();
            $image_name = $image->name;
        } catch (\Throwable $th) {
            die($th->getMessage());
        }
        //delete the file
        if (unlink(__DIR__ . '/assets/images/' . $image_name)) {
            $sql = 'DELETE FROM images WHERE id=:id';

            $stmt = $this->db->prepare($sql);

            try {
                $stmt->execute(array(':id' => $data->primary));
                http_response_code(301);
                echo json_encode(array('message'=>'deleted', 'code'=>http_response_code()));
            } catch (\Throwable $th) {
                die($th->getMessage());
            }
        }
    }
    function getImages()
    {
        $sql = "SELECT * FROM images ORDER BY timestamp DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        echo json_encode(['images' => $stmt->fetchAll(PDO::FETCH_OBJ)]);
    }

    function slider()
    {
    }
}
