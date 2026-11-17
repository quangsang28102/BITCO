/* ==========================================================================
   MAIN JAVASCRIPT - BITCO TUY NEN BINH DINH
   ========================================================================== */

document.addEventListener('DOMContentLoaded', () => {
  initMobileMenu();
  initStickyHeader();
  initScrollReveal();
  initProductTabs();
  initAdvantageCardGlow();
  initStatsCounters();
  initSmoothScroll();
  initHeroParallax();
  initScrollBrickDrop();
});

/**
 * 1. Mobile Menu Control
 */
function initMobileMenu() {
  const menuToggle = document.getElementById('menuToggle');
  const navMenu = document.getElementById('navMenu');
  const navLinks = document.querySelectorAll('.nav-link');

  if (menuToggle && navMenu) {
    menuToggle.addEventListener('click', () => {
      menuToggle.classList.toggle('open');
      navMenu.classList.toggle('open');
    });

    // Close menu when clicking a link
    navLinks.forEach(link => {
      link.addEventListener('click', () => {
        menuToggle.classList.remove('open');
        navMenu.classList.remove('open');
      });
    });
  }
}

/**
 * 2. Sticky Header Control
 */
function initStickyHeader() {
  const header = document.getElementById('header');
  
  if (header) {
    const handleScroll = () => {
      if (window.scrollY > 50) {
        header.classList.add('scrolled');
        header.classList.add('scrolled-dark');
      } else {
        header.classList.remove('scrolled');
        header.classList.remove('scrolled-dark');
      }
    };
    
    // Run once on load and bind to scroll
    handleScroll();
    window.addEventListener('scroll', handleScroll);
  }
}

/**
 * 3. Scroll Reveal Animations (Intersection Observer)
 */
function initScrollReveal() {
  const reveals = document.querySelectorAll('.reveal');
  
  const revealCallback = (entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('active');
        // Stop observing once activated to optimize performance
        observer.unobserve(entry.target);
      }
    });
  };
  
  const revealObserver = new IntersectionObserver(revealCallback, {
    root: null, // viewport
    rootMargin: '0px 0px -10% 0px', // trigger slightly before entering viewport
    threshold: 0.15 // 15% of the element visible
  });
  
  reveals.forEach(element => {
    revealObserver.observe(element);
  });
}

/**
 * 4. Product Tab Showcase & 3D Interactive Rotation
 */
function initProduct3DShowcase() {
  const viewport = document.getElementById('sceneViewport');
  const brick = document.getElementById('brickModel');
  if (!viewport || !brick) return;

  let isDragging = false;
  let startX, startY;
  let rotateX = -15;
  let rotateY = -35;

  // Hover dynamic tilt
  viewport.addEventListener('mousemove', (e) => {
    if (isDragging) return;
    const rect = viewport.getBoundingClientRect();
    const width = rect.width;
    const height = rect.height;
    
    const mouseX = e.clientX - rect.left - width / 2;
    const mouseY = e.clientY - rect.top - height / 2;
    
    // Map bounds to tilt range
    const degY = -35 + (mouseX / (width / 2)) * 40; 
    const degX = -15 - (mouseY / (height / 2)) * 30;
    
    brick.style.transform = `rotateX(${degX}deg) rotateY(${degY}deg)`;
  });

  // Reset position slowly on mouse leave
  viewport.addEventListener('mouseleave', () => {
    if (isDragging) return;
    brick.style.transition = 'transform 0.5s ease-out';
    brick.style.transform = `rotateX(-15deg) rotateY(-35deg)`;
  });

  viewport.addEventListener('mouseenter', () => {
    brick.style.transition = 'none';
  });

  // Touch & Drag controls
  const handleStart = (clientX, clientY) => {
    isDragging = true;
    startX = clientX;
    startY = clientY;
    brick.style.transition = 'none';
  };

  const handleMove = (clientX, clientY) => {
    if (!isDragging) return;
    const deltaX = clientX - startX;
    const deltaY = clientY - startY;
    
    rotateY += deltaX * 0.4;
    rotateX -= deltaY * 0.4;
    
    // Prevent full flips
    rotateX = Math.max(-60, Math.min(60, rotateX));
    
    brick.style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
    
    startX = clientX;
    startY = clientY;
  };

  const handleEnd = () => {
    isDragging = false;
    setTimeout(() => {
      if (!isDragging) {
        brick.style.transition = 'transform 1.2s ease-out';
        rotateX = -15;
        rotateY = -35;
        brick.style.transform = `rotateX(-15deg) rotateY(-35deg)`;
      }
    }, 1200);
  };

  viewport.addEventListener('mousedown', (e) => {
    handleStart(e.clientX, e.clientY);
    e.preventDefault(); // Prevent text highlights
  });

  window.addEventListener('mousemove', (e) => {
    if (isDragging) handleMove(e.clientX, e.clientY);
  });

  window.addEventListener('mouseup', () => {
    if (isDragging) handleEnd();
  });

  viewport.addEventListener('touchstart', (e) => {
    if (e.touches.length === 1) {
      handleStart(e.touches[0].clientX, e.touches[0].clientY);
    }
  }, { passive: true });
  
  viewport.addEventListener('touchmove', (e) => {
    if (isDragging && e.touches.length === 1) {
      handleMove(e.touches[0].clientX, e.touches[0].clientY);
    }
  }, { passive: true });
  
  viewport.addEventListener('touchend', () => {
    handleEnd();
  });
}

function initProductTabs() {
  const tabs = document.querySelectorAll('.floating-tab');
  const showcase = document.getElementById('techShowcase');
  const brick = document.getElementById('brickModel');
  const categoryLabel = document.getElementById('productCategory');
  const titleLabel = document.getElementById('productTitle');
  const descLabel = document.getElementById('productDesc');
  const hotspotsContainer = document.getElementById('hotspotsContainer');
  const frontHoles = document.getElementById('frontHoles');
  const backHoles = document.getElementById('backHoles');
  
  const strengthBar = document.getElementById('metricStrengthBar');
  const strengthVal = document.getElementById('metricStrengthVal');
  const insulationBar = document.getElementById('metricInsulationBar');
  const insulationVal = document.getElementById('metricInsulationVal');
  const savingBar = document.getElementById('metricSavingBar');
  const savingVal = document.getElementById('metricSavingVal');
  const techTableBody = document.getElementById('techTableBody');

  const viewModeTabs = document.querySelectorAll('.view-mode-tab');
  const brick3DScene = document.getElementById('brick3DScene');
  const realImageViewport = document.getElementById('realImageViewport');
  const realBrickImage = document.getElementById('realBrickImage');
  const zoomImageWrapper = document.getElementById('zoomImageWrapper');

  if (!tabs.length || !showcase || !brick) return;

  const defaultProductsData = {
    'clay-6hole': {
      category: 'Gạch Đất Sét Nung',
      title: 'Gạch Tuy Nen 6 Lỗ Tròn',
      desc: 'Dòng sản phẩm gạch xây dựng truyền thống phổ biến nhất, tối ưu giữa trọng lượng và khả năng cách âm cách nhiệt nhờ cấu trúc rỗng 6 lỗ tròn.',
      realImg: 'images/clay_6hole_real.png',
      metrics: {
        strength: { val: '75%', percent: 75, color: 'var(--primary)' },
        insulation: { val: '80%', percent: 80, color: 'var(--primary)' },
        saving: { val: '45%', percent: 45, color: 'var(--primary)' }
      },
      specs: [
        { name: 'Kích thước', val: '220 x 105 x 150 mm' },
        { name: 'Cường độ nén', val: '≥ 50 kg/cm²' },
        { name: 'Độ hút nước', val: '≤ 12%' },
        { name: 'Khối lượng viên', val: '~ 2.8 kg' }
      ],
      hotspots: [
        { top: '30%', left: '20%', title: 'Lỗ rỗng cách nhiệt', desc: 'Thiết kế 6 lỗ tròn đối xứng tạo lớp đệm không khí chống nóng và cách âm xuất sắc.' },
        { top: '70%', left: '50%', title: 'Mác chịu lực ổn định', desc: 'Đạt mác M50 chịu lực tốt cho tường bao che của các chung cư và nhà phố.' },
        { top: '40%', left: '80%', title: 'Bề mặt nhám bám vữa', desc: 'Thiết kế các rãnh nhám nhỏ giúp liên kết vữa trát cực kỳ chắc chắn.' }
      ]
    },
    'clay-solid': {
      category: 'Gạch Đất Sét Nung',
      title: 'Gạch Đặc Tuy Nen Cao Cấp',
      desc: 'Được đúc đặc hoàn toàn từ đất sét tự nhiên nung chín ở nhiệt độ cao. Thích hợp cho các hạng mục chịu lực mạnh và chống ẩm tuyệt đối.',
      realImg: 'images/clay_solid_real.png',
      metrics: {
        strength: { val: '95%', percent: 95, color: 'var(--primary)' },
        insulation: { val: '50%', percent: 50, color: 'var(--primary)' },
        saving: { val: '10%', percent: 10, color: 'var(--primary)' }
      },
      specs: [
        { name: 'Kích thước', val: '205 x 95 x 55 mm' },
        { name: 'Cường độ nén', val: '≥ 75 kg/cm² (Mác 75)' },
        { name: 'Độ hút nước', val: '≤ 8%' },
        { name: 'Khối lượng viên', val: '~ 2.2 kg' }
      ],
      hotspots: [
        { top: '35%', left: '25%', title: 'Đúc đặc nguyên khối', desc: 'Không rỗng khí bên trong, mang lại khả năng chịu lực nén tối đa cho phần móng và tường chịu lực.' },
        { top: '65%', left: '75%', title: 'Chống thấm nước vượt trội', desc: 'Mật độ đất sét cao giảm độ hút nước xuống dưới 8%, lý tưởng cho xây bể nước, hố ga.' }
      ]
    },
    'aac-block': {
      category: 'Vật Liệu Xanh (Eco-Friendly)',
      title: 'Gạch Nhẹ Bê Tông Khí Chưng Áp AAC',
      desc: 'Công nghệ sản xuất hiện đại từ Đức. Cấu trúc bọt khí li ti giúp cách âm chống cháy đỉnh cao và giảm tải trọng móng lên tới 30%.',
      realImg: 'images/aac_block_real.png',
      metrics: {
        strength: { val: '85%', percent: 85, color: 'var(--secondary)' },
        insulation: { val: '98%', percent: 98, color: 'var(--secondary)' },
        saving: { val: '90%', percent: 90, color: 'var(--secondary)' }
      },
      specs: [
        { name: 'Kích thước chuẩn', val: '600 x 200 x 100/150/200 mm' },
        { name: 'Khối lượng thể tích', val: '600 - 700 kg/m³' },
        { name: 'Độ chống cháy', val: 'EI 240 (Chống cháy 4 giờ)' },
        { name: 'Hệ số dẫn nhiệt', val: '0.11 - 0.13 W/m.K' }
      ],
      hotspots: [
        { top: '30%', left: '30%', title: 'Cấu trúc bọt khí chưng áp', desc: 'Hàng triệu bọt khí siêu nhỏ phân bổ đều ngăn chặn sự truyền nhiệt và truyền âm.' },
        { top: '70%', left: '70%', title: 'Kích thước lớn chuẩn xác', desc: 'Một viên gạch AAC bằng 8 viên gạch đất nung thông thường, giúp tốc độ xây lên gấp 3 lần.' }
      ]
    }
  };

  const productsData = (window.bitcoData && window.bitcoData.products && Object.keys(window.bitcoData.products).length > 0)
    ? window.bitcoData.products
    : defaultProductsData;

  const updateShowcase = (productId) => {
    const data = productsData[productId];
    if (!data) return;

    // Fade effect
    showcase.style.opacity = '0.3';
    showcase.style.transition = 'opacity 0.25s ease';

    setTimeout(() => {
      // 1. Update brick classes
      brick.className = `brick-3d ${productId}`;
      
      // 2. Update category theme class on container
      if (productId === 'aac-block') {
        showcase.classList.add('green-theme');
      } else {
        showcase.classList.remove('green-theme');
      }

      // 3. Show/hide holes for 6-hole brick
      if (productId === 'clay-6hole') {
        if (frontHoles) frontHoles.style.display = 'grid';
        if (backHoles) backHoles.style.display = 'grid';
      } else {
        if (frontHoles) frontHoles.style.display = 'none';
        if (backHoles) backHoles.style.display = 'none';
      }

      // 4. Update spec sheet text
      categoryLabel.textContent = data.category;
      titleLabel.textContent = data.title;
      descLabel.textContent = data.desc;

      // 5. Update progress bar metrics
      strengthVal.textContent = data.metrics.strength.val;
      strengthBar.style.width = `${data.metrics.strength.percent}%`;
      strengthBar.style.backgroundColor = data.metrics.strength.color;

      insulationVal.textContent = data.metrics.insulation.val;
      insulationBar.style.width = `${data.metrics.insulation.percent}%`;
      insulationBar.style.backgroundColor = data.metrics.insulation.color;

      savingVal.textContent = data.metrics.saving.val;
      savingBar.style.width = `${data.metrics.saving.percent}%`;
      savingBar.style.backgroundColor = data.metrics.saving.color;

      // 6. Update tech specifications table
      techTableBody.innerHTML = data.specs.map(spec => `
        <tr>
          <td>${spec.name}</td>
          <td>${spec.val}</td>
        </tr>
      `).join('');

      // 7. Update hotspots
      hotspotsContainer.innerHTML = data.hotspots.map(hs => `
        <div class="hotspot" style="top: ${hs.top}; left: ${hs.left};">
          <div class="hotspot-pulse"></div>
          <div class="hotspot-tooltip">
            <h4>${hs.title}</h4>
            <p>${hs.desc}</p>
          </div>
        </div>
      `).join('');

      // 8. Update real brick photograph
      if (realBrickImage && data.realImg) {
        let imgSrc = data.realImg;
        if (window.bitcoData && window.bitcoData.themeUri && !imgSrc.startsWith('http') && !imgSrc.startsWith('/')) {
          imgSrc = window.bitcoData.themeUri + '/assets/' + imgSrc.replace(/^\/?assets\/?/, '');
        }
        realBrickImage.src = imgSrc;
      }

      // Restore opacity
      showcase.style.opacity = '1';
    }, 250);
  };

  // Click handler for product tabs (the floating pills)
  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      tabs.forEach(t => t.classList.remove('active'));
      tab.classList.add('active');
      const productId = tab.getAttribute('data-product');
      updateShowcase(productId);
    });
  });

  // View Mode switching
  viewModeTabs.forEach(tab => {
    tab.addEventListener('click', () => {
      viewModeTabs.forEach(t => t.classList.remove('active'));
      tab.classList.add('active');
      const mode = tab.getAttribute('data-mode');

      if (mode === '3d') {
        brick3DScene.style.display = 'flex';
        realImageViewport.style.display = 'none';
      } else {
        brick3DScene.style.display = 'none';
        realImageViewport.style.display = 'flex';
      }
    });
  });

  // Interactive Magnifier Zoom
  if (zoomImageWrapper && realBrickImage) {
    zoomImageWrapper.addEventListener('mousemove', (e) => {
      const rect = zoomImageWrapper.getBoundingClientRect();
      const x = ((e.clientX - rect.left) / rect.width) * 100;
      const y = ((e.clientY - rect.top) / rect.height) * 100;
      
      realBrickImage.style.transformOrigin = `${x}% ${y}%`;
      realBrickImage.style.transform = 'scale(2.4)';
    });

    zoomImageWrapper.addEventListener('mouseleave', () => {
      realBrickImage.style.transform = 'scale(1)';
      realBrickImage.style.transformOrigin = 'center center';
    });
  }

  // Initialize first showcase view
  updateShowcase('clay-6hole');
  
  // Initialize viewport drag/hover rotation
  initProduct3DShowcase();
}

/**
 * 5. Advantage Card Mouse Glow Effect (3D Light hover)
 */
function initAdvantageCardGlow() {
  const cards = document.querySelectorAll('.advantage-card');
  
  cards.forEach(card => {
    card.addEventListener('mousemove', e => {
      const rect = card.getBoundingClientRect();
      const x = e.clientX - rect.left;
      const y = e.clientY - rect.top;
      
      card.style.setProperty('--mouse-x', `${x}px`);
      card.style.setProperty('--mouse-y', `${y}px`);
    });
  });
}

/**
 * 6. Stats Numbers Counters Animation
 */
function initStatsCounters() {
  const counters = document.querySelectorAll('.stat-number');
  
  const countToValue = (counter) => {
    const target = parseInt(counter.getAttribute('data-target'), 10);
    const suffix = counter.getAttribute('data-suffix') || '';
    let current = 0;
    const duration = 2000; // 2 seconds animation
    const stepTime = Math.max(Math.floor(duration / target), 30);
    
    const timer = setInterval(() => {
      current += Math.ceil(target / (duration / stepTime));
      if (current >= target) {
        counter.textContent = target + suffix;
        clearInterval(timer);
      } else {
        counter.textContent = current + suffix;
      }
    }, stepTime);
  };
  
  const counterObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        countToValue(entry.target);
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.5 });
  
  counters.forEach(counter => {
    counterObserver.observe(counter);
  });
}

/**
 * 7. Active Nav Link on Scroll & Smooth scroll link adjustment
 */
function initSmoothScroll() {
  const sections = document.querySelectorAll('section[id]');
  const navLinks = document.querySelectorAll('.nav-link');
  
  window.addEventListener('scroll', () => {
    let scrollY = window.pageYOffset;
    
    sections.forEach(current => {
      const sectionHeight = current.offsetHeight;
      const sectionTop = current.offsetTop - 120; // offset for sticky header
      const sectionId = current.getAttribute('id');
      
      if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
        navLinks.forEach(link => {
          link.classList.remove('active');
          if (link.getAttribute('href') === `#${sectionId}`) {
            link.classList.add('active');
          }
        });
      }
    });
  });
}

/**
 * 8. Hero Background Scroll Parallax (3D depth effect)
 */
function initHeroParallax() {
  const heroBg = document.querySelector('.hero-bg');
  
  if (heroBg) {
    window.addEventListener('scroll', () => {
      // requestAnimationFrame for optimized, smooth rendering
      window.requestAnimationFrame(() => {
        const scrollY = window.pageYOffset;
        // Limit parallax calculation within reasonable page scroll height (viewport height)
        if (scrollY < window.innerHeight) {
          // Translate background image downwards relative to container scroll (creates parallax depth)
          // Also apply a subtle dynamic zoom effect based on scroll value
          const scale = 1.05 + (scrollY * 0.0001);
          heroBg.style.transform = `translateY(${scrollY * 0.4}px) scale(${scale})`;
        }
      });
    });
  }
}

/**
 * 9. Scroll Interactive 3D Brick Dropping Effects
 *    Each section has ONE worker. Brick flies between adjacent workers on scroll.
 *    Scroll down: worker[i] throws → worker[i+1] catches
 *    Scroll up:   worker[i+1] throws → worker[i] catches
 */
function initScrollBrickDrop() {
  if (window.innerWidth < 1200) return;

  const sectionIds = ['about', 'products', 'advantages', 'projects', 'contact'];
  const containers = [];

  sectionIds.forEach(id => {
    const section = document.getElementById(id);
    if (!section) return;
    const container = section.querySelector('.section-builder-container');
    if (container) {
      containers.push({
        sectionId: id,
        section,
        container,
        builderSvg: container.querySelector('.builder-svg-container'),
        landedBrick: container.querySelector('.landed-brick')
      });
    }
  });

  if (containers.length < 2) return;

  // State: brickAt[i] = true means worker i is holding the brick
  // Initially only the first worker holds the brick
  const brickAt = containers.map((_, i) => i === 0);
  const animating = containers.map(() => false);

  // Show initial brick on first worker
  if (containers[0].landedBrick) {
    containers[0].landedBrick.classList.add('visible');
  }

  const checkScroll = () => {
    const viewportH = window.innerHeight;

    for (let i = 0; i < containers.length - 1; i++) {
      const nextI = i + 1;
      if (animating[i] || animating[nextI]) continue;

      const nextRect = containers[nextI].section.getBoundingClientRect();
      const threshold = viewportH * 0.4;

      if (nextRect.top < threshold && brickAt[i] && !brickAt[nextI]) {
        // Scroll down: throw from i to i+1
        flyBrick(i, nextI, 'down');
      } else if (nextRect.top >= threshold && !brickAt[i] && brickAt[nextI]) {
        // Scroll up: throw from i+1 back to i
        flyBrick(nextI, i, 'up');
      }
    }
  };

  const flyBrick = (fromIdx, toIdx, direction) => {
    animating[fromIdx] = true;
    animating[toIdx] = true;

    const from = containers[fromIdx];
    const to = containers[toIdx];

    if (!from.builderSvg || !to.builderSvg || !from.landedBrick || !to.landedBrick) {
      animating[fromIdx] = false;
      animating[toIdx] = false;
      return;
    }

    // Hide brick from sender
    from.landedBrick.classList.remove('visible');
    brickAt[fromIdx] = false;

    // Create temporary flying brick
    const tempBrick = document.createElement('div');
    tempBrick.className = `mini-brick-3d temp-falling-brick direction-${direction} ${toIdx === 2 ? 'aac-style' : ''}`;
    tempBrick.innerHTML = `
      <span class="face front"></span>
      <span class="face back"></span>
      <span class="face left"></span>
      <span class="face right"></span>
      <span class="face top"></span>
      <span class="face bottom"></span>
      <div class="brick-trail-lines">
        <span class="trail-line line-1"></span>
        <span class="trail-line line-2"></span>
        <span class="trail-line line-3"></span>
      </div>
    `;

    // Get screen positions of both workers
    const fromRect = from.builderSvg.getBoundingClientRect();
    const toRect = to.builderSvg.getBoundingClientRect();

    const startX = fromRect.left + fromRect.width / 2 - 20;
    const startY = fromRect.top + fromRect.height - 10;
    const endX = toRect.left + toRect.width / 2 - 20;
    const endY = toRect.top + toRect.height - 10;

    tempBrick.style.left = startX + 'px';
    tempBrick.style.top = startY + 'px';
    tempBrick.style.transition = 'left 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94), top 0.7s cubic-bezier(0.55, 0.085, 0.68, 0.53)';

    document.body.appendChild(tempBrick);

    // Sender does throw animation
    from.builderSvg.classList.remove('pose-idle', 'pose-catch');
    from.builderSvg.classList.add('pose-throw');

    // Receiver does catch animation
    to.builderSvg.classList.remove('pose-idle', 'pose-throw');
    to.builderSvg.classList.add('pose-catch');

    // Force reflow
    void tempBrick.offsetWidth;

    // Animate to receiver
    tempBrick.style.left = endX + 'px';
    tempBrick.style.top = endY + 'px';

    const onEnd = (e) => {
      if (e.propertyName !== 'top') return;
      tempBrick.removeEventListener('transitionend', onEnd);

      // Show brick at receiver
      brickAt[toIdx] = true;
      to.landedBrick.classList.add('visible', 'impact-bounce');
      tempBrick.remove();

      setTimeout(() => {
        to.landedBrick.classList.remove('impact-bounce');
        from.builderSvg.classList.remove('pose-throw');
        from.builderSvg.classList.add('pose-idle');
        to.builderSvg.classList.remove('pose-catch');
        to.builderSvg.classList.add('pose-idle');
        animating[fromIdx] = false;
        animating[toIdx] = false;
      }, 400);
    };

    tempBrick.addEventListener('transitionend', onEnd);

    // Safety timeout in case transitionend doesn't fire
    setTimeout(() => {
      if (animating[fromIdx] || animating[toIdx]) {
        brickAt[toIdx] = true;
        to.landedBrick.classList.add('visible');
        to.landedBrick.classList.remove('impact-bounce');
        from.builderSvg.classList.remove('pose-throw');
        from.builderSvg.classList.add('pose-idle');
        to.builderSvg.classList.remove('pose-catch');
        to.builderSvg.classList.add('pose-idle');
        animating[fromIdx] = false;
        animating[toIdx] = false;
        if (tempBrick.parentNode) tempBrick.remove();
      }
    }, 1500);
  };

  window.addEventListener('scroll', checkScroll);
  checkScroll();

  window.addEventListener('resize', () => {
    if (window.innerWidth >= 1200) {
      checkScroll();
    }
  });
}
