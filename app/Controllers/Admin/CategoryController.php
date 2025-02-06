<?php
class CategoryController extends ControllerAdmin
{
    public function getAllCategory()
    {
        $categoryModel = new CategoryModel();
        $listCategory = $categoryModel->allCategory();
        include 'app/Views/Admin/categories.php';
    }

    public function addCategory()
    {
        include 'app/Views/Admin/add-category.php';
    }

    public function addPostCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!$this->checkValidate()) {
                header("Location: ?role=admin&act=add-category");
                exit;
            }

            $uploadDir = 'assets/Admin/upload/';
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $destPath = null;

            if (!empty($_FILES['image']['name'])) {
                $destPath = $this->uploadImage($_FILES['image'], $uploadDir, $allowedTypes);
            }

            $categoryModel = new CategoryModel();
            $isAdded = $categoryModel->addCategory($destPath);

            $_SESSION['message'] = $isAdded ? 'Thêm mới thành công' : 'Thêm mới không thành công';
            header("Location: ?role=admin&act=all-category");
            exit;
        }
    }

    public function checkValidate()
    {
        $name = $_POST['name'] ?? '';
        if (trim($name) !== '') {
            return true;
        } else {
            $_SESSION['error'] = "Bạn nhập thiếu thông tin";
            return false;
        }
    }

    public function deleteCategory()
    {
        if (!isset($_GET['id'])) {
            $_SESSION['message'] = 'Chọn danh mục cần xóa';
            header("Location: ?role=admin&act=all-category");
            exit;
        }

        $categoryModel = new CategoryModel();
        $category = $categoryModel->getCategoryByID($_GET['id']);

        if ($category) {
            if (!empty($category->image)) {
                unlink($category->image); // Xóa ảnh nếu tồn tại
            }
            $message = $categoryModel->deleteCategory($_GET['id']);
            $_SESSION['message'] = $message ? 'Xóa thành công' : 'Xóa không thành công';
        } else {
            $_SESSION['message'] = 'Danh mục không tồn tại';
        }

        header("Location: ?role=admin&act=all-category");
        exit;
    }

    public function updateCategory()
    {
        if (!isset($_GET['id'])) {
            $_SESSION['message'] = 'Chọn danh mục cần sửa';
            header("Location: ?role=admin&act=all-category");
            exit;
        }

        $categoryModel = new CategoryModel();
        $category = $categoryModel->getCategoryByID($_GET['id']);

        if (!$category) {
            $_SESSION['message'] = 'Danh mục không tồn tại';
            header("Location: ?role=admin&act=all-category");
            exit;
        }

        include 'app/Views/Admin/update-category.php';
    }

    public function updatePostCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_GET['id'])) {
                $_SESSION['message'] = 'Chọn danh mục cần sửa';
                header("Location: ?role=admin&act=all-category");
                exit;
            }

            if (!$this->checkValidate()) {
                header("Location: ?role=admin&act=update-category&id=" . $_GET['id']);
                exit;
            }

            $uploadDir = 'assets/Admin/upload/';
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $destPath = null;

            if (!empty($_FILES['image']['name'])) {
                $destPath = $this->uploadImage($_FILES['image'], $uploadDir, $allowedTypes);
            }

            $categoryModel = new CategoryModel();
            $message = $categoryModel->updateCategoryToDB($_GET['id'], $destPath);

            $_SESSION['message'] = $message ? 'Chỉnh sửa thành công' : 'Chỉnh sửa không thành công';
            header("Location: ?role=admin&act=all-category");
            exit;
        }
    }

    private function uploadImage($file, $uploadDir, $allowedTypes)
    {
        if (!in_array($file['type'], $allowedTypes)) {
            $_SESSION['error'] = 'File không đúng định dạng (chỉ chấp nhận JPEG, PNG, GIF)';
            return null;
        }

        $fileName = uniqid() . '_' . basename($file['name']);
        $destPath = $uploadDir . $fileName;

        if (!move_uploaded_file($file['tmp_name'], $destPath)) {
            $_SESSION['error'] = 'Không thể tải lên tệp';
            return null;
        }

        return $destPath;
    }
}
?>
