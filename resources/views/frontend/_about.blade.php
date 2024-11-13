<section id="about">
    <div class="container-fluid py-3">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-sm-12 col-md-6 col-lg-5 wow bounceInUp">
                    <img src="{{ asset('frontend/assets') }}/img/about.jpg" class="img-fluid rounded" alt="">
                </div>
                <div class="col-sm-12 col-md-6 col-lg-7 wow bounceInUp" data-wow-delay="0.3s">
                    <small
                        class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-4">Tentang Kami</small>
                    <p class="mb-4">Kanal Social Space adalah tempat yang pas untuk berbagi cerita, inspirasi, dan
                        momen santai bersama teman-teman. Kami menawarkan pilihan kopi dan teh spesial dari berbagai
                        belahan dunia. Mulai dari kopi single origin beraroma khas hingga pilihan espresso, semua
                        tersedia dengan kualitas terbaik yang etis dan ramah lingkungan. Bagi pecinta kopi sejati, kami
                        juga menyediakan berbagai peralatan seduh unik untuk melengkapi pengalaman. Dengan barista
                        terlatih dan suasana cozy, Kanal Social Space siap menjadi destinasi hangout favoritmu, baik
                        untuk bersantai di rumah atau menghabiskan waktu bersama teman-teman. Semua dapat diakses dengan
                        mudah hanya dengan satu klik!</p>
                    <div class="row g-4 text-dark mb-5">
                        <div class="col-sm-6">
                            <i class="fas fa-share text-primary me-2"></i>Pesan Sekarang, Nikmati Segera!
                        </div>
                        <div class="col-sm-6">
                            <i class="fas fa-share text-primary me-2"></i>Kami Selalu Ada Untuk Anda!
                        </div>
                        <div class="col-sm-6">
                            <i class="fas fa-share text-primary me-2"></i>Sesuaikan Pesananmu, Nikmati Kebebasan!
                        </div>
                        <div class="col-sm-6">
                            <i class="fas fa-share text-primary me-2"></i>Nikmati Rasa Istimewa, Harga Lebih Hemat!
                        </div>
                    </div>
                    <a href="#" class="btn btn-primary py-3 px-5 rounded-pill">Tentang Kami<i
                            class="fas fa-arrow-right ps-2"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid faqt py-5">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-sm-12 col-lg-7 wow bounceInUp" data-wow-delay="0.3s">
                    <small
                        class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Recommended</small>
                    <div class="row g-4">
                        <div class="col-lg-4 col-md-6 col-sm-12 wow bounceInUp" data-wow-delay="0.3s">
                            <div class="faqt-item bg-primary rounded p-4 text-center">
                                <i class="bi bi-info-circle text-dark" style="color: rgba(141,111,65,1);"></i>
                                <img src="{{ asset('frontend/assets') }}/img/kopi1.jpg" alt="Arabica Coffee"
                                    class="img-fluid">
                                <i class="bi bi-cart text-dark" style="color: rgba(141,111,65,1);"></i>
                                <div class="text-white fw-bold"
                                    style="font-size: 0.75rem; background-color: rgba(141,111,65,1); padding: 10px; border-radius: 5px;">
                                    Arabica | Dark Roast
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 wow bounceInUp" data-wow-delay="0.5s">
                            <div class="faqt-item bg-primary rounded p-4 text-center">
                                <i class="bi bi-info-circle text-dark" style="color: rgba(141,111,65,1);"></i>
                                <img src="{{ asset('frontend/assets') }}/img/kopi1.jpg" alt="Arabica Coffee"
                                    class="img-fluid">
                                <i class="bi bi-cart text-dark" style="color: rgba(141,111,65,1);"></i>
                                <div class="text-white fw-bold"
                                    style="font-size: 0.75rem; background-color: rgba(141,111,65,1); padding: 10px; border-radius: 5px;">
                                    Arabica | Dark Roast
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 wow bounceInUp" data-wow-delay="0.7s">
                            <div class="faqt-item bg-primary rounded p-4 text-center">
                                <i class="bi bi-info-circle text-dark" style="color: rgba(141,111,65,1);"></i>
                                <img src="{{ asset('frontend/assets') }}/img/kopi1.jpg" alt="Arabica Coffee"
                                    class="img-fluid">
                                <i class="bi bi-cart text-dark" style="color: rgba(141,111,65,1);"></i>
                                <div class="text-white fw-bold"
                                    style="font-size: 0.75rem; background-color: rgba(141,111,65,1); padding: 10px; border-radius: 5px;">
                                    Arabica | Dark Roast
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-5 wow bounceInUp" data-wow-delay="0.1s">
                    <div class="video">
                        <button type="button" class="btn btn-play" data-bs-toggle="modal"
                            data-src="https://www.youtube.com/embed/2Q1fK7OJfHk?si=jbX0398H6D9g8t2i"
                            data-bs-target="#videoModal">
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Video -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Youtube Video</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- 16:9 aspect ratio -->
                    <div class="ratio ratio-16x9">
                        <iframe class="embed-responsive-item"
                            src="https://www.youtube.com/embed/2Q1fK7OJfHk?si=jbX0398H6D9g8t2i" id="video"
                            allowfullscreen allowscriptaccess="always" allow="autoplay"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Video End --}}
</section>
