<?php

class User
{


    function generate_uuid()
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0C2f) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0x2Aff),
            mt_rand(0, 0xffD3),
            mt_rand(0, 0xff4B)
        );
    }

    public function valid($data)
    {
        $error = "";
        $email = $data['email'];
        $password = $data['password'];

        $db = new Database();
        $con = $db->connect_db();
        $query = "SELECT * FROM user WHERE email = '$email'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            $error = "Account already exists with this email";
            return $error;
        }

        if (strlen($password) < 6) {
            $error = "Password must be at least 6 digits";
            return $error;
        }
    }

    public function createUser($data)
    {

        $error_msg = $this->valid($data);

        if ($error_msg == "") {

            $first_name = $data['first_name'];
            $last_name = $data['last_name'];
            $email = $data['email'];
            $phone = $data['phone'];
            $street = $data['street'];
            $city = $data['city'];
            $zip = $data['zip'];
            $country = $data['country'];
            $is_admin = false;
            $password = $data['password'];
            $profile_pic = "images/default.png";
            $hash_password = sha1($password);
            $query = "INSERT into user (first_name,last_name,email,password,phone,street,city,zip_code,country,is_admin,profile_pic) 
                values('$first_name','$last_name','$email','$hash_password','$phone','$street','$city','$zip','$country','$is_admin','$profile_pic')";
            $db = new Database();
            $db->save($query);
            $success_msg = "success";
            return $success_msg;
        } else {
            return $error_msg;
        }
    }



    public function loginUser($data)
    {

        $db = new Database();
        $con = $db->connect_db();
        $email = $data['email'];
        $password = $data['password'];
        $hash_password = sha1($password);
        $query = "SELECT * FROM user WHERE email='$email'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);

            // print_r($row);
            $password = $row['password'];
            if ($password == $hash_password) {
                $login = true;
                $user_id = $row['id'];
                session_start();
                $_SESSION['USERID'] = $user_id;
                $_SESSION['LOGGEDIN'] = true;
                $query1 = "UPDATE user SET 	is_loggedin = 1 WHERE id = $user_id";
                $db->save($query1);
                header("location: index.php");
            } else {
                $this->error = "Login Failed: Your email or password is incorrect";
                return $this->error;
            }
        } else {
            $this->error = "Login Failed: Your email or password is incorrect";
            return $this->error;
        }
    }


    public function findUserByUserId($id)
    {
        $db = new Database();
        $con = $db->connect_db();
        $query = "SELECT * FROM user WHERE id='$id'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        } else {
            return null;
        }
    }

    public function checkIFAdmin($id)
    {
        $db = new Database();
        $con = $db->connect_db();
        $query = "SELECT * FROM user WHERE id='$id'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['is_admin'] == 1) {
                return true;
            }
        }
    }

    public function checkIfProductBoughtByUser($product_id, $user_id)
    {
        $db = new Database();
        $con = $db->connect_db();

        $query = "SELECT * FROM product_order WHERE user_id='$user_id' AND product_id='$product_id'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function buyProduct($data, $product_id, $user_id)
    {
        $street = $data['street'];
        $city = $data['city'];
        $zip = $data['zip'];
        $country = $data['country'];

        $db = new Database();
        $con = $db->connect_db();

        $transaction_id = $this->generate_uuid();

        $query = "INSERT INTO product_order ( user_id, product_id, transaction_id, street, city, zip, country)
            VALUES ('$user_id','$product_id','$transaction_id','$street','$city','$zip','$country')";
        $result = mysqli_query($con, $query);

        if ($result) {
            try {
                $query = "UPDATE product 
                            SET quantity=quantity-1
                            WHERE id = '$product_id';";
                $result = mysqli_query($con, $query);

                if ($result) {
                    header("location: my_orders.php");
                }
            } catch (mysqli_sql_exception $e) {
                var_dump($e);
                exit;
            }
        }
    }
}
