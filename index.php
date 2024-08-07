<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="icon" href="./assets/img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="./resource/styles.css" />
    <title>Rekam Medis</title>
</head>

<body>
    <div class="container">
        <nav>
            <div class="nav__logo">
                <img src="./assets/img/kemenkes.png" width="35" alt="">
                <img src="./assets/img/logo.png" width="35" alt="">
                <img src="./assets/img/toraja.png" width="30" alt="">
            </div>
            <span class="title-logo">Rekam Medis | Kondodewata</span>
            <ul class="nav__links">
                <!-- <li class="link"><a href="#">Beranda</a></li> -->
                <!-- <li class="link"><a href="#">Tentang Kami</a></li>
                <li class="link"><a href="#">Produk</a></li>
                <li class="link"><a href="#">Kontak</a></li> -->
            </ul>
            <div class="wrapper">
                <a class="link" href="./login.php">
                    <div class="color"></div>
                    <span>Login</span>

                </a>
            </div>
        </nav>
        <header class="header">
            <div class="content">
                <h1><span>Dapatkan</span><br />Layanan Medis Cepat</h1>
                <p>
                    Dalam dunia yang serba cepat saat ini, akses ke layanan medis yang cepat dan efisien sangatlah penting. Saat menghadapi keadaan darurat medis atau membutuhkan perhatian medis segera, kemampuan untuk menerima layanan medis yang cepat dapat berdampak signifikan pada hasil dari suatu situasi.
                </p>
                <!-- <button class="btn">Get Services</button> -->
            </div>
            <div class="image">
                <span class="image__bg"></span>
                <img style="margin-top: 5px;" src="resource/dokter.png" alt="header image" />
                <div class="image__content image__content__1">
                    <span><i class="ri-user-3-line"></i></span>
                    <div class="details">
                        <h4>1520+</h4>
                        <p>Kunjungan Pasien</p>
                    </div>
                </div>
                <div class="image__content image__content__2">
                    <ul>
                        <li>
                            <span><i class="ri-check-line"></i></span>
                            Layanan Medis Cepat
                        </li>
                        <li>
                            <span><i class="ri-check-line"></i></span>
                            Dokter Ahli
                        </li>
                    </ul>
                </div>
            </div>
        </header>
    </div>
    <script src="./node_modules/gsap/dist/gsap.min.js"></script>
    <script>
        let link = document.querySelector(".link");
        let pink = document.querySelector(".color");

        let hoverTL = gsap.timeline();
        hoverTL.pause();

        // from, to, fromTo Tweens
        hoverTL.to(pink, {
            width: "calc(100% + 1.3em)",
            ease: "Elastic.easeOut(0.25)",
            duration: 0.4
        });
        hoverTL.to(pink, {
            width: "2em",
            left: "calc(100% - 1.45em)",
            ease: "Elastic.easeOut(0.4)",
            duration: 0.6
        });

        link.addEventListener("mouseenter", () => {
            hoverTL.play();
        });

        link.addEventListener("mouseleave", () => {
            hoverTL.reverse();
        });
    </script>
</body>

</html>