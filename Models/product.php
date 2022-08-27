<?php


class Product
{
    function valid($data, $file)
    {
        $id = $data['id'];
        $title = $data['title'];
        $picture = $file['picture'];
        $price = $data['price'];
        $quantity = $data['quantity'];


        $targetDir = "uploads/" . $id . "/" . $title . "/";
        $fileName = basename($picture["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        if (empty($title)) {
            $this->error_msg = "title can't be empty";
            return $this->error_msg;
        }

        if (!isset($data['category'])) {
            $this->error_msg = "Please select a Category";
            return $this->error_msg;
        }

        if (empty($price)) {
            $this->error_msg = "Price can't be empty";
            return $this->error_msg;
        }


        if (empty($quantity)) {
            $this->error_msg = "Quantity can't be empty";
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

    function addProduct($data, $file)
    {
        $error = $this->valid($data, $file);


        if (empty($error)) {
            $id = $data['id'];
            $title = $data['title'];
            $des = $data['description'];
            $description = trim($des);
            $category = $data['category'];
            $price = $data['price'];
            $quantity = $data['quantity'];
            $picture = $file['picture'];

            if (isset($data["submit"])) {
                $db = new Database();
                $con = $db->connect_db();


                $targetDir = "uploads_product/";
                $fileName = basename($picture["name"]);
                $filename_without_ext = pathinfo($fileName, PATHINFO_FILENAME);
                $uniquesavename = time() . uniqid(rand());
                $targetFilePath = $targetDir . $filename_without_ext . $title . $uniquesavename . ".jpg";



                try {
                    $query = "INSERT INTO product (name,description,category_id,price,quantity,photo)
                    VALUES ('$title','$description',$category,$price,$quantity,'$targetFilePath')";



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


    public function findProductById($id)
    {
        $db = new Database();
        $con = $db->connect_db();

        $query = "SELECT * FROM product WHERE id='$id'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            return $row;
        } else {
            return null;
        }
    }

    public function updateProduct($data)
    {

        $db = new Database();
        $con = $db->connect_db();

        $product_id = $data['product_id'];
        $title = $data['title'];
        $des = $data['description'];
        $description = trim($des);
        $category = $data['category'];
        $price = $data['price'];
        $quantity = $data['quantity'];

        if (isset($data["submit"])) {
            $db = new Database();
            $con = $db->connect_db();

            try {
                $query = "UPDATE product SET name = '$title',description = '$description',category_id='$category',price= '$price', quantity='$quantity' WHERE id = $product_id";

                if ($db->save($query) == true) {
                    header("location: admin_products.php");
                }
            } catch (mysqli_sql_exception $e) {
                var_dump($e);
                exit;
            }
        } else {
            echo "Error Rise While Update";
        }
    }



    public function unlinkFile($id)
    {
        $db = new Database();
        $con = $db->connect_db();
        $query = "SELECT * FROM product WHERE id='$id'";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            unlink($row['photo']);
        }
    }

    public function deleteProduct($id)
    {
        $db = new Database();
        $con = $db->connect_db();
        $this->unlinkFile($id);
        $query = "DELETE FROM product WHERE id='$id'";
        $result = mysqli_query($con, $query);
        if ($result) {
            header("location: admin_products.php");
        }
    }
}
