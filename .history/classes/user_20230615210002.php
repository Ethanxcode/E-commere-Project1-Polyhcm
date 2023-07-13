<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>
<?php
class user
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function show_customer()
    {
        $query = "SELECT * FROM tbl_customer ORDER BY id desc ";
        $result = $this->db->select($query);
        return $result;
    }
    public function showCustomerById($id)
    {
        $query = "SELECT * FROM tbl_customer WHERE id = " . $id . " ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }
    public function show_index()
    {
        $query = "SELECT * FROM tbl_product WHERE sales > 0";
        $result = $this->db->select($query);
        return $result;
    }
    public function getOrderTypeCount()
    {
        $query = "SELECT COUNT(*) AS count FROM tbl_order WHERE status = 0";
        $result = $this->db->select($query);

        if ($result && isset($result[0]['count'])) {
            return (int) $result[0]['count'];
        }

        return 0;
    }

    public function calculateTotalSales()
    {
        $query = "SELECT SUM(sales) AS totalSales FROM tbl_product";
        $result = $this->db->select($query);

        if ($result && isset($result[0]['totalSales'])) {
            return (int) $result[0]['totalSales'];
        }

        return 0;
    }

    public function calculateTotalRevenue()
    {
        $query = "SELECT SUM(p.sales * p.price) AS totalRevenue
              FROM tbl_product AS p
              WHERE p.sales > 0";
        $result = $this->db->select($query);

        if ($result && isset($result[0]['totalRevenue'])) {
            return (float) $result[0]['totalRevenue'];
        }

        return 0;
    }

    public function delete_category($id)
    {
        $query = "DELETE FROM tbl_category WHERE catId = '$id' ";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = '
            <div class="alert alert-success" role="alert">
            Cập nhật thành công 
            </div>
            ';
            return $alert;
        } else {
            $alert = '
            <div class="alert alert-danger" role="alert">
            Cập nhật thất bại  
            </div>
            ';
            return $alert;
        }
    }
}
}





?>