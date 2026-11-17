# BITCO TUY NEN BÌNH ĐỊNH - CUSTOM WORDPRESS THEME

> **Dự án chuyển đổi giao diện tĩnh (HTML5/CSS3/Vanilla JS) sang Custom WordPress Theme chuẩn cấu trúc Modular, tích hợp Live Customizer chuẩn Flatsome và tương tác 3D CSS.**

[![WordPress](https://img.shields.io/badge/WordPress-6.x%20Ready-blue.svg?logo=wordpress)](https://wordpress.org)
[![PHP](https://img.shields.io/badge/PHP-7.4%20|%208.2-purple.svg?logo=php)](https://php.net)
[![Vanilla JS](https://img.shields.io/badge/JavaScript-100%25%20Vanilla%20ES6+-yellow.svg?logo=javascript)](https://developer.mozilla.org)
[![License: GPL v2+](https://img.shields.io/badge/License-GPL%20v2+-green.svg)](https://www.gnu.org/licenses/gpl-2.0.html)
[![Zero Plugin Dependency](https://img.shields.io/badge/Plugins-0%20Required-success.svg)](#)

---

## 📖 1. Giới thiệu Dự án

* **Khách hàng / Doanh nghiệp:** Công ty Cổ phần Đầu tư BITCO Bình Định (Mã CK: `BTN` - Sàn UPCoM).
* **Lĩnh vực:** Sản xuất gạch nung Tuy Nen truyền thống và giải pháp vật liệu xanh (Bê tông khí chưng áp AAC, Panel ALC lõi thép tiêu chuẩn Đức).
* **Mục tiêu kỹ thuật:** Chuyển đổi mã nguồn tĩnh thành Custom Theme WordPress độc quyền (`bitco-theme`) đạt chuẩn **WordPress Coding Standards**, tốc độ tải trang cao (90+ PageSpeed), cấu trúc component module hóa, và cung cấp khả năng quản trị chuyên sâu thời gian thực (Live Preview).

---

## 🚀 2. Điểm Nhấn Kiến Trúc Kỹ Thuật (Architecture Highlights)

### 2.1. Quản trị Chuyên Sâu Chuẩn Flatsome (WordPress Customizer API)
* **Live Preview thời gian thực:** Can thiệp toàn bộ giao diện thông qua bảng điều khiển `Giao diện -> Tùy biến` (`Appearance -> Customize`). Mọi thay đổi text, màu sắc hay ẩn hiện section đều cập nhật trực tiếp không cần tải lại trang nhờ cơ chế `postMessage`.
* **CSS Custom Properties (Variables):** Bảng chọn màu Hex cho phép thay đổi màu chủ đạo (Primary Color `#e8590c`), màu phụ (Secondary `#29a366`), màu nền tối Dark Background... được tiêm động vào thẻ `:root`.
* **Media Uploaders:** Tích hợp bộ tải ảnh gốc WordPress (`WP_Customize_Image_Control`) cho phép thay thế:
  * Ảnh nền khối Hero Banner.
  * Ảnh nhà máy sản xuất (Khối Giới thiệu 25 năm).
  * Ảnh nền 2 Banner Parallax toàn màn hình.
  * Logo công ty (Header & Footer).
* **Bật / Tắt Ẩn Hiện Section:** Cho phép bật/tắt độc lập 8 khối nội dung bằng Checkbox.

### 2.2. Trình Diễn Tương Tác 3D CSS & Magnifier Zoom
* **CSS 3D Transforms:** Mô hình viên gạch 3D xoay tự do theo chuyển động chuột hoặc cảm ứng vuốt màn hình mà không cần nạp thư viện Three.js nặng nề.
* **Kính lúp zoom cận cảnh (Magnifier):** Chế độ soi chi tiết bề mặt và độ nhám bám vữa của viên gạch thực tế.
* **Animation Nhân vật Thợ xây:** Hiệu ứng ném và bắt gạch giữa các khối khi cuộn trang bằng Vanilla JavaScript kết hợp `IntersectionObserver`.

### 2.3. Cơ Chế Lấy Dữ Liệu 3 Lớp An Toàn (3-Tier Fallback Data Pattern)
Theme sử dụng helper function `bitco_get_field()` truy xuất dữ liệu theo thứ tự ưu tiên:
1. `Lớp 1`: Dữ liệu Live Customizer (`get_theme_mod()`).
2. `Lớp 2`: Dữ liệu Trang Cấu hình riêng hoặc ACF (`get_option()` / `get_field()`).
3. `Lớp 3`: Dữ liệu mặc định gốc (Hardcoded Fallback).
👉 **Đảm bảo website không bao giờ bị lỗi hiển thị hay mất bố cục kể cả khi database chưa có dữ liệu.**

### 2.4. Custom Post Types (100% Free / Native PHP)
* **CPT `du-an` (Dự Án BITCO):** Quản lý không giới hạn các công trình (Tên, Ảnh đại diện, Vị trí địa lý, Nhãn vật liệu, Màu sắc nhãn badge-eco / badge-clay).
* **CPT `san-pham` (Sản Phẩm 3D):** Quản lý thông số kỹ thuật (Kích thước, Cường độ nén, Độ hút nước, % Chịu lực, % Cách âm, % Tải trọng, Điểm hotspot tương tác).

---

## 📂 3. Cấu Trúc Thư Mục Theme (`bitco-theme`)

```text
app/public/wp-content/themes/bitco-theme/
├── assets/
│   ├── css/
│   │   ├── global.css              # Design system: màu sắc, typography, reset layout
│   │   ├── header.css              # Navigation, mobile drawer, sticky behavior
│   │   ├── hero.css                # Hero visual, aura glow, 2 stats counter cards
│   │   ├── about.css               # Giới thiệu 25 năm, badge uy tín, ảnh nhà máy
│   │   ├── products.css            # Khối 3D product showcase, view mode tabs, bảng spec
│   │   ├── advantages.css          # Lưới 4 thế mạnh và hiệu ứng vệt sáng chuột 3D
│   │   ├── parallax.css            # 2 banner parallax toàn màn hình
│   │   ├── projects.css            # Lưới các công trình tiêu biểu và badge loại gạch
│   │   ├── contact.css             # Thông tin liên hệ và form tư vấn/báo giá
│   │   └── footer.css              # Footer 4 cột và dải bản quyền
│   ├── js/
│   │   ├── main.js                 # 100% logic tương tác 3D, scroll, counters, brick drop
│   │   └── customizer-preview.js   # Live postMessage handlers cho Customizer
│   └── images/                     # Tài nguyên ảnh gốc độ phân giải cao
├── inc/
│   ├── custom-post-types.php       # Đăng ký CPT 'du-an' và 'san-pham' kèm Meta Boxes
│   ├── custom-fields.php           # Tích hợp cấu hình ACF JSON nếu người dùng cài ACF
│   ├── customizer.php              # Đăng ký Theme Customizer Panels, Controls & CSS
│   ├── admin-options.php           # Trang cài đặt chuyên biệt 'Cấu hình Trang Chủ'
│   ├── enqueue.php                 # Quản lý wp_enqueue_scripts và wp_localize_script
│   └── template-tags.php           # Helper functions, fallback defaults, SVG renderers
├── template-parts/
│   ├── builder-svg.php             # Component tái sử dụng: Nhân vật thợ xây hoạt họa
│   ├── section-hero.php            # Khối Hero Banner & Thống kê
│   ├── section-about.php           # Khối Giới thiệu & Hành trình 25 năm
│   ├── section-parallax-green.php  # Banner Parallax 1: Vật liệu xanh
│   ├── section-products.php        # Khối Trình diễn sản phẩm 3D tương tác
│   ├── section-advantages.php      # Khối Thế mạnh cốt lõi (4 cards)
│   ├── section-parallax-projects.php # Banner Parallax 2: Công trình trọng điểm
│   ├── section-projects.php        # Khối Dự án tiêu biểu (CPT Loop)
│   └── section-contact.php         # Khối Thông tin liên hệ & CF7 form
├── acf-json/                       # Tệp JSON tự động đồng bộ trường dữ liệu ACF
├── 404.php                         # Trang báo lỗi 404
├── footer.php                      # Chân trang WordPress chuẩn (wp_footer)
├── front-page.php                  # Template trang chủ chính điều phối các sections
├── functions.php                   # File khởi tạo theme và load các module trong inc/
├── header.php                      # Đầu trang WordPress chuẩn (wp_head)
├── index.php                       # Template dự phòng theo chuẩn WordPress
├── screenshot.png                  # Ảnh đại diện của theme trong Theme Manager
├── SPEC.md                         # Bản đặc tả kỹ thuật chi tiết
└── style.css                       # Khai báo Metadata theme và text domain
```

---

## 🛠️ 4. Hướng Dẫn Cài Đặt (Installation)

### Cách 1: Sử dụng trong môi trường LocalWP (Local by Flywheel)
1. Clone repo về máy:
   ```bash
   git clone https://github.com/quangsang28102/BITCO.git
   ```
2. Đặt thư mục theme tại: `wp-content/themes/bitco-theme/`.
3. Khởi động site trong LocalWP.
4. Đăng nhập vào WordPress Admin (`/wp-admin`).
5. Vào **Giao diện (Appearance)** -> **Giao diện (Themes)** -> Kích hoạt **BITCO Tuy Nen Binh Dinh**.
6. Vào **Cài đặt (Settings)** -> **Đọc (Reading)** -> Đặt *Trang chủ tĩnh (A static page)* là trang **Trang Chủ**.

### Cách 2: Tải lên hosting bất kỳ
1. Nén toàn bộ thư mục `app/public/wp-content/themes/bitco-theme` thành file `bitco-theme.zip`.
2. Vào trang quản trị WordPress -> **Appearance** -> **Themes** -> **Add New** -> **Upload Theme**.
3. Chọn file `bitco-theme.zip` và bấm **Activate**.

---

## 🛡️ 5. Tiêu Chuẩn Lập Trình & Bảo Mật (Coding Standards)

* **WordPress PHP Coding Standards:** Tuân thủ cấu trúc thụt đầu dòng, đặt tên hàm theo tiền tố `bitco_`.
* **Bảo mật Output Escaping:** 100% dữ liệu hiển thị đều được escape qua `esc_html()`, `esc_url()`, `esc_attr()`, `wp_kses_post()`.
* **Sanitization:** Dữ liệu nhập từ Customizer và Admin Options đều được kiểm tra hợp lệ qua `sanitize_text_field()`, `sanitize_hex_color()`, `esc_url_raw()`.
* **Tương thích dịch thuật:** Sử dụng Text Domain `'bitco-theme'` cho toàn bộ chuỗi văn bản.

---

## 👨‍💻 Tác giả
* **Phát triển bởi:** Quang Sang
* **Email:** xidaunguyen0128@gmail.com
* **GitHub:** [@quangsang28102](https://github.com/quangsang28102)
