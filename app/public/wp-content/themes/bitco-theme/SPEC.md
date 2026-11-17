# BẢN ĐẶC TẢ KỸ THUẬT (TECHNICAL SPECIFICATION)
## DỰ ÁN: CHUYỂN ĐỔI GIAO DIỆN BITCO TUY NEN BÌNH ĐỊNH SANG WORDPRESS THEME
**Theme Identifier:** `bitco-theme`  
**Text Domain:** `'bitco-theme'`  
**Kiến trúc:** Custom One-Page Landing Page Theme kết hợp CPT & ACF Free  
**Tác giả:** Senior WordPress Developer  
**Ngày lập đặc tả:** 16/11/2026  

---

## 1. TỔNG QUAN HỆ THỐNG & NGUYÊN TẮC THIẾT KẾ
* **Mục tiêu:** Chuyển đổi mã nguồn HTML/CSS/JS tĩnh từ repository `D:\1.Quang Sang\TuyNen` sang theme WordPress độc quyền `bitco-theme` hoạt động hoàn hảo trên WordPress 6.x / PHP 8.x.
* **Chi phí bản quyền:** **0 VNĐ (100% Free)**:
  * Sử dụng **ACF Free** (hoặc Custom Fields thuần) để quản lý cấu hình các section.
  * Sử dụng **Custom Post Types (CPT) PHP thuần** cho *Dự Án* và *Sản Phẩm*, không cần trả phí cho ACF Pro Repeater.
  * Sử dụng **Contact Form 7 + Flamingo** cho toàn bộ việc tiếp nhận và lưu trữ báo giá/liên hệ.
* **Bảo toàn giao diện gốc:** Giữ nguyên 100% class CSS, thẻ HTML và dữ liệu thuộc tính `data-*` để tương thích tuyệt đối với các hiệu ứng JavaScript (xoay viên gạch 3D CSS, thợ xây ném gạch giữa các section, kính lúp zoom, counter số, mouse glow).

---

## 2. CẤU TRÚC THƯ MỤC THEME (`bitco-theme`)

```text
wp-content/themes/bitco-theme/
├── assets/
│   ├── css/
│   │   ├── global.css              # Biến màu sắc, typography, reset và layout chung
│   │   ├── header.css              # Sticky header, menu desktop và mobile navigation
│   │   ├── hero.css                # Hero section, aura glowing và 2 stats card
│   │   ├── about.css               # Giới thiệu 25 năm, badge uy tín, ảnh nhà máy
│   │   ├── products.css            # Khối 3D product showcase, view mode tabs, bảng spec
│   │   ├── advantages.css          # Lưới 4 thế mạnh và hiệu ứng mouse glow
│   │   ├── parallax.css            # 2 banner parallax toàn màn hình
│   │   ├── projects.css            # Lưới các công trình tiêu biểu và badge loại gạch
│   │   ├── contact.css             # Thông tin liên hệ và form tư vấn/báo giá
│   │   └── footer.css              # Footer 4 cột và dải bản quyền
│   ├── js/
│   │   └── main.js                 # 100% logic tương tác 3D, scroll, counters, brick drop
│   └── images/
│       ├── hero_bg.png             # Ảnh nền hero & parallax banner 2
│       ├── factory.png             # Ảnh nhà máy sản xuất BITCO & parallax banner 1
│       ├── clay_bricks.png         # Ảnh mẫu gạch đất sét
│       ├── clay_solid_real.png     # Ảnh chụp thực tế gạch đặc
│       ├── clay_6hole_real.png     # Ảnh chụp thực tế gạch 6 lỗ tròn
│       ├── aac_blocks.png          # Ảnh đồ họa gạch nhẹ AAC
│       └── aac_block_real.png      # Ảnh chụp thực tế gạch nhẹ AAC
├── inc/
│   ├── custom-post-types.php       # Đăng ký CPT 'du-an' và 'san-pham'
│   ├── custom-fields.php           # Đăng ký cấu hình ACF Free cho Front Page & CPTs
│   ├── enqueue.php                 # Quản lý wp_enqueue_scripts và wp_localize_script
│   └── template-tags.php           # Helper functions, render SVG thợ xây, fallback defaults
├── template-parts/
│   ├── section-hero.php            # Khối Hero Banner & Thống kê
│   ├── section-about.php           # Khối Giới thiệu & Hành trình 25 năm
│   ├── section-parallax-green.php  # Banner Parallax 1: Vật liệu xanh
│   ├── section-products.php        # Khối Trình diễn sản phẩm 3D tương tác
│   ├── section-advantages.php      # Khối Thế mạnh cốt lõi (4 cards)
│   ├── section-parallax-projects.php # Banner Parallax 2: Công trình trọng điểm
│   ├── section-projects.php        # Khối Dự án tiêu biểu (CPT Loop)
│   ├── section-contact.php         # Khối Thông tin liên hệ & CF7 form
│   └── builder-svg.php             # Component SVG nhân vật thợ xây tương tác
├── 404.php                         # Trang báo lỗi 404
├── footer.php                      # Chân trang WordPress chuẩn (wp_footer)
├── front-page.php                  # Template trang chủ chính điều phối các sections
├── functions.php                   # File khởi tạo theme và load các module trong inc/
├── header.php                      # Đầu trang WordPress chuẩn (wp_head)
├── index.php                       # Template dự phòng theo chuẩn WordPress
├── screenshot.png                  # Ảnh đại diện của theme trong Theme Manager
├── SPEC.md                         # Tài liệu đặc tả kỹ thuật này
└── style.css                       # Khai báo Metadata theme và text domain
```

---

## 3. KIẾN TRÚC DỮ LIỆU & ÁNH XẠ CUSTOM FIELDS (DATA MODELING)

### 3.1. Custom Post Types (Đăng ký qua PHP thuần trong `inc/custom-post-types.php`)

#### 1. CPT `du-an` (Dự án tiêu biểu):
* **Labels:** Dự Án / Quản lý Dự Án BITCO
* **Supports:** `title`, `thumbnail` (Featured Image), `editor` / `excerpt` (Mô tả dự án).
* **Custom Meta Fields (ACF Free / Post Meta):**
  * `project_location` (Text): Vị trí công trình (VD: "Quy Nhơn, Bình Định").
  * `project_badge_text` (Text): Nhãn phân loại gạch (VD: "AAC & ALC Panel" hoặc "Gạch đặc Tuy Nen").
  * `project_badge_style` (Select): `badge-eco` (Xanh lục) hoặc `badge-clay` (Cam gạch).

#### 2. CPT `san-pham` (Sản phẩm 3D Showcase):
* **Labels:** Sản Phẩm / Sản Phẩm BITCO
* **Supports:** `title`, `thumbnail` (Ảnh thực tế sản phẩm), `excerpt`.
* **Custom Meta Fields (ACF Free / Post Meta):**
  * `product_slug_id` (Text / Slug): `clay-6hole`, `clay-solid`, `aac-block` (khớp với class CSS 3D).
  * `product_category` (Text): Phân loại (VD: "Gạch Đất Sét Nung", "Vật Liệu Xanh (Eco-Friendly)").
  * `metric_strength` (Number): Tỷ lệ chịu lực % (VD: `75` hoặc `95`).
  * `metric_insulation` (Number): Tỷ lệ cách âm/cách nhiệt % (VD: `80` hoặc `98`).
  * `metric_saving` (Number): Tỷ lệ tối ưu tải trọng % (VD: `45` hoặc `90`).
  * `spec_dimension` (Text): Kích thước (VD: "220 x 105 x 150 mm").
  * `spec_strength` (Text): Cường độ nén (VD: "≥ 50 kg/cm²").
  * `spec_water_absorption` (Text): Độ hút nước (VD: "≤ 12%").
  * `spec_weight` (Text): Khối lượng viên hoặc thể tích.
  * `hotspots_json` (Textarea): JSON mảng các điểm hotspot tương tác trên mặt gạch.
* **Cơ chế Fallback an toàn:** Nếu người dùng chưa thêm bài viết trong CPT `san-pham`, theme sẽ tự động xuất mảng dữ liệu mặc định gốc (3 sản phẩm chuẩn: Gạch 6 Lỗ, Gạch Đặc, Gạch Nhẹ AAC) sang `bitcoProductsData` để không bao giờ bị lỗi hiển thị.

---

### 3.2. Bảng ánh xạ Custom Fields trên Trang Chủ (`front-page.php`)
Tất cả các trường sau được đăng ký vào Field Group gán cho Page Template: **Front Page (Trang Chủ)**:

| Block HTML | Tên Field ACF | Kiểu Field | Giá trị mặc định / Mô tả |
| :--- | :--- | :--- | :--- |
| **Header** | `header_cta_text` | Text | "Tư vấn ngay" |
| | `header_cta_link` | Text / URL | "#contact" |
| **Hero** | `hero_tagline` | Text | "Tiêu chuẩn xây dựng tương lai" |
| | `hero_title` | Text / Textarea | "Kiến Tạo Bền Vững<br>Với <span>Gạch Tuy Nen & AAC</span>" |
| | `hero_description` | Textarea | Giới thiệu năng lực tiên phong tại miền Trung... |
| | `hero_stat1_number` | Number | `50` |
| | `hero_stat1_suffix` | Text | "M+" |
| | `hero_stat1_label` | Text | "Viên gạch nung / Năm" |
| | `hero_stat2_number` | Number | `100` |
| | `hero_stat2_suffix` | Text | "K m³" |
| | `hero_stat2_label` | Text | "Gạch nhẹ AAC / Năm" |
| **About Us** | `about_badge_title` | Text | "BITCO Bình Định" |
| | `about_badge_desc` | Text | "Thành lập từ 2001 - Hơn 25 năm uy tín" |
| | `about_tag` | Text | "Hành trình & Giá trị" |
| | `about_title` | Text | "25 Năm Đi Cùng Các Công Trình Đất Việt" |
| | `about_story_1` | Textarea | Tiền thân từ các đơn vị sản xuất gạch ngói lâu đời... |
| | `about_story_2` | Textarea | Với tầm nhìn xanh, chúng tôi đã chủ động đầu tư... |
| | `about_feature1_title` | Text | "Đơn vị dẫn đầu khu vực" |
| | `about_feature1_desc` | Text | "Năng lực cung ứng khổng lồ cho thị trường..." |
| | `about_feature2_title` | Text | "Đột phá Vật Liệu Xanh" |
| | `about_feature2_desc` | Text | "Nhà máy AAC & Panel ALC lõi thép có cách âm..." |
| **Parallax 1** | `parallax1_title` | Text | "Phát Triển Vật Liệu Xanh Vì Môi Trường Bền Vững" |
| | `parallax1_desc` | Textarea | Áp dụng tiêu chuẩn xanh vào từng quy trình sản xuất... |
| | `parallax1_btn_text` | Text | "Nhận tư vấn vật liệu xanh" |
| **Advantages** | `adv_tag` | Text | "Thế mạnh cốt lõi" |
| | `adv_title` | Text | "Tại Sao Các Nhà Thầu Lựa Chọn BITCO?" |
| | `adv_subtitle` | Text | "Sự đồng hành bền vững đến từ công nghệ sản xuất..." |
| | `adv1_title` / `adv1_desc` | Text / Textarea | Lò Nung Tuy Nen Tự Động (Icon: microchip) |
| | `adv2_title` / `adv2_desc` | Text / Textarea | Thân Thiện Môi Trường (Icon: leaf) |
| | `adv3_title` / `adv3_desc` | Text / Textarea | Chống Cháy Đến 4 Giờ (Icon: fire-shield) |
| | `adv4_title` / `adv4_desc` | Text / Textarea | Tối Ưu 30% Chi Phí (Icon: wallet) |
| **Parallax 2** | `parallax2_title` | Text | "Đồng Hành Cùng Những Công Trình Trọng Điểm" |
| | `parallax2_desc` | Textarea | Năng lực sản xuất lớn cung ứng hàng ngàn dự án... |
| | `parallax2_btn_text` | Text | "Liên hệ nhận catalog & mẫu thử" |
| **Contact Info**| `contact_address` | Text | "Km 1215, Quốc lộ 1A, xã Phước Lộc, Tuy Phước, Bình Định" |
| | `contact_hotline` | Text | "0256 3832 176 - 0256 3832 809" |
| | `contact_email` | Text | "info@bitcobinhdinh.com.vn" |
| | `contact_working_hours` | Text | "Thứ 2 - Thứ 7: 07:30 - 17:00 (Chủ nhật nghỉ)" |
| | `contact_cf7_shortcode` | Text | Shortcode Form Contact Form 7 (để nhúng form động) |
| **Footer Info** | `footer_stock_code` | Text | "Mã Cổ Phiếu: BTN (Sàn UPCoM)" |
| | `footer_facebook_url` | Text / URL | Link Fanpage BITCO |
| | `footer_youtube_url` | Text / URL | Link Kênh Youtube |
| | `footer_copyright_text` | Text | "© 2026 Công ty Cổ phần Đầu tư BITCO Bình Định..." |

---

## 4. CHIẾN LƯỢC NHÚNG TÀI NGUYÊN (ASSETS ENQUEUEING)

Tuân thủ nghiêm ngặt quy tắc WordPress Coding Standards: Toàn bộ CSS/JS được nạp qua hook `wp_enqueue_scripts` trong file `inc/enqueue.php`. Không dùng thẻ `<link>` hoặc `<script>` tĩnh trong header/footer.

### 4.1. Thứ tự Enqueue Stylesheets:
1. `google-fonts-bevietnam`: Google Fonts `Be Vietnam Pro` (Weights: 300;400;500;600;700;800;900) tải từ Google Fonts CDN có preconnect.
2. `font-awesome-6`: `https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css`.
3. `bitco-global`: `assets/css/global.css` (Style nền tảng).
4. `bitco-header`: `assets/css/header.css`.
5. `bitco-hero`: `assets/css/hero.css`.
6. `bitco-about`: `assets/css/about.css`.
7. `bitco-products`: `assets/css/products.css`.
8. `bitco-advantages`: `assets/css/advantages.css`.
9. `bitco-projects`: `assets/css/projects.css`.
10. `bitco-contact`: `assets/css/contact.css`.
11. `bitco-footer`: `assets/css/footer.css`.
12. `bitco-parallax`: `assets/css/parallax.css`.
13. `bitco-style`: `style.css` (Khai báo theme & custom overrides).

### 4.2. Thứ tự Enqueue Scripts & Localization:
1. `bitco-main`: `assets/js/main.js` (Dependencies: `[]`, version: theme version, footer: `true`).
2. **Data Localization:** Gọi `wp_localize_script('bitco-main', 'bitcoData', ...)` để truyền:
   * `ajaxUrl`: `admin_url('admin-ajax.php')`
   * `themeUri`: `get_template_directory_uri()`
   * `products`: Mảng thông số kỹ thuật 3D từ CPT `san-pham` (hoặc fallback mặc định chuẩn gốc).

---

## 5. TÍCH HỢP FORM LIÊN HỆ CONTACT FORM 7

Form trong giao diện HTML gốc sử dụng hiệu ứng **Floating Label** với cấu trúc:
```html
<div class="form-group">
  <input type="text" id="contactName" class="form-input" placeholder=" " required>
  <label for="contactName" class="form-label">Họ và tên của bạn *</label>
</div>
```

Khi tích hợp sang Contact Form 7, mã mẫu form sẽ được cấu hình chính xác:
```text
<div class="form-group">
  [text* contact-name class:form-input id:contactName placeholder " "]
  <label for="contactName" class="form-label">Họ và tên của bạn *</label>
</div>

<div class="form-group">
  [tel* contact-phone class:form-input id:contactPhone placeholder " "]
  <label for="contactPhone" class="form-label">Số điện thoại liên hệ *</label>
</div>

<div class="form-group">
  [email contact-email class:form-input id:contactEmail placeholder " "]
  <label for="contactEmail" class="form-label">Địa chỉ Email</label>
</div>

<div class="form-group form-group-textarea">
  [textarea* contact-message class:form-input class:form-textarea id:contactMessage placeholder " "]
  <label for="contactMessage" class="form-label">Nội dung yêu cầu (VD: Loại gạch cần mua, khối lượng ước tính...) *</label>
</div>

<button type="submit" class="btn btn-primary form-submit-btn">Gửi thông tin tư vấn <i class="fa-solid fa-paper-plane"></i></button>
```
* **Lưu ý:** Nếu người dùng chưa cài hoặc chưa tạo form Contact Form 7, section liên hệ sẽ tự động hiển thị form HTML tĩnh dự phòng để đảm bảo giao diện luôn hiển thị đầy đủ, không bị rỗng.

---

## 6. QUY TRÌNH THỰC THI GIAI ĐOẠN 3 (EXECUTION PHASES)
Sau khi người dùng Approve file `SPEC.md` này:
* **Bước 3.1: Khởi tạo Khung sườn Theme (`bitco-theme`)**
  * Tạo `style.css`, `functions.php`, `header.php`, `footer.php`, `index.php`, `404.php`.
  * Sao chép toàn bộ thư mục `css/`, `js/`, `images/` từ `D:\1.Quang Sang\TuyNen` vào `assets/` của theme.
  * Viết code enqueue CSS/JS chuẩn trong `inc/enqueue.php`.
* **Bước 3.2: Khởi tạo CPT & Dữ liệu động**
  * Viết `inc/custom-post-types.php` đăng ký CPT `du-an` và `san-pham`.
  * Viết `inc/template-tags.php` chứa helper functions và dữ liệu fallback.
* **Bước 3.3: Lắp ráp Front Page & Template Parts**
  * Tách nhỏ từng section thành các template part trong thư mục `template-parts/`.
  * Lắp ráp hoàn chỉnh vào `front-page.php`.
  * Cấu hình `wp_localize_script` truyền biến dữ liệu an toàn cho `main.js`.
* **Bước 3.4: Kiểm tra và Nghiệm thu hoàn thiện**
  * Kiểm tra tính toàn vẹn của giao diện, hiệu ứng 3D, responsive trên di động.
  * Hướng dẫn kích hoạt theme trên WordPress Admin.
