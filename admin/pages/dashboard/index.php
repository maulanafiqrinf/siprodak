<div class="row">
    <?php
    $cards = [
        [
            "title" => "TPI BULU",
            "link" => "admin/admin.php?halaman=tpi-bulu",
            "icon" => "bx bx-store",
            "bg_color" => "bg-primary",
        ],
        [
            "title" => "Grafik TPI BULU",
            "link" => "admin/admin.php?halaman=grafik-tpibulu",
            "icon" => "bx bx-store",
            "bg_color" => "bg-success",
        ],
        [
            "title" => "TPI GLONDONG GEDE",
            "link" => "admin/admin.php?halaman=tpi-glongonggede",
            "icon" => "bx bx-store",
            "bg_color" => "bg-success",
        ],
        [
            "title" => "Grafik TPI GLONDONG GEDE",
            "link" => "admin/admin.php?halaman=grafik-tpiglongonggede",
            "icon" => "bx bx-store",
            "bg_color" => "bg-success",
        ],
        [
            "title" => "TPI PALANG",
            "link" => "admin/admin.php?halaman=tpi-palang",
            "icon" => "bx bx-store",
            "bg_color" => "bg-success",
        ],
        [
            "title" => "Grafik TPI PALANG",
            "link" => "admin/admin.php?halaman=grafik-tpipalang",
            "icon" => "bx bx-store",
            "bg_color" => "bg-success",
        ],
        [
            "title" => "TPI KARANGAGUNG",
            "link" => "admin/admin.php?halaman=tpi-karangagung",
            "icon" => "bx bx-store",
            "bg_color" => "bg-success",
        ],
        [
            "title" => "Grafik TPI KARANGAGUNG",
            "link" => "admin/admin.php?halaman=grafik-tpikarangagung",
            "icon" => "bx bx-store",
            "bg_color" => "bg-success",
        ],
        [
            "title" => "TPI TPI PLAZA IKAN",
            "link" => "admin/admin.php?halaman=tpi-plazaikan",
            "icon" => "bx bx-store",
            "bg_color" => "bg-success",
        ],
        [
            "title" => "Grafik TPI PLAZA IKAN",
            "link" => "admin/admin.php?halaman=grafik-tpiplazaikan",
            "icon" => "bx bx-store",
            "bg_color" => "bg-success",
        ],
    ];

    foreach ($cards as $card) : ?>
        <div class="col-md-4">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium"><?= $card['title'] ?></p>
                            <h4 class="mb-0">
                                <a href="<?= $card['link'] ?>">Lihat</a>
                            </h4>
                        </div>
                        <div class="flex-shrink-0 align-self-center">
                            <div class="mini-stat-icon avatar-sm rounded-circle <?= $card['bg_color'] ?>">
                                <span class="avatar-title">
                                    <i class="<?= $card['icon'] ?> font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
