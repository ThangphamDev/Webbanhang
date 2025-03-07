<?php
// Require necessary files
require_once 'app/config/database.php';
require_once 'app/models/CategoryModel.php';

class CategoryController {
    private $categoryModel;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->categoryModel = new CategoryModel($this->db);
    }

    // Hiển thị danh sách danh mục (action: index)
    public function index() {
        $categories = $this->categoryModel->getCategories();
        include 'app/views/Category/list.php';
    }

    // Thêm danh mục mới (action: add)
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $errors = [];

            if (empty($name)) {
                $errors[] = "Tên danh mục không được để trống!";
            }

            if (empty($errors)) {
                if ($this->categoryModel->add($name, $description)) {
                    header("Location: /Category");
                    exit;
                } else {
                    $errors[] = "Có lỗi xảy ra khi thêm danh mục!";
                }
            }

            include 'app/views/Category/add.php';
        } else {
            include 'app/views/Category/add.php';
        }
    }

    // Sửa danh mục (action: edit)
    public function edit($id) {
        $category = $this->categoryModel->getById($id);
        if (!$category) {
            header("Location: /Category");
            exit;
        }
        include 'app/views/Category/edit.php';
    }

    // Cập nhật danh mục (action: update)
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? 0;
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $errors = [];

            if (empty($name)) {
                $errors[] = "Tên danh mục không được để trống!";
            }

            if (empty($errors)) {
                if ($this->categoryModel->update($id, $name, $description)) {
                    header("Location: /Category");
                    exit;
                } else {
                    $errors[] = "Có lỗi xảy ra khi cập nhật danh mục!";
                }
            }

            $category = (object) ['id' => $id, 'name' => $name, 'description' => $description];
            include 'app/views/Category/edit.php';
        }
    }

    // Xóa danh mục (action: delete)
    public function delete($id) {
        $this->categoryModel->delete($id);
        header("Location: /Category");
        exit;
    }
}
?>