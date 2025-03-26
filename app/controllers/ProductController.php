<?php
require_once('app/config/database.php');
require_once('app/models/ProductModel.php');
require_once('app/models/CategoryModel.php');

class ProductController 
{
    private $productModel;
    private $db;

    public function __construct() 
    {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
    }

    
    public function filter() 
    {
        // Get filter parameters from GET request
        $category_id = isset($_GET['category']) ? $_GET['category'] : null;
        $min_price = isset($_GET['min_price']) ? (float)$_GET['min_price'] : null;
        $max_price = isset($_GET['max_price']) ? (float)$_GET['max_price'] : null;
        $rating = isset($_GET['rating']) ? (int)$_GET['rating'] : null;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $products_per_page = 12; // 4 dòng x 3 cột
        
        // Lấy tổng số sản phẩm để tính số trang
        $total_count = $this->productModel->getTotalFilteredProducts($category_id, $min_price, $max_price, $rating);
        $total_pages = ceil($total_count / $products_per_page);
        
        // Đảm bảo trang hiện tại hợp lệ
        if ($page < 1) $page = 1;
        if ($page > $total_pages && $total_pages > 0) $page = $total_pages;
        
        // Get filtered products with pagination
        $products = $this->productModel->getFilteredProducts($category_id, $min_price, $max_price, $rating, $page, $products_per_page);
        
        // Get all categories for the filter sidebar
        $categoryModel = new CategoryModel($this->db);
        $categories = $categoryModel->getCategories();
        
        // Add product count to each category based on current filters
        foreach ($categories as $category) {
            $category->product_count = $this->productModel->getProductCount($category->id);
        }
        
        // Get price range for products
        $price_range = $this->productModel->getPriceRange();
        $min_product_price = $price_range->min_price ?? 0;
        $max_product_price = $price_range->max_price ?? 1000000;
        
        // Chuẩn bị thông tin phân trang
        $pagination = [
            'current_page' => $page,
            'total_pages' => $total_pages,
            'per_page' => $products_per_page,
            'total_products' => $total_count
        ];
        
        // If this is an AJAX request, return JSON
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
            header('Content-Type: application/json');
            echo json_encode([
                'products' => $products,
                'min_price' => $min_product_price,
                'max_price' => $max_product_price,
                'categories' => $categories,
                'pagination' => $pagination
            ]);
            exit;
        }
        
        // Otherwise, include the view
        include 'app/views/product/list.php';
    }

    public function search() 
    {
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $products_per_page = 12; // 4 dòng x 3 cột
        
        // Lấy tổng số sản phẩm thỏa mãn tìm kiếm
        if (!empty($keyword)) {
            $total_count = $this->productModel->getTotalSearchResults($keyword);
            $products = $this->productModel->searchProducts($keyword, $page, $products_per_page);
        } else {
            $total_count = $this->productModel->getTotalProducts();
            $products = $this->productModel->getProducts();
        }
        
        $total_pages = ceil($total_count / $products_per_page);
        
        // Đảm bảo trang hiện tại hợp lệ
        if ($page < 1) $page = 1;
        if ($page > $total_pages && $total_pages > 0) $page = $total_pages;
        
        // Get all categories for the filter sidebar
        $categoryModel = new CategoryModel($this->db);
        $categories = $categoryModel->getCategories();
        
        // Get price range for products
        $price_range = $this->productModel->getPriceRange();
        $min_product_price = $price_range->min_price ?? 0;
        $max_product_price = $price_range->max_price ?? 1000000;
        
        // Chuẩn bị thông tin phân trang
        $pagination = [
            'current_page' => $page,
            'total_pages' => $total_pages,
            'per_page' => $products_per_page,
            'total_products' => $total_count
        ];
        
        // If this is an AJAX request, return JSON
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
            header('Content-Type: application/json');
            echo json_encode([
                'products' => $products,
                'min_price' => $min_product_price,
                'max_price' => $max_product_price,
                'categories' => $categories,
                'pagination' => $pagination
            ]);
            exit;
        }
        
        // Otherwise, include the view
        include 'app/views/product/list.php';
    }

    public function sort() 
    {
        $sortBy = isset($_GET['sort']) ? $_GET['sort'] : 'popular';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $products_per_page = 12; // 4 dòng x 3 cột
        
        // Lấy tổng số sản phẩm
        $total_count = $this->productModel->getTotalProducts();
        $total_pages = ceil($total_count / $products_per_page);
        
        // Đảm bảo trang hiện tại hợp lệ
        if ($page < 1) $page = 1;
        if ($page > $total_pages && $total_pages > 0) $page = $total_pages;
        
        // Get sorted products with pagination
        $products = $this->productModel->sortProducts($sortBy, $page, $products_per_page);
        
        // Get all categories for the filter sidebar
        $categoryModel = new CategoryModel($this->db);
        $categories = $categoryModel->getCategories();
        
        // Get price range for products
        $price_range = $this->productModel->getPriceRange();
        $min_product_price = $price_range->min_price ?? 0;
        $max_product_price = $price_range->max_price ?? 1000000;
        
        // Chuẩn bị thông tin phân trang
        $pagination = [
            'current_page' => $page,
            'total_pages' => $total_pages,
            'per_page' => $products_per_page,
            'total_products' => $total_count
        ];
        
        // If this is an AJAX request, return JSON
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
            header('Content-Type: application/json');
            echo json_encode([
                'products' => $products,
                'min_price' => $min_product_price,
                'max_price' => $max_product_price,
                'categories' => $categories,
                'pagination' => $pagination
            ]);
            exit;
        }
        
        // Otherwise, include the view
        include 'app/views/product/list.php';
    }

    private function isAdmin() {
        return SessionHelper::isAdmin();
    }

    public function index() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $products_per_page = 12; // 4 dòng x 3 cột
        
        // Lấy tổng số sản phẩm
        $total_count = $this->productModel->getTotalProducts();
        $total_pages = ceil($total_count / $products_per_page);
        
        // Đảm bảo trang hiện tại hợp lệ
        if ($page < 1) $page = 1;
        if ($page > $total_pages && $total_pages > 0) $page = $total_pages;
        
        // Get all products with pagination
        $products = $this->productModel->getProducts($page, $products_per_page);
        
        // Get all categories for the filter sidebar
        $categoryModel = new CategoryModel($this->db);
        $categories = $categoryModel->getCategories();
        
        // Get price range for products
        $price_range = $this->productModel->getPriceRange();
        $min_product_price = $price_range->min_price ?? 0;
        $max_product_price = $price_range->max_price ?? 1000000;
        
        // Chuẩn bị thông tin phân trang
        $pagination = [
            'current_page' => $page,
            'total_pages' => $total_pages,
            'per_page' => $products_per_page,
            'total_products' => $total_count
        ];
        
        // Include the view
        include 'app/views/product/list.php';
    }

    public function addToCart($id) 
    {
        $product = $this->productModel->getProductById($id);
        if (!$product) {
            echo "Không tìm thấy sản phẩm.";
            return;
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity'] += 1;
        } else {
            $_SESSION['cart'][$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image,
                'category_id' => $product->category_id
            ];
        }

        header('Location: /Product');
    }

    public function cart() 
    {
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        $total = $this->calculateCartTotal($cart);
        include 'app/views/product/cart.php';
    }

    public function updateCart() 
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['quantity'])) {
                foreach ($_POST['quantity'] as $productId => $quantity) {
                    $productId = (int)$productId;
                    $quantity = (int)$quantity;

                    if (isset($_SESSION['cart'][$productId])) {
                        if ($quantity > 0) {
                            $_SESSION['cart'][$productId]['quantity'] = $quantity;
                        } else {
                            unset($_SESSION['cart'][$productId]);
                        }
                    }
                }
            } else if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
                $productId = (int)$_POST['product_id'];
                $quantity = (int)$_POST['quantity'];
                
                if (isset($_SESSION['cart'][$productId])) {
                    if ($quantity > 0) {
                        $_SESSION['cart'][$productId]['quantity'] = $quantity;
                        $subtotal = $quantity * $_SESSION['cart'][$productId]['price'];
                        $total = $this->calculateCartTotal($_SESSION['cart']);
                        
                        echo json_encode([
                            'success' => true,
                            'subtotal' => $subtotal,
                            'total' => $total,
                            'formattedSubtotal' => number_format($subtotal, 0, ',', '.') . ' ₫',
                            'formattedTotal' => number_format($total, 0, ',', '.') . ' ₫'
                        ]);
                        exit;
                    } else {
                        unset($_SESSION['cart'][$productId]);
                        $total = $this->calculateCartTotal($_SESSION['cart']);
                        echo json_encode([
                            'success' => true,
                            'removed' => true,
                            'total' => $total,
                            'formattedTotal' => number_format($total, 0, ',', '.') . ' ₫'
                        ]);
                        exit;
                    }
                }
            }
            
            if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {
                header('Location: /Product/cart');
                exit;
            }
        }
    }

    public function removeFromCart($id) 
    {
        if (isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }
        header('Location: /Product/cart');
    }

    private function calculateCartTotal($cart) 
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
 
    public function show($id) 
    { 
        $product = $this->productModel->getProductById($id); 
        if ($product) { 
            include 'app/views/product/show.php'; 
        } else { 
            echo "Không thấy sản phẩm."; 
        } 
    } 
 
    public function add() {
        if (!$this->isAdmin()) {
        echo "Bạn không có quyền truy cập chức năng này!";
        exit;
        }
        $categories = (new CategoryModel($this->db))->getCategories();
        include_once 'app/views/product/add.php';
        } 
 
        public function save() {
            if (!$this->isAdmin()) {
            echo "Bạn không có quyền truy cập chức năng này!";
            exit;
            }
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? '';
            $category_id = $_POST['category_id'] ?? null;
            $image = (isset($_FILES['image']) && $_FILES['image']['error'] == 0)
            ? $this->uploadImage($_FILES['image'])
            : "";
            $result = $this->productModel->addProduct($name, $description, $price,
            
            $category_id, $image);
            
            if (is_array($result)) {
            $errors = $result;
            $categories = (new CategoryModel($this->db))->getCategories();
            include 'app/views/product/add.php';
            } else {
            header('Location: /Product');
            }
            }
            } 
 
            public function edit($id) {
                if (!$this->isAdmin()) {
                echo "Bạn không có quyền truy cập chức năng này!";
                exit;
                }
                $product = $this->productModel->getProductById($id);
                $categories = (new CategoryModel($this->db))->getCategories();
                if ($product) {
                include 'app/views/product/edit.php';
                } else {
                echo "Không thấy sản phẩm.";
                }
                } 
 
                public function update() {
                    if (!$this->isAdmin()) {
                    echo "Bạn không có quyền truy cập chức năng này!";
                    exit;
                }
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = $_POST['id'];
                $name = $_POST['name'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category_id = $_POST['category_id'];
                $image = (isset($_FILES['image']) && $_FILES['image']['error'] == 0)
                ? $this->uploadImage($_FILES['image'])
                : $_POST['existing_image'];
                $edit = $this->productModel->updateProduct($id, $name, $description,
                
                $price, $category_id, $image);
                if ($edit) {
                header('Location: /Product');
                } else {
                echo "Đã xảy ra lỗi khi lưu sản phẩm.";
                }
                }
                } 
 
                public function delete($id) {
                    if (!$this->isAdmin()) {
                    echo "Bạn không có quyền truy cập chức năng này!";
                    exit;
                    }
                    if ($this->productModel->deleteProduct($id)) {
                    header('Location: /Product');
                    } else {
                    echo "Đã xảy ra lỗi khi xóa sản phẩm.";
                    }
                       
    } 
 
    private function uploadImage($file) 
    { 
        $target_dir = "uploads/"; 
        if (!is_dir($target_dir)) { 
            mkdir($target_dir, 0777, true); 
        } 
     
        $target_file = $target_dir . basename($file["name"]); 
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); 
     
        $check = getimagesize($file["tmp_name"]); 
        if ($check === false) { 
            throw new Exception("File không phải là hình ảnh."); 
        } 
     
        if ($file["size"] > 10 * 1024 * 1024) { 
            throw new Exception("Hình ảnh có kích thước quá lớn."); 
        } 
     
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") { 
            throw new Exception("Chỉ cho phép các định dạng JPG, JPEG, PNG và GIF."); 
        } 
     
        if (!move_uploaded_file($file["tmp_name"], $target_file)) { 
            throw new Exception("Có lỗi xảy ra khi tải lên hình ảnh."); 
        } 
     
        return $target_file; 
    } 
 
    public function checkout() 
    { 
        include 'app/views/product/checkout.php'; 
    } 
 
    public function processCheckout() 
    { 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
            $name = $_POST['name']; 
            $phone = $_POST['phone']; 
            $address = $_POST['address']; 
 
            if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) { 
                echo "Giỏ hàng trống."; 
                return; 
            } 
 
            $this->db->beginTransaction(); 
 
            try { 
                $query = "INSERT INTO orders (name, phone, address) VALUES (:name, :phone, :address)"; 
                $stmt = $this->db->prepare($query); 
                $stmt->bindParam(':name', $name); 
                $stmt->bindParam(':phone', $phone); 
                $stmt->bindParam(':address', $address); 
                $stmt->execute(); 
                $order_id = $this->db->lastInsertId(); 
 
                $cart = $_SESSION['cart']; 
                foreach ($cart as $product_id => $item) { 
                    $query = "INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)"; 
                    $stmt = $this->db->prepare($query); 
                    $stmt->bindParam(':order_id', $order_id); 
                    $stmt->bindParam(':product_id', $product_id); 
                    $stmt->bindParam(':quantity', $item['quantity']); 
                    $stmt->bindParam(':price', $item['price']); 
                    $stmt->execute(); 
                } 
 
                unset($_SESSION['cart']); 
                $this->db->commit(); 
                header('Location: /Product/orderConfirmation'); 
            } catch (Exception $e) { 
                $this->db->rollBack(); 
                echo "Đã xảy ra lỗi khi xử lý đơn hàng: " . $e->getMessage(); 
            } 
        } 
    } 
 
    public function orderConfirmation() 
    { 
        include 'app/views/product/orderConfirmation.php'; 
    }
    
    public function ajaxUpdateCart() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id']) && isset($_POST['quantity'])) {
            $productId = (int)$_POST['product_id'];
            $quantity = (int)$_POST['quantity'];
            
            $result = ['success' => false];
            
            if (isset($_SESSION['cart'][$productId])) {
                if ($quantity > 0) {
                    $_SESSION['cart'][$productId]['quantity'] = $quantity;
                    $subtotal = $quantity * $_SESSION['cart'][$productId]['price'];
                    $total = $this->calculateCartTotal($_SESSION['cart']);
                    
                    $result = [
                        'success' => true,
                        'subtotal' => $subtotal,
                        'total' => $total,
                        'formattedSubtotal' => number_format($subtotal, 0, ',', '.') . ' ₫',
                        'formattedTotal' => number_format($total, 0, ',', '.') . ' ₫'
                    ];
                } else {
                    unset($_SESSION['cart'][$productId]);
                    $total = $this->calculateCartTotal($_SESSION['cart']);
                    $result = [
                        'success' => true,
                        'removed' => true,
                        'total' => $total,
                        'formattedTotal' => number_format($total, 0, ',', '.') . ' ₫'
                    ];
                }
            }
            
            header('Content-Type: application/json');
            echo json_encode($result);
            exit;
        }
    }

    public function addToCartAjax($id) {
        $product = $this->productModel->getProductById($id);
        $response = ['success' => false, 'message' => 'Có lỗi xảy ra'];
        
        if ($product) {
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            if (isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id]['quantity'] += 1;
            } else {
                $_SESSION['cart'][$id] = [
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => 1,
                    'image' => $product->image,
                    'category_id' => $product->category_id
                ];
            }
            
            // Tính tổng số lượng sản phẩm trong giỏ hàng
            $totalQuantity = 0;
            foreach ($_SESSION['cart'] as $item) {
                $totalQuantity += $item['quantity'];
            }
            
            $response = [
                'success' => true,
                'message' => 'Đã thêm sản phẩm vào giỏ hàng',
                'cartCount' => $totalQuantity
            ];
        }
        
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    // Hàm trả về số lượng sản phẩm trong mỗi danh mục
    public function getCategoryCounts() 
    {
        // Get all categories
        $categoryModel = new CategoryModel($this->db);
        $categories = $categoryModel->getCategories();
        
        // Add product count to each category
        foreach ($categories as $category) {
            $category->product_count = $this->productModel->getProductCount($category->id);
        }
        
        // Return JSON response
        header('Content-Type: application/json');
        echo json_encode([
            'categories' => $categories
        ]);
        exit;
    }
}
?>