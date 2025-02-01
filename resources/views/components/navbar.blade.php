  <!-- Footer Nav -->
  <div class="footer-nav-area" id="footerNav">
      <div class="container px-0">
          <!-- Footer Content -->
          <div class="footer-nav position-relative">
              <ul class="h-100 d-flex align-items-center justify-content-between ps-0">
                  <li class="active">
                      <a href="/">
                          <i class="bi bi-house"></i>
                          <span>Beranda</span>
                      </a>
                  </li>

                  @auth
                      <li>
                          <a href="{{ route('orders') }}">
                              <i class="bi bi-folder2-open"></i>
                              <span>Orderan PO</span>
                          </a>
                      </li>


                      <li>
                          <a href="{{ route('cart') }}">
                              <i class="bi bi-cart"></i>
                              <span>Keranjang</span>
                          </a>
                      </li>

                      <li>
                          <a href="{{ route('customer') }}">
                              <i class="bi bi-heart"></i>
                              <span>Customer</span>
                          </a>
                      </li>

                      <li>
                          <a href="{{ route('acccount') }}">
                              <i class="bi bi-person-lock"></i>
                              <span>Akun</span>
                          </a>
                      </li>
                  @endauth

                  @guest
                      <li>
                          <a href="{{ route('products') }}">
                              <i class="bi bi-basket3"></i>
                              <span>Produk</span>
                          </a>
                      </li>
                      <li>
                          <a href="{{ route('login') }}">
                              <i class="bi bi-newspaper"></i>
                              <span>Blog</span>
                          </a>
                      </li>
                      <li>
                          <a href="{{ route('login') }}">
                              <i class="bi bi-person"></i>
                              <span>Login</span>
                          </a>
                      </li>
                  @endguest
              </ul>
          </div>
      </div>
  </div>
