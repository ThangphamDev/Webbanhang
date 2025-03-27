<?php include 'app/views/shares/header.php'; ?>
<link rel="stylesheet" href="/public/css/show.css">

<div class="container">
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="/" class="breadcrumb-item">Trang chủ</a>
        <span class="breadcrumb-separator">/</span>
        <a href="/Product/list" class="breadcrumb-item">Sản phẩm</a>
        <span class="breadcrumb-separator">/</span>
        <span class="breadcrumb-item active"><?php echo htmlspecialchars($product->name); ?></span>
    </div>

    <!-- Chi tiết sản phẩm -->
    <div class="product-detail">
        <div class="product-gallery">
            <div class="main-image">
                <?php if (!empty($product->image)): ?>
                    <img src="/<?php echo htmlspecialchars($product->image); ?>" 
                         alt="<?php echo htmlspecialchars($product->name); ?>" 
                         id="main-product-image">
                <?php else: ?>
                    <div class="no-image">
                        <i class="fas fa-image"></i>
                        <span>Không có ảnh</span>
                    </div>
                <?php endif; ?>
            </div>
            
            <?php if (!empty($product_images)): ?>
            <div class="thumbnail-list">
                <?php if (!empty($product->image)): ?>
                <div class="thumbnail active" data-src="/<?php echo htmlspecialchars($product->image); ?>">
                    <img src="/<?php echo htmlspecialchars($product->image); ?>" 
                         alt="<?php echo htmlspecialchars($product->name); ?>">
                </div>
                <?php endif; ?>
                
                <?php foreach($product_images as $img): ?>
                <div class="thumbnail" data-src="/<?php echo htmlspecialchars($img->image_path); ?>">
                    <img src="/<?php echo htmlspecialchars($img->image_path); ?>" 
                         alt="<?php echo htmlspecialchars($product->name); ?> - Ảnh <?php echo $img->id; ?>">
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
        
        <div class="product-info">
            <div class="product-header">
                <h1 class="product-title"><?php echo htmlspecialchars($product->name); ?></h1>
                
                <div class="product-meta">
                    <?php if (isset($product->rating) && $product->rating > 0): ?>
                    <div class="product-rating">
                        <div class="stars">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <i class="fas fa-star <?php echo $i <= $product->rating ? 'active' : ''; ?>"></i>
                            <?php endfor; ?>
                        </div>
                        <span class="rating-count"><?php echo $product->rating; ?>/5 (<?php echo $product->rating_count ?? 0; ?> đánh giá)</span>
                    </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($product->category_name)): ?>
                    <div class="product-category">
                        Danh mục: <a href="/category/<?php echo htmlspecialchars(strtolower($product->category_name)); ?>">
                            <?php echo htmlspecialchars($product->category_name); ?>
                        </a>
                    </div>
                    <?php endif; ?>
                    
                    <div class="product-sku">
                        Mã sản phẩm: <?php echo htmlspecialchars($product->sku ?? 'SP'.$product->id); ?>
                    </div>
                </div>
            </div>
            
            <div class="product-price-block">
                <div class="product-price">
                    <span class="current-price"><?php echo number_format($product->price, 0, ',', '.'); ?>₫</span>
                    <?php if (!empty($product->old_price) && $product->old_price > $product->price): ?>
                        <span class="old-price"><?php echo number_format($product->old_price, 0, ',', '.'); ?>₫</span>
                        <?php 
                            $discount_percent = round(($product->old_price - $product->price) / $product->old_price * 100);
                        ?>
                        <span class="discount-badge">-<?php echo $discount_percent; ?>%</span>
                    <?php else: ?>
                        <?php 
                            $original_price = round($product->price / 0.67); // Tính giá gốc trước khi giảm 33%
                        ?>
                        <span class="old-price"><?php echo number_format($original_price, 0, ',', '.'); ?>₫</span>
                        <span class="discount-badge">-33%</span>
                    <?php endif; ?>
                </div>
                
                <div class="product-status in-stock">
                    <i class="fas fa-check-circle"></i> Còn hàng
                </div>
            </div>
            
            <?php if (!empty($product->short_description)): ?>
            <div class="product-short-desc">
                <?php echo $product->short_description; ?>
            </div>
            <?php endif; ?>
            
            <div class="product-actions">
                <div class="quantity-selector">
                    <button type="button" class="qty-btn minus">
                        <i class="fas fa-minus"></i>
                    </button>
                    <input type="number" name="quantity" id="quantity" value="1" min="1" 
                           max="<?php echo isset($product->quantity) ? $product->quantity : 99; ?>">
                    <button type="button" class="qty-btn plus">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
                
                <button class="btn-add-to-cart" id="add-to-cart" data-product-id="<?php echo $product->id; ?>">
                    <i class="fas fa-shopping-cart"></i>
                    Thêm vào giỏ hàng
                </button>
                
                <button class="btn-buy-now">
                    <i class="fas fa-bolt"></i>
                    Mua ngay
                </button>
            </div>
            
            <div class="product-additional-actions">
                <button class="btn-wishlist">
                    <i class="far fa-heart"></i>
                    Thêm vào yêu thích
                </button>
                
                <button class="btn-compare">
                    <i class="fas fa-exchange-alt"></i>
                    So sánh
                </button>
            </div>
            
            <div class="product-policies">
                <div class="policy">
                    <i class="fas fa-truck"></i>
                    <div>
                        <h4>Giao hàng miễn phí</h4>
                        <p>Cho đơn hàng từ 500.000₫</p>
                    </div>
                </div>
                
                <div class="policy">
                    <i class="fas fa-sync-alt"></i>
                    <div>
                        <h4>Đổi trả dễ dàng</h4>
                        <p>Trong vòng 7 ngày</p>
                    </div>
                </div>
                
                <div class="policy">
                    <i class="fas fa-shield-alt"></i>
                    <div>
                        <h4>Bảo hành chính hãng</h4>
                        <p>12 tháng bảo hành</p>
                    </div>
                </div>
            </div>
            
            <?php if (SessionHelper::isAdmin()): ?>
            <div class="admin-actions">
                <a href="/Product/edit/<?php echo $product->id; ?>" class="btn-edit">
                    <i class="fas fa-edit"></i> Chỉnh sửa sản phẩm
                </a>
                
                <a href="/Product/delete/<?php echo $product->id; ?>" class="btn-delete" 
                   onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                    <i class="fas fa-trash"></i> Xóa sản phẩm
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Tabs thông tin chi tiết -->
    <div class="product-tabs">
        <div class="tabs-header">
            <button class="tab-button active" data-tab="description">Mô tả sản phẩm</button>
            <button class="tab-button" data-tab="specifications">Thông số kỹ thuật</button>
            <button class="tab-button" data-tab="reviews">Đánh giá (<?php echo $product->rating_count ?? 0; ?>)</button>
        </div>
        
        <div class="tabs-content">
            <div class="tab-pane active" id="description">
                <div class="product-description">
                    <?php if (!empty($product->description)): ?>
                        <?php echo $product->description; ?>
                    <?php else: ?>
                        <p>Chưa có mô tả chi tiết cho sản phẩm này.</p>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="tab-pane" id="specifications">
                <?php if (!empty($product->specifications)): ?>
                    <div class="specifications-table">
                        <table>
                            <?php foreach(json_decode($product->specifications, true) as $spec => $value): ?>
                            <tr>
                                <th><?php echo htmlspecialchars($spec); ?></th>
                                <td><?php echo htmlspecialchars($value); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                <?php else: ?>
                    <p>Chưa có thông số kỹ thuật cho sản phẩm này.</p>
                <?php endif; ?>
            </div>
            
            <div class="tab-pane" id="reviews">
                <div class="reviews-container">
                    <?php if (!empty($reviews)): ?>
                        <div class="review-summary">
                            <div class="rating-average">
                                <span class="average-number"><?php echo $product->rating; ?></span>
                                <div class="average-stars">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <i class="fas fa-star <?php echo $i <= $product->rating ? 'active' : ''; ?>"></i>
                                    <?php endfor; ?>
                                </div>
                                <span class="total-ratings"><?php echo $product->rating_count; ?> đánh giá</span>
                            </div>
                            
                            <div class="rating-bars">
                                <?php for ($i = 5; $i >= 1; $i--): ?>
                                    <?php 
                                        $count = 0;
                                        foreach ($reviews as $review) {
                                            if ($review->rating == $i) $count++;
                                        }
                                        $percent = $product->rating_count > 0 ? ($count / $product->rating_count * 100) : 0;
                                    ?>
                                    <div class="rating-bar-row">
                                        <div class="rating-label"><?php echo $i; ?> <i class="fas fa-star"></i></div>
                                        <div class="rating-bar">
                                            <div class="rating-fill" style="width: <?php echo $percent; ?>%;"></div>
                                        </div>
                                        <div class="rating-count"><?php echo $count; ?></div>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                        
                        <div class="reviews-list">
                            <?php foreach ($reviews as $review): ?>
                                <div class="review-item">
                                    <div class="review-header">
                                        <div class="reviewer-info">
                                            <div class="reviewer-avatar">
                                                <div class="avatar-placeholder">
                                                    <?php echo strtoupper(substr($review->user_name, 0, 1)); ?>
                                                </div>
                                            </div>
                                            <div class="reviewer-meta">
                                                <h4 class="reviewer-name"><?php echo htmlspecialchars($review->user_name); ?></h4>
                                                <div class="review-date">
                                                    <?php echo date('d/m/Y', strtotime($review->created_at)); ?>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="review-rating">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <i class="fas fa-star <?php echo $i <= $review->rating ? 'active' : ''; ?>"></i>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                    
                                    <div class="review-content">
                                        <?php echo htmlspecialchars($review->content); ?>
                                    </div>
                                    
                                    <?php if (!empty($review->images)): ?>
                                        <div class="review-images">
                                            <?php foreach(explode(',', $review->images) as $image): ?>
                                                <div class="review-image">
                                                    <img src="/<?php echo htmlspecialchars(trim($image)); ?>" 
                                                         alt="Ảnh đánh giá">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="no-reviews">
                            <i class="far fa-comment-dots"></i>
                            <p>Chưa có đánh giá nào cho sản phẩm này.</p>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (SessionHelper::isLoggedIn()): ?>
                        <div class="review-form-container">
                            <h3>Viết đánh giá của bạn</h3>
                            <form action="/Product/addReview" method="post" class="review-form" enctype="multipart/form-data">
                                <input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
                                
                                <div class="form-group rating-selector">
                                    <label>Đánh giá của bạn:</label>
                                    <div class="rating-stars">
                                        <?php for ($i = 5; $i >= 1; $i--): ?>
                                            <input type="radio" id="star<?php echo $i; ?>" name="rating" value="<?php echo $i; ?>" <?php echo $i == 5 ? 'checked' : ''; ?>>
                                            <label for="star<?php echo $i; ?>">
                                                <i class="fas fa-star"></i>
                                            </label>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="review-content">Nội dung đánh giá:</label>
                                    <textarea id="review-content" name="content" rows="4" required></textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label>Hình ảnh (tùy chọn):</label>
                                    <div class="review-image-upload">
                                        <input type="file" id="review-images" name="review_images[]" multiple accept="image/*">
                                        <label for="review-images" class="upload-button">
                                            <i class="fas fa-camera"></i>
                                            <span>Thêm ảnh</span>
                                        </label>
                                        <div class="image-preview-container"></div>
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn-submit-review">
                                    <i class="fas fa-paper-plane"></i>
                                    Gửi đánh giá
                                </button>
                            </form>
                        </div>
                    <?php else: ?>
                        <div class="login-to-review">
                            <p>Vui lòng <a href="/User/login">đăng nhập</a> để viết đánh giá.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Sản phẩm liên quan -->
    <?php if (!empty($related_products)): ?>
    <div class="related-products">
        <h3 class="section-title">Sản phẩm liên quan</h3>
        
        <div class="product-grid related">
            <?php foreach ($related_products as $rproduct): ?>
                <div class="product-card">
                    <div class="product-badges">
                        <?php if (!empty($rproduct->old_price) && $rproduct->old_price > $rproduct->price): ?>
                            <?php $discount_percent = round(($rproduct->old_price - $rproduct->price) / $rproduct->old_price * 100); ?>
                            <span class="badge badge-sale">-<?php echo $discount_percent; ?>%</span>
                        <?php endif; ?>
                        
                        <?php if ((time() - strtotime($rproduct->created_at ?? '')) / 86400 < 7): ?>
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
                        <a href="/Product/show/<?php echo $rproduct->id; ?>" class="image-wrapper">
                            <?php if (!empty($rproduct->image)): ?>
                                <img src="/<?php echo htmlspecialchars($rproduct->image); ?>" 
                                     alt="<?php echo htmlspecialchars($rproduct->name); ?>" 
                                     class="product-img">
                            <?php else: ?>
                                <div class="no-image">
                                    <i class="fas fa-image"></i>
                                </div>
                            <?php endif; ?>
                        </a>
                        
                        <div class="hover-action">
                            <a href="/Product/addToCart/<?php echo $rproduct->id; ?>" class="btn-add-to-cart">
                                <i class="fas fa-shopping-cart"></i>
                                <span>Thêm vào giỏ</span>
                            </a>
                        </div>
                    </div>
                    
                    <div class="product-info">
                        <?php if (!empty($rproduct->category_name)): ?>
                            <div class="product-category">
                                <a href="/category/<?php echo strtolower($rproduct->category_name); ?>">
                                    <?php echo htmlspecialchars($rproduct->category_name); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <h3 class="product-name">
                            <a href="/Product/show/<?php echo $rproduct->id; ?>">
                                <?php echo htmlspecialchars($rproduct->name); ?>
                            </a>
                        </h3>
                        
                        <div class="product-rating">
                            <div class="stars">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="fas fa-star <?php echo $i <= ($rproduct->rating ?? 0) ? 'active' : ''; ?>"></i>
                                <?php endfor; ?>
                            </div>
                            <span class="rating-count">(<?php echo $rproduct->rating_count ?? 0; ?>)</span>
                        </div>
                        
                        <div class="product-price">
                            <span class="current-price"><?php echo number_format($rproduct->price, 0, ',', '.'); ?>₫</span>
                            <?php if (!empty($rproduct->old_price) && $rproduct->old_price > $rproduct->price): ?>
                                <span class="old-price"><?php echo number_format($rproduct->old_price, 0, ',', '.'); ?>₫</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
</div>

<script src="/public/js/show.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Xử lý chuyển đổi ảnh
    const mainImage = document.getElementById('main-product-image');
    const thumbnails = document.querySelectorAll('.thumbnail');
    
    thumbnails.forEach(thumb => {
        thumb.addEventListener('click', function() {
            const imgSrc = this.getAttribute('data-src');
            mainImage.src = imgSrc;
            
            // Đặt lại trạng thái active
            thumbnails.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
        });
    });
    
    // Xử lý tăng giảm số lượng
    const quantityInput = document.getElementById('quantity');
    const minusBtn = document.querySelector('.qty-btn.minus');
    const plusBtn = document.querySelector('.qty-btn.plus');
    const maxQuantity = parseInt(quantityInput.getAttribute('max')) || 99;
    
    minusBtn.addEventListener('click', function(e) {
        e.preventDefault(); // Ngăn hành vi mặc định của button
        let value = parseInt(quantityInput.value);
        if (isNaN(value) || value <= 1) {
            quantityInput.value = 1;
        } else {
            quantityInput.value = value - 1;
        }
        // Kích hoạt sự kiện change để đảm bảo giá trị mới được lưu
        quantityInput.dispatchEvent(new Event('change', { bubbles: true }));
    });
    
    plusBtn.addEventListener('click', function(e) {
        e.preventDefault(); // Ngăn hành vi mặc định của button
        let value = parseInt(quantityInput.value);
        if (isNaN(value)) {
            quantityInput.value = 1;
        } else if (value < maxQuantity) {
            quantityInput.value = value + 1;
        } else {
            quantityInput.value = maxQuantity;
        }
        // Kích hoạt sự kiện change để đảm bảo giá trị mới được lưu
        quantityInput.dispatchEvent(new Event('change', { bubbles: true }));
    });
    
    // Xử lý khi người dùng nhập trực tiếp vào input
    quantityInput.addEventListener('change', function() {
        let value = parseInt(this.value);
        if (isNaN(value) || value < 1) {
            this.value = 1;
        } else if (value > maxQuantity) {
            this.value = maxQuantity;
        }
        // Đảm bảo giá trị là số nguyên
        this.value = parseInt(this.value);
    });
    
    // Ngăn chặn hành vi mặc định cho input số lượng khi nhấn phím up/down
    quantityInput.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowUp' || e.key === 'ArrowDown') {
            e.preventDefault();
            const step = e.key === 'ArrowUp' ? 1 : -1;
            const newValue = parseInt(this.value) + step;
            if (newValue >= 1 && newValue <= maxQuantity) {
                this.value = newValue;
                this.dispatchEvent(new Event('change', { bubbles: true }));
            }
        }
    });
    
    // Xử lý chuyển tab
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabPanes = document.querySelectorAll('.tab-pane');
    
    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const tabId = this.getAttribute('data-tab');
            
            // Đặt lại trạng thái active cho button
            tabButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Đặt lại trạng thái active cho tab content
            tabPanes.forEach(pane => pane.classList.remove('active'));
            document.getElementById(tabId).classList.add('active');
        });
    });
    
    // Xử lý thêm vào giỏ hàng
    const addToCartBtn = document.getElementById('add-to-cart');
    if (addToCartBtn) {
        addToCartBtn.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            const quantity = parseInt(quantityInput.value);
            
            // Validate số lượng
            if (quantity < 1) {
                showNotification('error', 'Số lượng không hợp lệ');
                return;
            }
            
            // Thêm hiệu ứng loading
            addToCartBtn.classList.add('loading');
            const originalText = addToCartBtn.innerHTML;
            addToCartBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang thêm...';
            
            fetch(`/Product/addToCartAjax/${productId}?quantity=${quantity}`, {
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
    
    // Xử lý ảnh trong form đánh giá
    const imageInput = document.getElementById('review-images');
    const previewContainer = document.querySelector('.image-preview-container');
    
    if (imageInput) {
        imageInput.addEventListener('change', function() {
            previewContainer.innerHTML = '';
            
            if (this.files.length > 5) {
                showNotification('error', 'Chỉ được chọn tối đa 5 ảnh');
                this.value = '';
                return;
            }
            
            for (let i = 0; i < this.files.length; i++) {
                const file = this.files[i];
                if (!file.type.startsWith('image/')) continue;
                
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const previewWrapper = document.createElement('div');
                    previewWrapper.className = 'preview-item';
                    
                    const preview = document.createElement('img');
                    preview.src = e.target.result;
                    preview.className = 'preview-image';
                    
                    const removeBtn = document.createElement('span');
                    removeBtn.className = 'remove-preview';
                    removeBtn.innerHTML = '<i class="fas fa-times"></i>';
                    removeBtn.addEventListener('click', function() {
                        previewWrapper.remove();
                        // Reset input để người dùng có thể chọn lại ảnh đã xóa
                        // Lưu ý: Điều này sẽ xóa tất cả các ảnh đã chọn
                        imageInput.value = '';
                    });
                    
                    previewWrapper.appendChild(preview);
                    previewWrapper.appendChild(removeBtn);
                    previewContainer.appendChild(previewWrapper);
                }
                
                reader.readAsDataURL(file);
            }
        });
    }
    
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
    
    // Thêm hàm hiển thị thông báo
    function showNotification(type, message) {
        // Sanitize the type
        if (type !== 'success' && type !== 'error') {
            type = 'error'; // Default to error for unknown types
        }
        
        // Ensure message is a string
        if (typeof message !== 'string') {
            if (message && typeof message === 'object') {
                try {
                    message = JSON.stringify(message);
                } catch (e) {
                    message = 'Đã xảy ra lỗi không xác định';
                }
            } else {
                message = 'Đã xảy ra lỗi không xác định';
            }
        }
        
        // Create and add notification to DOM
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
    
    // Xử lý nút Mua ngay
    const buyNowBtn = document.querySelector('.btn-buy-now');
    if (buyNowBtn) {
        buyNowBtn.addEventListener('click', function() {
            const productId = addToCartBtn.getAttribute('data-product-id');
            const quantity = parseInt(quantityInput.value);
            
            // Validate số lượng
            if (quantity < 1) {
                showNotification('error', 'Số lượng không hợp lệ');
                return;
            }
            
            // Thêm vào giỏ hàng và chuyển hướng đến trang thanh toán
            window.location.href = `/Product/buyNow/${productId}?quantity=${quantity}`;
        });
    }
    
    // Xử lý gửi đánh giá AJAX
    const reviewForm = document.querySelector('.review-form');
    if (reviewForm) {
        reviewForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Hiển thị trạng thái loading
            const submitBtn = this.querySelector('.btn-submit-review');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang gửi...';
            submitBtn.disabled = true;
            
            const formData = new FormData(this);
            
            fetch('/Product/addReview', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                // Kiểm tra Content-Type
                const contentType = response.headers.get('Content-Type');
                logDebugInfo('Response Headers', {
                    contentType,
                    status: response.status,
                    statusText: response.statusText
                });
                
                if (!response.ok) {
                    throw new Error(`Lỗi kết nối đến server (${response.status})`);
                }
                
                if (!contentType || !contentType.includes('application/json')) {
                    return response.text().then(text => {
                        logDebugInfo('Non-JSON Response', text.substring(0, 1000));
                        throw new Error('Server không trả về JSON. Vui lòng liên hệ quản trị viên.');
                    });
                }
                
                return response.json();
            })
            .then(data => {
                logDebugInfo('Response Data', data);
                
                if (data.success) {
                    // Hiển thị thông báo thành công
                    showNotification('success', data.message);
                    
                    // Reset form
                    reviewForm.reset();
                    
                    // Xóa preview ảnh nếu có
                    const previewContainer = document.querySelector('.image-preview-container');
                    if (previewContainer) {
                        previewContainer.innerHTML = '';
                    }
                    
                    // Làm mới trang để hiển thị đánh giá mới
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    throw new Error(data.message || 'Có lỗi xảy ra khi gửi đánh giá');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('error', error.message || 'Có lỗi xảy ra, vui lòng thử lại sau.');
                
                // Log lỗi để debug
                logDebugInfo('Error Details', {
                    name: error.name,
                    message: error.message,
                    stack: error.stack
                });
            })
            .finally(() => {
                // Khôi phục nút sau khi hoàn thành
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
        });
    }
    
    // Debug helper - Giúp theo dõi lỗi trong console
    function logDebugInfo(title, data) {
        console.group('DEBUG: ' + title);
        console.log(data);
        console.groupEnd();
    }
});
</script>

<?php include 'app/views/shares/footer.php'; ?>