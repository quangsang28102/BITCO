# AGENT WORKFLOW & RULES: DỰ ÁN WORDPRESS BITCO

## 1. BỐI CẢNH DỰ ÁN
* **Khách hàng:** Công ty Cổ phần Gạch Tuy Nen Bình Định - BITCO (Lĩnh vực: Sản xuất & cung cấp vật liệu xây dựng, gạch tuynel).
* **Nhiệm vụ cốt lõi:** Chuyển đổi bộ giao diện HTML/CSS tĩnh có sẵn thành một Custom WordPress Theme (`bitco-theme`) chuẩn cấu trúc, tối ưu hiệu năng và dễ dàng quản trị nội dung.
* **Vai trò của Agent:** Đóng vai trò Senior WordPress Developer. Tuân thủ nghiêm ngặt quy trình 3 giai đoạn bên dưới. **TUYỆT ĐỐI KHÔNG tự ý viết code theme khi chưa hoàn thành Giai đoạn 1 và Giai đoạn 2.**

---

## 2. QUY TRÌNH THỰC HIỆN (BẮT BUỘC TUÂN THỦ)

### GIAI ĐOẠN 1: KHẢO SÁT & HỎI DỮ KIỆN (DISCOVERY)
Ngay khi được kích hoạt và đọc file này, Agent phải thực hiện các bước sau:
1. Kiểm tra nhanh cấu trúc thư mục hiện tại của workspace để nhận diện vị trí cài đặt WordPress (`wp-content/themes/`).
2. Dừng lại và đặt một danh sách câu hỏi ngắn gọn, rõ ràng cho người dùng để thu thập đủ dữ kiện kỹ thuật, bao gồm:
   * **Vị trí Source HTML/CSS:** Thư mục chứa file HTML/CSS/JS/Images tĩnh hiện đang nằm ở đâu? (Hoặc yêu cầu người dùng copy vào thư mục tạm).
   * **Danh sách các trang:** Bộ HTML hiện có bao nhiêu trang giao diện? (Ví dụ: Trang chủ, Giới thiệu, Sản phẩm, Chi tiết sản phẩm, Dự án, Tin tức, Liên hệ...).
   * **Công nghệ Frontend đang dùng:** Source tĩnh đang dùng CSS thuần, Bootstrap, Tailwind CSS, hay thư viện JS nào (jQuery, Swiper, AOS...)?
   * **Plugin hỗ trợ:** Người dùng có dùng **ACF Pro** (hoặc ACF miễn phí / Meta Box) để quản lý Custom Fields không? Dùng plugin nào cho Form liên hệ/báo giá (Contact Form 7, WPForms, hay code thuần)?
   * **Yêu cầu đặc thù:** Có tính năng riêng nào cần lưu ý không (Ví dụ: Bộ lọc sản phẩm AJAX, nút tải catalogue PDF, form báo giá tự động điền tên loại gạch, đa ngôn ngữ...)?

### GIAI ĐOẠN 2: LẬP BẢN ĐẶC TẢ KỸ THUẬT (`SPEC.md`)
Sau khi người dùng trả lời đầy đủ các câu hỏi ở Giai đoạn 1:
1. Agent tự động phân tích toàn bộ các file trong thư mục HTML nguồn mà người dùng đã cung cấp.
2. Tổng hợp và tạo ra file `SPEC.md` nằm trong thư mục `wp-content/themes/bitco-theme/SPEC.md` với các nội dung chi tiết:
   * **Cấu trúc thư mục Theme:** Liệt kê toàn bộ file template PHP sẽ tạo (`front-page.php`, `archive-san-pham.php`, `single-san-pham.php`, v.v.).
   * **Kiến trúc dữ liệu (Data Modeling):**
     * Danh sách Custom Post Types (CPT) và Custom Taxonomies cần đăng ký.
     * Bảng ánh xạ chi tiết từng block nội dung trên HTML sang các trường Custom Fields (tên field, kiểu dữ liệu, vị trí hiển thị).
   * **Chiến lược nhúng Assets:** Danh sách file CSS/JS cần enqueue và thứ tự tải.
3. Trình bày tóm tắt file `SPEC.md` và **xin xác nhận (Approve)** từ người dùng trước khi chuyển sang Giai đoạn 3.

### GIAI ĐOẠN 3: TRIỂN KHAI CODE THEO TỪNG MODULE (EXECUTION)
Chỉ bắt đầu viết code sau khi người dùng duyệt `SPEC.md`. Thực hiện tuần tự từng bước nhỏ, kiểm tra xong bước này mới qua bước tiếp theo:
* **Bước 3.1 (Khung sườn):** Khởi tạo `style.css`, `functions.php`, `header.php`, `footer.php`, di chuyển thư mục `assets/` và enqueue toàn bộ CSS/JS chuẩn WordPress.
* **Bước 3.2 (Dữ liệu động):** Viết code đăng ký CPT, Taxonomy và xuất file cấu hình ACF JSON (nếu dùng ACF) để import nhanh.
* **Bước 3.3 (Chuyển đổi Template):** Lần lượt chuyển đổi từng trang từ HTML sang PHP, thay thế dữ liệu tĩnh bằng `WP_Query` và `get_field()`.
* **Bước 3.4 (Dọn dẹp):** Xóa thư mục HTML nguồn tạm thời sau khi hoàn tất và bàn giao.

---

## 3. QUY TẮC LẬP TRÌNH BẮT BUỘC (CODING STANDARDS)

1. **Chuẩn WordPress:**
   * Tuân thủ WordPress PHP Coding Standards.
   * Sử dụng Text Domain thống nhất là `'bitco-theme'` cho mọi chuỗi văn bản có thể dịch (`__()`, `_e()`, `esc_html_e()`).
   * Luôn escape dữ liệu đầu ra (`esc_html()`, `esc_url()`, `esc_attr()`, `wp_kses_post()`) để đảm bảo bảo mật.
2. **Quản lý Assets & Đường dẫn:**
   * Tuyệt đối không dùng thẻ `<link>` hoặc `<script>` cứng trong `header.php` / `footer.php`. Toàn bộ phải gọi qua hook `wp_enqueue_scripts` trong `functions.php`.
   * Mọi đường dẫn tĩnh (ảnh logo, icon mặc định) phải dùng `get_template_directory_uri()` hoặc `get_theme_file_uri()`.
3. **Bảo toàn giao diện gốc:**
   * Giữ nguyên 100% cấu trúc thẻ HTML và tên class CSS từ bản thiết kế gốc để không làm vỡ giao diện hoặc hỏng hiệu ứng JS.
   * Khi tích hợp Contact Form 7 hoặc menu `wp_nav_menu()`, phải cấu hình tham số hoặc custom walker để khớp với class CSS của HTML gốc.
4. **Tối ưu hiệu năng:**
   * Tách code logic (đăng ký CPT, helper functions, enqueue) thành các file riêng trong thư mục `inc/` và `require_once` vào `functions.php` cho gọn gàng, dễ bảo trì.
   * Sử dụng `WP_Query` có giới hạn `posts_per_page` rõ ràng và luôn gọi `wp_reset_postdata()` sau mỗi vòng lặp phụ.