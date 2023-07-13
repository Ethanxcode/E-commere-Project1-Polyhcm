<?php

use function PHPSTORM_META\type;

$filepath = realpath(dirname(__FILE__));

include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>
<?php
class customer
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_Customer($data, $files)
    {
        $fullname = htmlspecialchars($data['fullName']);
        $phoneNumber = htmlspecialchars($data['phoneNumber']);
        $username = htmlspecialchars($data['username']);
        $password = md5(htmlspecialchars($data['password']));
        $email = htmlspecialchars($data['email']);

        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];


        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploads_dir = realpath(dirname(__FILE__)) . '/../admin/uploads/';
        $uploaded_image = $uploads_dir . $unique_image;



        if (empty($fullname) || empty($phoneNumber) || empty($username) || empty($password) || empty($email)) {
            $alert = "<h5 class='text-danger'>Vui lòng điền đầy đủ thông!</h5>";
            return $alert;
        } else {
            $check_username = "SELECT * FROM tbl_customer WHERE username ='$username' LIMIT 1";
            $result_check = $this->db->select($check_username);
            if ($result_check) {
                $alert = "<h5 class='text-danger'>Tên đăng nhập đã tồn tại</h5>";
                return $alert;
            }
            if (!empty($file_name)) {
                if ($file_size > 3000000) {
                    $alert = "<span class='success'>file vượt quá dung lượng (3mb)</span>";
                    return $alert;
                }
                if (!in_array($file_ext, $permited)) {
                    echo $alert = "<span class='success'>file không hợp lệ</span>";
                    return $alert;
                }
                $userImage = $unique_image;
                move_uploaded_file($file_temp, $uploaded_image);
            } else {
                $userImage = 'faceIcon.jpg';
            }
            $query = "INSERT INTO tbl_customer (fullName, phoneNumber, username, password, email, userImage) 
            VALUES ('$fullname', '$phoneNumber', '$username', '$password', '$email', '$userImage')";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = '
            <div class="alert alert-success" role="alert">
            Đăng ký thành công , bạn sẽ được chuyển hướng đến trang đăng nhập sau 3 giây
            </div>
            <script>
                setTimeout(function() {
                    window.location.href = "profile.php";
                }, 3000);
            </script>
        ';
                return $alert;
            } else {
                $alert = '
                    <div class="alert alert-danger" role="alert">
                    Đăng ký thất bại  
                    </div>
                    ';
                return $alert;
            }
        }
    }


    public function login_Customer($data)
    {
        $username = htmlspecialchars($data['username']);
        $password = md5(htmlspecialchars($data['password']));
        if ($username == "" || $password == "") {
            $alert = "<h5 class='text-danger'>Vui lòng điền đầy đủ thông!</h5>";
            return $alert;
        } else {
            $check_username = "SELECT * FROM tbl_customer WHERE username ='$username' AND password ='$password'";
            $result_check = $this->db->select($check_username);
            if ($result_check != false) {
                $value = $result_check;
                Session::set('customer_login', true);
                Session::set('customer_id', $value[0]['id']);
                Session::set('customer_name', $value[0]['fullName']);
                header('Location:index.php');
            } else {
                $alert = "<h5 class='text-danger'>Tên đăng nhập hoặc mật khẩu không đúng</h5>";
                return $alert;
            }
        }
    }
    public function shows_customer($id)
    {
        $query = "SELECT * FROM tbl_customer WHERE id ='$id' LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_profile($data, $file, $id)
    {
        $oldUserImage = htmlspecialchars($data['userImage']);
        $fullname = htmlspecialchars($data['fullName']);
        $phoneNumber = htmlspecialchars($data['phoneNumber']);
        $username = htmlspecialchars($data['username']);
        // $password = md5(htmlspecialchars($data['password']));
        $email = htmlspecialchars($data['email']);


        if (isset($file['userImage']) && $file['userImage']['error'] === UPLOAD_ERR_OK) {

            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['userImage']['name'];
            $file_size = $_FILES['userImage']['size'];
            $file_temp = $_FILES['userImage']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
            $uploads_dir = realpath(dirname(__FILE__)) . '/../admin/uploads/';
            $uploaded_image = $uploads_dir . $unique_image;

            if ($file_size > 3000000) {
                $alert = "<div class='alert alert-danger'>File vượt quá dung lượng (3mb).</div>";
                return $alert;
            }
            if (!in_array($file_ext, $permited)) {
                $alert = "<div class='alert alert-danger'>File không hợp lệ.</div>";
                return $alert;
            }
            if (!move_uploaded_file($file_temp, $uploaded_image)) {
                $alert = "<div class='alert alert-danger'>Không thể tải lên tệp tin.</div>";
                return $alert;
            }
            // Xóa tệp tin cũ nếu nó tồn tại
            if (!empty($oldUserImage) && file_exists($uploads_dir . $oldUserImage)) {
                unlink($uploads_dir . $oldUserImage);
            }
            $userImage = $unique_image;
            move_uploaded_file($file_temp, $uploaded_image);
        } else {
            $userImage = $oldUserImage;
        }
        $query = "UPDATE tbl_customer SET 
            fullName = '$fullname',
            phoneNumber = '$phoneNumber',
            username = '$username',
            email = '$email',
            userImage = '$userImage'
            WHERE id = '$id'";
        $result = $this->db->update($query);
        if ($result) {
            Session::set('customer_login', true);
            Session::set('customer_id', $id);
            Session::set('customer_name', $fullname);
            // header('Location:profile.php');
            $alert = '
                <div class="alert alert-success" role="alert">
                Cập nhật thành công, bạn sẽ được chuyển hướng về trang chủ sau 3 giây
                </div>
                <script>
                    setTimeout(function() {
                        window.location.href = "profile.php";
                    }, 3000);
                </script>
            ';
            return $alert;
        } else {
            $alert = '
                <div class="alert alert-success" role="alert">
                Cập nhật không thành công!!
                ';
            return $alert;
        }
    }
    public function change_password($id, $data)
    {
        // Kiểm tra dữ liệu rỗng
        $oldPassword = htmlspecialchars($data['oldPassword']);
        $newPassword = htmlspecialchars($data['newPassword']);
        $confirmPassword = htmlspecialchars($data['confirmPassword']);

        if (empty($oldPassword) || empty($newPassword) || empty($confirmPassword)) {
            $alert = '
            <div class="alert alert-danger" role="alert">
                Vui lòng điền đầy đủ thông tin mật khẩu!
            </div>
        ';
            return $alert;
        }

        // Kiểm tra mật khẩu cũ có khớp với mật khẩu trong CSDL không
        $query = "SELECT password FROM tbl_customer WHERE id = '$id'";
        $result = $this->db->select($query);

        if ($result) {
            $storedPassword = $result[0]['password'];

            if (md5($oldPassword) === $storedPassword) {
                // Mật khẩu cũ khớp, kiểm tra mật khẩu mới và xác nhận mật khẩu
                if ($newPassword === $confirmPassword) {
                    $newPasswordHash = md5($newPassword); // Mã hóa mật khẩu mới

                    // Thực hiện cập nhật mật khẩu mới
                    $query = "UPDATE tbl_customer SET password = '$newPasswordHash' WHERE id = '$id'";
                    $updateResult = $this->db->update($query);

                    if ($updateResult) {
                        $alert = '
                        <div class="alert alert-success" role="alert">
                            Cập nhật thành công, bạn sẽ được chuyển hướng về trang chủ sau 3 giây.
                        </div>
                        <script>
                            setTimeout(function() {
                                window.location.href = "profile.php";
                            }, 3000);
                        </script>
                    ';
                        return $alert;
                    } else {
                        $alert = '
                        <div class="alert alert-danger" role="alert">
                            Cập nhật không thành công, lỗi khi cập nhật mật khẩu mới!
                        </div>
                    ';
                        return $alert;
                    }
                } else {
                    $alert = '
                    <div class="alert alert-danger" role="alert">
                        Cập nhật không thành công, mật khẩu mới và xác nhận mật khẩu không khớp!
                    </div>
                ';
                    return $alert;
                }
            } else {
                $alert = '
                <div class="alert alert-danger" role="alert">
                    Cập nhật không thành công, mật khẩu cũ không khớp!
                </div>
            ';
                return $alert;
            }
        } else {
            $alert = '
            <div class="alert alert-danger" role="alert">
                Cập nhật không thành công, người dùng không tồn tại!
            </div>
        ';
            return $alert;
        }
    }

    public function deleteUser($id)
    {
        $query = "DELETE FROM tbl_customer WHERE catId = '$id' ";
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





?>