<?php

class Category{

    private $error_msg = "";

    function valid($data, $file)
    {
        $id = $data['id'];
        $title = $data['title'];
        $picture = $file['picture'];


        $targetDir = "uploads/" . $id . "/" . $title . "/";
        $fileName = basename($picture["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        if (empty($title)) {
            $this->error_msg = "title can't be empty";
            return $this->error_msg;
        }

        if (empty($fileName)) {
            $this->error_msg = "Please choose a picture";
            return $this->error_msg;
        }

        $allowTypes = array('jpg', 'png', 'jpeg');
        if (!in_array($fileType, $allowTypes)) {
            $this->error_msg = 'Sorry, only JPG, JPEG, PNG, files are allowed to upload.';
            return $this->error_msg;
        }
    }

    function addCategory($data, $file)
    {
        $error = $this->valid($data, $file);

        
        if (empty($error)) {
            $id = $data['id'];
            $title = $data['title'];
            $des = $data['description'];
            $description = trim($des);
            $picture = $file['picture'];

            if (isset($data["submit"])) {
                $db = new Database();
                $con = $db->connect_db();


                $targetDir = "uploads/";
                $fileName = basename($picture["name"]);
                $filename_without_ext = pathinfo($fileName, PATHINFO_FILENAME);
                $uniquesavename = time() . uniqid(rand());
                $targetFilePath = $targetDir . $filename_without_ext . $title . $uniquesavename . ".jpg";

                

                try {
                    $query = "INSERT INTO category (title,description,photo)
                    VALUES ('$title','$description','$targetFilePath')";



                    if ($db->save($query) == true) {
                        move_uploaded_file($picture["tmp_name"], $targetFilePath);
                    } else {
                        $error = "Something went wrong";
                        return $error;
                    }
                    header("location: admin_dashboard.php");
                } catch (mysqli_sql_exception $e) {
                    var_dump($e);
                    exit;
                }
            } else {
                $error = "Something went wrong";
                return $error;
            }
        } else {
            echo $error;
            return $error;
        }
    }



    function getAllCategories()
    {
        $db = new Database();
        $con = $db->connect_db();

        $query = "SELECT * FROM category";
        $result = mysqli_query($con, $query);
        return $result;
    }

    public function findCategoryById($id){
        $db = new Database();
        $con = $db->connect_db();

        $query = "SELECT * FROM category WHERE id='$id'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            return $row;
        } else {
            return null;
        }
    }

}
