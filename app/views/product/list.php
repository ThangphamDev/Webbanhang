<?php include 'app/views/shares/header.php'; ?>
<link rel="stylesheet" href="/public/css/list.css">
<style>
    
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
                            <i class="fas fa-sort-amount-down"></i>
                            <span>Sắp xếp</span>
                        </button>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item active">Phổ biến nhất</a>
                            <a href="#" class="dropdown-item">Giá: Thấp đến cao</a>
                            <a href="#" class="dropdown-item">Giá: Cao đến thấp</a>
                            <a href="#" class="dropdown-item">Mới nhất</a>
                        </div>
                    </div>
                    
                    <div class="view-options">
                        <button class="view-btn active" data-view="grid">
                            <i class="fas fa-th-large"></i>
                        </button>
                        <button class="view-btn" data-view="list">
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
</script>
<?php include 'app/views/shares/footer.php'; ?>