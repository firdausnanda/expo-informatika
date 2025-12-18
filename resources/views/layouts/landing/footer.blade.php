<footer id="footer" class="footer dark-background">

    <div class="container footer-top">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-6 footer-about">
                <a href="index.html" class="logo ">
                    <span class="sitename d-block mb-2">Program Studi Informatika</span>
                    <span class="logo">ITSK RS dr.Soepraoen</span>
                </a>
                <div class="footer-contact pt-3">
                    <p><strong>Alamat:</strong> Jl. Majapahit No.1 Kiduldalem</p>
                    <p>Klojen, Kota Malang</p>
                    <p><strong>Email:</strong> <span>Informatika@itsk-soepraoen.ac.id</span></p>
                </div>
                <div class="social-links d-flex mt-4">
                    <a href="https://www.threads.com/@informatikasoepraoen" target="_blank"><i class="bi bi-threads"></i></a>
                    <a href="https://www.tiktok.com/@informatikasoepraoen" target="_blank"><i class="bi bi-tiktok"></i></a>
                    <a href="https://www.instagram.com/informatikasoepraoen" target="_blank"><i class="bi bi-instagram"></i></a>
                    <a href="https://id.linkedin.com/in/informatika-itsk-soepraoen-879436286" target="_blank"><i class="bi bi-linkedin"></i></a>
                    <a href="https://www.youtube.com/@InformatikaSoepraoen" target="_blank"><i class="bi bi-youtube"></i></a>
                </div>
            </div>

            <div class="col-lg-5 col-md-3 footer-links">
                <h4>Kategori</h4>
                @forelse ($kategori as $k)
                    <a class="btn btn-sm btn-outline-secondary rounded-pill m-2"
                        href="{{ route('kategori', $k->slug) }}">{{ $k->nama }}</a>
                @empty
                    
                @endforelse
            </div>

            <div class="col-lg-3 col-md-3 footer-links">
                <h4>Tautan</h4>
                <ul>
                    <li><a href="https://informatika.itsk-soepraoen.ac.id/" target="_blank">Prodi Informatika ITSK Soepraoen</a></li>
                    <li><a href="https://jesica.itsk-soepraoen.ac.id/" target="_blank">JESICA</a></li>
                    <li><a href="https://itsk-soepraoen.ac.id/" target="_blank">ITSK RS dr.Soepraoen</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container copyright text-center mt-4">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">2026 ITSK Soepraoen</strong> <span>All Rights
                Reserved</span>
        </p>
    </div>

</footer>
