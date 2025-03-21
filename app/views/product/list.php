<?php include 'app/views/shares/header.php'; ?>
<link rel="stylesheet" href="/public/css/list.css">
<style>
    /* CSS cho dropdown menu */
    .dropdown {
        position: relative;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        right: 0;
        min-width: 200px;
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        margin-top: 5px;
    }

    .dropdown-menu.show {
        display: block;
    }

    .dropdown-item {
        display: block;
        padding: 0.75rem 1rem;
        color: var(--text-dark);
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .dropdown-item:hover {
        background-color: var(--light-bg);
        color: var(--primary-color);
    }

    .dropdown-item.active {
        background-color: var(--primary-color);
        color: white;
    }

    .dropdown-toggle {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .dropdown-toggle:hover {
        border-color: var(--primary-color);
        color: var(--primary-color);
    }

    .dropdown-toggle i {
        font-size: 0.9rem;
    }

    /* CSS cho ô tìm kiếm */
    .search-box {
        position: relative;
        min-width: 200px;
    }

    .search-input {
        width: 100%;
        padding: 0.5rem 1rem;
        padding-right: 2.5rem;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(67, 160, 71, 0.15);
        outline: none;
    }

    .search-button {
        position: absolute;
        right: 0.5rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: var(--text-muted);
        cursor: pointer;
        padding: 0.5rem;
        transition: color 0.3s ease;
    }

    .search-button:hover {
        color: var(--primary-color);
    }

    /* Product Grid/List View */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
        transition: all 0.3s ease;
    }

    /* Ẩn nút thêm vào giỏ dạng list view trong chế độ grid */
    .btn-add-to-cart.list-view-only {
        display: none;
    }

    .product-grid.list-view {
        grid-template-columns: 1fr;
        gap: 15px;
    }

    .product-grid.list-view .product-card {
        display: grid;
        grid-template-columns: 150px 1fr auto;
        align-items: start;
        padding: 15px;
        gap: 20px;
        background: var(--white);
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        position: relative;
    }

    .product-grid.list-view .product-thumb {
        width: 150px;
        height: 150px;
        position: relative;
        border-radius: 8px;
        overflow: hidden;
    }

    .product-grid.list-view .product-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .product-grid.list-view .product-info {
        display: flex;
        flex-direction: column;
        gap: 8px;
        padding-right: 15px;
    }

    .product-grid.list-view .product-actions-quick {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .product-grid.list-view .hover-action {
        position: static;
        opacity: 1;
        transform: none;
        margin-top: auto;
    }

    .product-grid.list-view .product-category {
        font-size: 0.85rem;
        color: var(--primary-color);
        margin-bottom: 2px;
    }

    .product-grid.list-view .product-name {
        font-size: 1.1rem;
        margin: 0;
        line-height: 1.4;
        font-weight: 500;
    }

    .product-grid.list-view .product-name a {
        color: var(--text-dark);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .product-grid.list-view .product-name a:hover {
        color: var(--primary-color);
    }

    .product-grid.list-view .product-rating {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
        color: var(--text-muted);
    }

    .product-grid.list-view .product-price {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-top: 4px;
    }

    .product-grid.list-view .current-price {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--primary-color);
    }

    .product-grid.list-view .old-price {
        font-size: 1rem;
        color: var(--text-muted);
        text-decoration: line-through;
    }

    .product-grid.list-view .action-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: var(--white);
        border: 1px solid var(--border-color);
        color: var(--text-muted);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .product-grid.list-view .action-btn:hover {
        background: var(--primary-color);
        border-color: var(--primary-color);
        color: var(--white);
        transform: translateY(-1px);
    }

    .product-grid.list-view .btn-add-to-cart.list-view-only {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        background: var(--primary-color);
        color: var(--white);
        border-radius: 25px;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        margin-top: 10px;
    }

    .product-grid.list-view .btn-add-to-cart.list-view-only:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
    }

    .product-grid.list-view .btn-add-to-cart.list-view-only i {
        font-size: 1rem;
    }

    .product-grid.list-view .product-badges {
        position: absolute;
        top: 10px;
        left: 10px;
        z-index: 2;
        display: flex;
        gap: 5px;
    }

    .product-grid.list-view .badge {
        padding: 4px 8px;
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 4px;
    }

    .product-grid.list-view .badge-sale {
        background: #ff4757;
        color: white;
    }

    .product-grid.list-view .badge-new {
        background: #2ed573;
        color: white;
    }

    @media (max-width: 768px) {
        .product-grid.list-view .product-card {
            grid-template-columns: 120px 1fr;
        }

        .product-grid.list-view .product-thumb {
            width: 120px;
            height: 120px;
        }

        .product-grid.list-view .product-actions-quick {
            display: none;
        }
    }

    /* View Toggle Buttons */
    .view-toggle {
        display: flex;
        gap: 8px;
        margin-left: 15px;
    }

    .view-toggle button {
        background: none;
        border: 1px solid var(--border-color);
        color: var(--text-muted);
        padding: 6px 10px;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .view-toggle button:hover {
        color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .view-toggle button.active {
        background-color: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }

    .view-toggle button i {
        font-size: 1rem;
    }
</style>
<!-- Banner quảng cáo hiện đại -->
<div class="hero-banner">
    <div class="container">
        <div class="banner-wrapper">
            <div class="banner-content">
                <span class="promo-label">Ưu đãi tháng 3</span>
                <h1 class="banner-title">Giảm giá đến <span class="highlight">33%</span></h1>
                <p class="banner-subtitle">Nhập mã <span class="promo-code">SPRING33</span> khi thanh toán</p>
                <div class="banner-cta">
                    <a href="/promotion" class="btn-primary">Khám phá ngay</a>
                    <a href="/collections/bestsellers" class="btn-secondary">Xem sản phẩm bán chạy</a>
                </div>
            </div>
            <!-- Thay thế phần decoration bằng hình ảnh banner -->
            <div class="banner-image-right">
                <img src="/public/images/banner.jpg" alt="Banner khuyến mãi tháng 3" class="banner-img">
            </div>
        </div>
    </div>
</div>

<!-- Phần danh mục sản phẩm -->
<div class="container">
    <div class="section-catalog">
        <!-- Điều hướng và tìm kiếm -->
        <div class="catalog-header">
            <div class="breadcrumb">
                <a href="/" class="breadcrumb-item">Trang chủ</a>
                <span class="breadcrumb-separator">/</span>
                <span class="breadcrumb-item active">Danh sách sản phẩm</span>
            </div>
            
            <div class="catalog-tools">
                <div class="search-box">
                    <input type="text" placeholder="Tìm kiếm sản phẩm..." class="search-input">
                    <button class="search-button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                
                <div class="filter-sort">
                    <div class="dropdown">
                        <button class="dropdown-toggle">
                            <span>Phổ biến nhất</span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item active" data-sort="popular">Phổ biến nhất</a>
                            <a href="#" class="dropdown-item" data-sort="price_asc">Giá: Thấp đến cao</a>
                            <a href="#" class="dropdown-item" data-sort="price_desc">Giá: Cao đến thấp</a>
                            <a href="#" class="dropdown-item" data-sort="newest">Mới nhất</a>
                        </div>
                    </div>
                    
                    <div class="view-toggle">
                        <button class="grid-view active" title="Xem dạng lưới">
                            <i class="fas fa-th-large"></i>
                        </button>
                        <button class="list-view" title="Xem dạng danh sách">
                            <i class="fas fa-list"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Bộ lọc và danh sách sản phẩm -->
        <div class="catalog-content">
            <!-- Bộ lọc bên trái -->
            <div class="catalog-sidebar">
                <div class="sidebar-heading">
                    <h3>Bộ lọc</h3>
                    <button class="btn-clear-filter" onclick="clearAllFilters()">Xóa tất cả</button>
                </div>
                
                <div class="filter-group">
                    <h4 class="filter-title">Danh mục</h4>
                    <div class="filter-options">
                        <label class="filter-option">
                            <input type="checkbox" value="all" name="category" 
                                   <?php echo (!isset($_GET['category']) || $_GET['category'] === 'all') ? 'checked' : ''; ?>
                                   onchange="handleCategoryChange(this)">
                            <span class="checkmark"></span>
                            <span class="option-name">Tất cả</span>
                        </label>
                        <?php foreach ($categories as $category): ?>
                        <label class="filter-option">
                            <input type="checkbox" value="<?php echo $category->id; ?>" name="category"
                                   <?php echo (isset($_GET['category']) && $_GET['category'] == $category->id) ? 'checked' : ''; ?>
                                   onchange="handleCategoryChange(this)">
                            <span class="checkmark"></span>
                            <span class="option-name"><?php echo htmlspecialchars($category->name); ?></span>
                            <span class="option-count"><?php echo $category->product_count ?? 0; ?></span>
                        </label>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <div class="filter-group">
                    <h4 class="filter-title">Giá</h4>
                    <div class="price-range">
                        <div class="range-slider">
                            <input type="range" id="price-min" class="range-min" min="<?php echo $min_product_price; ?>" 
                                   max="<?php echo $max_product_price; ?>" value="<?php echo $min_price ?? $min_product_price; ?>">
                            <input type="range" id="price-max" class="range-max" min="<?php echo $min_product_price; ?>" 
                                   max="<?php echo $max_product_price; ?>" value="<?php echo $max_price ?? $max_product_price; ?>">
                            <div class="range-track">
                                <div class="range-selection"></div>
                            </div>
                        </div>
                        <div class="range-values">
                            <span id="price-min-value"><?php echo number_format($min_price ?? $min_product_price, 0, ',', '.'); ?>₫</span>
                            <span id="price-max-value"><?php echo number_format($max_price ?? $max_product_price, 0, ',', '.'); ?>₫</span>
                        </div>
                    </div>
                </div>
                
                <div class="filter-group">
                    <h4 class="filter-title">Đánh giá</h4>
                    <div class="filter-options">
                        <?php for($i = 5; $i >= 1; $i--): ?>
                        <label class="filter-option">
                            <input type="checkbox" value="<?php echo $i; ?>" name="rating"
                                   <?php echo (isset($_GET['rating']) && $_GET['rating'] == $i) ? 'checked' : ''; ?>
                                   onchange="handleRatingChange(this)">
                            <span class="checkmark"></span>
                            <div class="star-rating">
                                <?php for($j = 1; $j <= 5; $j++): ?>
                                    <i class="fas fa-star <?php echo $j <= $i ? 'active' : ''; ?>"></i>
                                <?php endfor; ?>
                            </div>
                        </label>
                        <?php endfor; ?>
                    </div>
                </div>
                
                <?php if (SessionHelper::isAdmin()): ?>
                <a href="/Product/add" class="btn-add-product sidebar-cta">
                    <i class="fas fa-plus-circle"></i>
                    <span>Thêm sản phẩm mới</span>
                </a>
                <?php endif; ?>
            </div>
            
            <!-- Danh sách sản phẩm chính -->
            <div class="catalog-main">
                <?php if (!empty($products)): ?>
                    <div class="product-grid">
                        <?php foreach ($products as $product): ?>
                            <div class="product-card">
                                <div class="product-badges">
                                    <span class="badge badge-sale">-33%</span>
                                    <?php if (rand(0, 1)): ?>
                                        <span class="badge badge-new">New</span>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="product-actions-quick">
                                    <button class="action-btn btn-wishlist" title="Thêm vào yêu thích">
                                        <i class="far fa-heart"></i>
                                    </button>
                                    <button class="action-btn btn-compare" title="So sánh">
                                        <i class="fas fa-exchange-alt"></i>
                                    </button>
                                    <button class="action-btn btn-quickview" title="Xem nhanh">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </div>
                                
                                <div class="product-thumb">
                                    <a href="/Product/show/<?php echo $product->id; ?>" class="image-wrapper">
                                        <?php if (!empty($product->image)): ?>
                                            <img src="/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>" 
                                                alt="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>" 
                                                class="product-img">
                                        <?php else: ?>
                                            <div class="no-image">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        <?php endif; ?>
                                    </a>
                                    
                                    <div class="hover-action">
                                        <a href="/Product/addToCart/<?php echo $product->id; ?>" class="btn-add-to-cart">
                                            <i class="fas fa-shopping-cart"></i>
                                            <span>Thêm vào giỏ</span>
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="product-info">
                                    <?php if (!empty($product->category_name)): ?>
                                        <div class="product-category">
                                            <a href="/category/<?php echo strtolower($product->category_name); ?>">
                                                <?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <h3 class="product-name">
                                        <a href="/Product/show/<?php echo $product->id; ?>">
                                            <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                                        </a>
                                    </h3>
                                    
                                    <div class="product-rating">
                                        <div class="stars">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <i class="fas fa-star <?php echo $i <= $product->rating ? 'active' : ''; ?>"></i>
                                            <?php endfor; ?>
                                        </div>
                                        <span class="rating-count">(<?php echo $product->rating_count ?? 0; ?>)</span>
                                    </div>
                                    
                                    <div class="product-price">
                                        <span class="current-price"><?php echo number_format($product->price, 0, ',', '.'); ?> ₫</span>
                                        <?php if (!empty($product->old_price)): ?>
                                            <span class="old-price"><?php echo number_format($product->old_price, 0, ',', '.'); ?> ₫</span>
                                        <?php endif; ?>
                                    </div>

                                    <a href="/Product/addToCart/<?php echo $product->id; ?>" class="btn-add-to-cart list-view-only">
                                        <i class="fas fa-shopping-cart"></i>
                                        <span>Thêm vào giỏ</span>
                                    </a>
                                    
                                    <?php if (SessionHelper::isAdmin()): ?>
                                    <div class="product-actions">
                                        <a href="/Product/edit/<?php echo $product->id; ?>" class="btn-edit">
                                            <i class="fas fa-edit"></i> Sửa
                                        </a>
                                        <a href="/Product/delete/<?php echo $product->id; ?>" class="btn-delete" 
                                           onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                                            <i class="fas fa-trash"></i> Xóa
                                        </a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="pagination">
                        <a href="#" class="page-item prev disabled">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                        <a href="#" class="page-item active">1</a>
                        <a href="#" class="page-item">2</a>
                        <a href="#" class="page-item">3</a>
                        <span class="page-dots">...</span>
                        <a href="#" class="page-item">10</a>
                        <a href="#" class="page-item next">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                <?php else: ?>
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <h2 class="empty-state-title">Chưa có sản phẩm nào</h2>
                        <p class="empty-state-description">Hãy thêm sản phẩm đầu tiên của bạn để bắt đầu kinh doanh</p>
                        <a href="/Product/add" class="btn-add-product empty-state-cta">
                            <i class="fas fa-plus-circle"></i>
                            <span>Thêm sản phẩm ngay</span>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="/public/js/list.js"></script>
<script>
let timeout;
const productGrid = document.querySelector('.product-grid');

// Thêm biến để lưu timeout
let searchTimeout;

// Thêm hàm xử lý tìm kiếm
function handleSearch() {
    const searchInput = document.querySelector('.catalog-tools .search-input');
    const searchButton = document.querySelector('.catalog-tools .search-button');
    if (!searchInput) return;

    // Xử lý khi nhấn nút tìm kiếm
    if (searchButton) {
        searchButton.addEventListener('click', function() {
            const keyword = searchInput.value.trim();
            if (keyword.length >= 2) {
                fetch(`/Product/search?keyword=${encodeURIComponent(keyword)}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    updateProductGrid(data.products);
                })
                .catch(error => console.error('Error searching products:', error));
            }
        });
    }

    // Xử lý khi gõ
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        const keyword = this.value.trim();
        
        // Đợi 300ms sau khi người dùng ngừng gõ
        searchTimeout = setTimeout(() => {
            if (keyword.length >= 2) {
                fetch(`/Product/search?keyword=${encodeURIComponent(keyword)}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    updateProductGrid(data.products);
                })
                .catch(error => console.error('Error searching products:', error));
            } else {
                // Nếu từ khóa quá ngắn, hiển thị tất cả sản phẩm
                fetch('/Product/search', {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    updateProductGrid(data.products);
                })
                .catch(error => console.error('Error fetching products:', error));
            }
        }, 300);
    });
}

// Thêm hàm xử lý sắp xếp
function handleSort() {
    const dropdownToggle = document.querySelector('.catalog-tools .dropdown-toggle');
    const dropdownMenu = document.querySelector('.catalog-tools .dropdown-menu');
    const dropdownItems = document.querySelectorAll('.catalog-tools .dropdown-menu .dropdown-item');
    
    if (!dropdownToggle || !dropdownMenu || !dropdownItems.length) return;

    // Toggle dropdown menu khi click vào nút sắp xếp
    dropdownToggle.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        dropdownMenu.classList.toggle('show');
    });

    // Đóng dropdown khi click ra ngoài
    document.addEventListener('click', function(e) {
        if (!dropdownToggle.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.classList.remove('show');
        }
    });

    // Xử lý khi chọn option
    dropdownItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            dropdownItems.forEach(i => i.classList.remove('active'));
            this.classList.add('active');
            
            const dropdownToggleText = dropdownToggle.querySelector('span');
            if (dropdownToggleText) {
                dropdownToggleText.textContent = this.textContent;
            }
            
            const sortValue = this.getAttribute('data-sort');
            
            fetch(`/Product/sort?sort=${encodeURIComponent(sortValue)}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                updateProductGrid(data.products);
                dropdownMenu.classList.remove('show');
            })
            .catch(error => console.error('Error sorting products:', error));
        });
    });
}

function updateProductGrid(products) {
    productGrid.innerHTML = '';
    
    products.forEach(product => {
        const productCard = `
            <div class="product-card">
                <div class="product-badges">
                    <span class="badge badge-sale">-33%</span>
                    ${Math.random() > 0.5 ? '<span class="badge badge-new">New</span>' : ''}
                </div>
                
                <div class="product-actions-quick">
                    <button class="action-btn btn-wishlist" title="Thêm vào yêu thích">
                        <i class="far fa-heart"></i>
                    </button>
                    <button class="action-btn btn-compare" title="So sánh">
                        <i class="fas fa-exchange-alt"></i>
                    </button>
                    <button class="action-btn btn-quickview" title="Xem nhanh">
                        <i class="far fa-eye"></i>
                    </button>
                </div>
                
                <div class="product-thumb">
                    <a href="/Product/show/${product.id}" class="image-wrapper">
                        ${product.image ? 
                            `<img src="/${product.image}" alt="${product.name}" class="product-img">` :
                            `<div class="no-image"><i class="fas fa-image"></i></div>`
                        }
                    </a>
                    
                    <div class="hover-action">
                        <a href="/Product/addToCart/${product.id}" class="btn-add-to-cart">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Thêm vào giỏ</span>
                        </a>
                    </div>
                </div>
                
                <div class="product-info">
                    ${product.category_name ? 
                        `<div class="product-category">
                            <a href="/category/${product.category_name.toLowerCase()}">${product.category_name}</a>
                        </div>` : ''
                    }
                    
                    <h3 class="product-name">
                        <a href="/Product/show/${product.id}">${product.name}</a>
                    </h3>
                    
                    <div class="product-rating">
                        <div class="stars">
                            ${Array(5).fill().map((_, i) => 
                                `<i class="fas fa-star ${i < (product.rating || 0) ? 'active' : ''}"></i>`
                            ).join('')}
                        </div>
                        <span class="rating-count">(${product.rating_count || 0})</span>
                    </div>
                    
                    <div class="product-price">
                        <span class="current-price">${new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(product.price)}</span>
                        ${product.old_price ? 
                            `<span class="old-price">${new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(product.old_price)}</span>` : ''
                        }
                    </div>
                    
                    <a href="/Product/addToCart/${product.id}" class="btn-add-to-cart list-view-only">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Thêm vào giỏ</span>
                    </a>
                    
                    <?php if (SessionHelper::isAdmin()): ?>
                    <div class="product-actions">
                        <a href="/Product/edit/${product.id}" class="btn-edit">
                            <i class="fas fa-edit"></i> Sửa
                        </a>
                        <a href="/Product/delete/${product.id}" class="btn-delete" 
                           onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                            <i class="fas fa-trash"></i> Xóa
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        `;
        productGrid.insertAdjacentHTML('beforeend', productCard);
    });
}

async function applyFilters() {
    const urlParams = new URLSearchParams(window.location.search);
    const category = document.querySelector('input[name="category"]:checked')?.value;
    const rating = document.querySelector('input[name="rating"]:checked')?.value;
    const minPrice = document.getElementById('price-min').value;
    const maxPrice = document.getElementById('price-max').value;

    if (category) urlParams.set('category', category);
    if (rating) urlParams.set('rating', rating);
    if (minPrice) urlParams.set('min_price', minPrice);
    if (maxPrice) urlParams.set('max_price', maxPrice);

    try {
        const response = await fetch(`/Product/filter?${urlParams.toString()}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
        const data = await response.json();
        updateProductGrid(data.products);
        
        // Update category counts
        data.categories.forEach(category => {
            const countElement = document.querySelector(`input[value="${category.id}"]`)
                ?.closest('.filter-option')
                ?.querySelector('.option-count');
            if (countElement) {
                countElement.textContent = `(${category.product_count})`;
            }
        });
    } catch (error) {
        console.error('Error applying filters:', error);
    }
}

function handleCategoryChange(checkbox) {
    if (checkbox.checked) {
        // Uncheck other category checkboxes
        document.querySelectorAll('input[name="category"]').forEach(cb => {
            if (cb !== checkbox) cb.checked = false;
        });
        applyFilters();
    }
}

function handleRatingChange(checkbox) {
    if (checkbox.checked) {
        // Uncheck other rating checkboxes
        document.querySelectorAll('input[name="rating"]').forEach(cb => {
            if (cb !== checkbox) cb.checked = false;
        });
        applyFilters();
    }
}

function clearAllFilters() {
    // Reset all checkboxes
    document.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
    document.querySelector('input[value="all"]').checked = true;
    
    // Reset price range
    const priceMin = document.getElementById('price-min');
    const priceMax = document.getElementById('price-max');
    priceMin.value = priceMin.min;
    priceMax.value = priceMax.max;
    
    // Update price display
    updatePriceRange();
    
    // Apply filters
    applyFilters();
}

// Price range slider
const priceMin = document.getElementById('price-min');
const priceMax = document.getElementById('price-max');
const priceMinValue = document.getElementById('price-min-value');
const priceMaxValue = document.getElementById('price-max-value');

function updatePriceRange() {
    const min = parseInt(priceMin.value);
    const max = parseInt(priceMax.value);
    
    if (min > max) {
        priceMin.value = max;
        priceMax.value = min;
    }
    
    priceMinValue.textContent = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' })
        .format(priceMin.value).replace('₫', '') + '₫';
    priceMaxValue.textContent = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' })
        .format(priceMax.value).replace('₫', '') + '₫';
    
    const rangeSelection = document.querySelector('.range-selection');
    const percentage1 = ((priceMin.value - priceMin.min) / (priceMin.max - priceMin.min)) * 100;
    const percentage2 = ((priceMax.value - priceMin.min) / (priceMin.max - priceMin.min)) * 100;
    rangeSelection.style.left = percentage1 + '%';
    rangeSelection.style.right = (100 - percentage2) + '%';
    
    clearTimeout(timeout);
    timeout = setTimeout(applyFilters, 500);
}

priceMin.addEventListener('input', updatePriceRange);
priceMax.addEventListener('input', updatePriceRange);

// Initialize price range on page load
updatePriceRange();

// Gọi các hàm xử lý khi trang được tải
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM Content Loaded');
    handleSearch();
    handleSort();

    // Xử lý chuyển đổi hiển thị
    function handleViewToggle() {
        const gridViewBtn = document.querySelector('.view-toggle .grid-view');
        const listViewBtn = document.querySelector('.view-toggle .list-view');
        const productGrid = document.querySelector('.product-grid');
        
        if (!gridViewBtn || !listViewBtn || !productGrid) return;

        // Lấy view đã lưu từ localStorage hoặc mặc định là grid
        const savedView = localStorage.getItem('productView') || 'grid';
        if (savedView === 'list') {
            productGrid.classList.add('list-view');
            gridViewBtn.classList.remove('active');
            listViewBtn.classList.add('active');
        }

        // Xử lý click vào nút grid view
        gridViewBtn.addEventListener('click', function() {
            productGrid.classList.remove('list-view');
            gridViewBtn.classList.add('active');
            listViewBtn.classList.remove('active');
            localStorage.setItem('productView', 'grid');
        });

        // Xử lý click vào nút list view
        listViewBtn.addEventListener('click', function() {
            productGrid.classList.add('list-view');
            gridViewBtn.classList.remove('active');
            listViewBtn.classList.add('active');
            localStorage.setItem('productView', 'list');
        });
    }

    // Khởi tạo các chức năng
    handleViewToggle();

    // Thêm hàm cập nhật số lượng giỏ hàng
    function updateCartCount(count) {
        // Cập nhật tất cả các phần tử hiển thị số lượng giỏ hàng
        const cartCountElements = document.querySelectorAll('.cart-count');
        cartCountElements.forEach(element => {
            if (element) {
                element.textContent = count;
                // Hiển thị badge nếu có sản phẩm trong giỏ hàng
                if (count > 0) {
                    element.style.display = 'inline-block';
                } else {
                    element.style.display = 'none';
                }
            }
        });
    }

    // Cập nhật hàm handleAddToCart
    function handleAddToCart() {
        document.addEventListener('click', function(e) {
            const addToCartBtn = e.target.closest('.btn-add-to-cart');
            if (!addToCartBtn) return;
            
            e.preventDefault();
            const productId = addToCartBtn.getAttribute('href').split('/').pop();
            
            // Thêm hiệu ứng loading
            addToCartBtn.classList.add('loading');
            const originalText = addToCartBtn.innerHTML;
            addToCartBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang thêm...';
            
            fetch(`/Product/addToCartAjax/${productId}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Cập nhật số lượng trong giỏ hàng
                    updateCartCount(data.cartCount);
                    
                    // Hiển thị thông báo thành công
                    showNotification('success', data.message);
                } else {
                    throw new Error(data.message || 'Có lỗi xảy ra khi thêm vào giỏ hàng');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('error', error.message);
            })
            .finally(() => {
                // Khôi phục nút sau khi hoàn thành
                setTimeout(() => {
                    addToCartBtn.classList.remove('loading');
                    addToCartBtn.innerHTML = originalText;
                }, 500);
            });
        });
    }

    // Thêm hàm hiển thị thông báo
    function showNotification(type, message) {
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.innerHTML = `
            <div class="notification-content">
                <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
                <span>${message}</span>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        // Thêm class để hiển thị notification với animation
        setTimeout(() => notification.classList.add('show'), 100);
        
        // Xóa notification sau 3 giây
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }

    // Thêm CSS cho notification
    const style = document.createElement('style');
    style.textContent = `
        .notification {
            position: fixed;
            top: 20px;
            right: -300px;
            background: white;
            padding: 15px 25px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            transition: transform 0.3s ease;
        }
        
        .notification.show {
            transform: translateX(-320px);
        }
        
        .notification.success {
            border-left: 4px solid #43a047;
        }
        
        .notification.error {
            border-left: 4px solid #e53935;
        }
        
        .notification-content {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .notification i {
            font-size: 1.2rem;
        }
        
        .notification.success i {
            color: #43a047;
        }
        
        .notification.error i {
            color: #e53935;
        }
    `;
    document.head.appendChild(style);

    // Thêm CSS cho loading state
    const loadingStyle = document.createElement('style');
    loadingStyle.textContent = `
        .btn-add-to-cart.loading {
            pointer-events: none;
            opacity: 0.7;
        }
        
        .btn-add-to-cart.loading .fa-spinner {
            margin-right: 5px;
        }
    `;
    document.head.appendChild(loadingStyle);

    // Thêm CSS cho cart count
    const cartCountStyle = document.createElement('style');
    cartCountStyle.textContent = `
        .cart-count {
            display: inline-block;
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: #ff4757;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
            min-width: 18px;
            text-align: center;
        }
        
        .cart-count:empty {
            display: none;
        }
    `;
    document.head.appendChild(cartCountStyle);

    // Gọi các hàm xử lý khi trang được tải
    handleAddToCart();
});
</script>
<?php include 'app/views/shares/footer.php'; ?>