<?php


class Admin
{


    function is_admin($id)
    {
        $db = new Database();
        $con = $db->connect_db();
        $query = "SELECT * FROM user WHERE id='$id'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            $is_admin = $row['is_admin'];
            if ($is_admin == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    public function findTotalUser()
    {
        $db = new Database();
        $con = $db->connect_db();
        $query = "SELECT COUNT(id) as total_user FROM user";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            return $row['total_user'];
        } else {
            echo "NO USER";
        }
    }


    public function findTotalProducts()
    {
        $db = new Database();
        $con = $db->connect_db();
        $query = "SELECT COUNT(id) as total_course FROM product ";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            return $row['total_course'];
        } else {
            echo "NO USER";
        }
    }



    public function findTotalRevenue()
    {
        $db = new Database();
        $con = $db->connect_db();
        $query = "SELECT SUM(p.price) as total
                    FROM `product_order`
                    JOIN product as p
                    on product_order.product_id = p.id ";

        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            return $row['total'];
        } else {
            return 0;
        }
    }
}
