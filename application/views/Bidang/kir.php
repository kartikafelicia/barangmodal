<!DOCTYPE html>
<html
  lang="en"
  class="light-style"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="<?= base_url('assets/sneat/assets/') ?>"  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Barang Modal</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/sneat/assets/img/favicon/favicon.ico') ?>" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?= base_url('assets/sneat/assets/vendor/fonts/boxicons.css') ?>" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/sneat/assets/vendor/css/core.css') ?>" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= base_url('assets/sneat/assets/vendor/css/theme-default.css') ?>" class="template-customizer-theme-css"/>
    <link rel="stylesheet" href="<?= base_url('assets/sneat/assets/css/demo.css') ?>" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/sneat/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') ?>" />

    <link rel="stylesheet" href="<?= base_url('assets/sneat/assets/vendor/libs/apex-charts/apex-charts.css') ?>" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="<?= base_url('assets/sneat/assets/vendor/js/helpers.js') ?>"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?= base_url('assets/sneat/assets/js/config.js') ?>" ></script>
  </head>

  

  <body>
    <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

        <!-- SIDEBAR -->
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <a href="index.html" class="app-brand-link">
                <span class="app-brand-logo demo">
                    <defs>
                        <path
                        d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z"
                        id="path-1"
                        ></path>
                        <path
                        d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z"
                        id="path-3"
                        ></path>
                        <path
                        d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z"
                        id="path-4"
                        ></path>
                        <path
                        d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z"
                        id="path-5"
                        ></path>
                    </defs>
                    <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                        <g id="Icon" transform="translate(27.000000, 15.000000)">
                            <g id="Mask" transform="translate(0.000000, 8.000000)">
                            <mask id="mask-2" fill="white">
                                <use xlink:href="#path-1"></use>
                            </mask>
                            <use fill="#696cff" xlink:href="#path-1"></use>
                            <g id="Path-3" mask="url(#mask-2)">
                                <use fill="#696cff" xlink:href="#path-3"></use>
                                <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                            </g>
                            <g id="Path-4" mask="url(#mask-2)">
                                <use fill="#696cff" xlink:href="#path-4"></use>
                                <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                            </g>
                            </g>
                            <g
                            id="Triangle"
                            transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) "
                            >
                            <use fill="#696cff" xlink:href="#path-5"></use>
                            <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                            </g>
                        </g>
                        </g>
                    </g>
                    </svg>
                </span>
                <span class="app-brand-text demo menu-text fw-bolder ms-2">Barang Modal</span>
                </a>

                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                <i class="bx bx-chevron-left bx-sm align-middle"></i>
                </a>
            </div>

            <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item active">
              <a href="<?= site_url('bidang/dashboard') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="dashboard">Dashboard</div>
              </a>
            </li>

            <!-- Master Data -->
            <!-- <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Master Data</span> -->
            <!-- </li>
             <li class="menu-item">
              <a href="<?= site_url('bidang/master_barang') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                <div data-i18n="masterbarang">Master Barang</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="<?= site_url('bidang/master_kategori') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                <div data-i18n="masterkategori">Master Kategori</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="<?= site_url('bidang/master_lokasi') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                <div data-i18n="masterlokasi">Master Lokasi</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="<?= site_url('bidang/master_posisi_barang') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                <div data-i18n="masterposisibarang">Master Posisi Barang</div>
              </a>
            </li> -->

            <!-- Transaksi -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Transaksi</span></li>
            <li class="menu-item">
              <a href="<?= site_url('bidang/permintaan') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="permintaan">Permintaan</div>
              </a>
            </li>

            <!-- Laporan -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Laporan</span></li>
            <li class="menu-item">
              <a href="<?= site_url('bidang/kir') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div data-i18n="kir">KIR</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="<?= site_url('bidang/riwayat') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-history"></i>
                <div data-i18n="riwayat">Riwayat</div>
              </a>
            </li>
          </ul>
        </aside>
        <!-- END SIDEBAR -->

        <!-- LAYOUT PAGE -->
        <div class="layout-page">

        <!-- NAVBAR -->
        <nav
        class="layout-navbar navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
        id="layout-navbar"
        >
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>

        <div class="navbar-nav-right d-flex align-items-center ms-auto">
            <span class="navbar-text fw-semibold fs-5">
            Kartu Investaris Ruangan
            </span>
        </div>
        </nav>
        <!-- END NAVBAR -->

        <!-- CONTENT WRAPPER -->
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                
             <div class="card">
                <div class="card-body">
                    <h6 class="fw-semibold text-muted mb-3">Data Lokasi & Sub Unit</h6>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-light text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Lokasi</th>
                                    <th>Ruangan</th>
                                    <th>Sub Unit</th>
                                    <th>Kondisi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php if (!empty($lokasi)) : ?>
                                <?php $no = 1; foreach ($lokasi as $row) : ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>

                                    <!-- Lokasi -->
                                    <td><?= $row->lokasi ?? '-' ?></td>

                                    <!-- Ruangan -->
                                    <td><?= $row->ruangan ?? '-' ?></td>

                                    <!-- Sub Unit (ambil dari tabel lokasi juga) -->
                                    <td><?= $row->lokasi ?? '-' ?></td>

                                    <!-- Kondisi -->
                                    <td class="text-center">
                                        <span class="badge bg-success">
                                            <?= $row->kondisi ?? 'Baik' ?>
                                        </span>
                                    </td>

                                    <!-- Aksi -->
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                           <button 
                                            class="btn btn-sm btn-warning"
                                            onclick="bukaForm('<?= $row->id ?? '' ?>')">
                                            Form
                                          </button>
                                          <button class="btn btn-sm btn-primary"
                                            onclick="openPermintaan('<?= $row->id ?>','<?= $row->lokasi ?>')">
                                            Permintaan
                                          </button>
                                          <button 
                                                class="btn btn-sm btn-info"
                                                onclick="lihatDokumen('<?= $row->id ?? '' ?>')">
                                                Dokumen
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted">
                                        Belum ada data
                                    </td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Modal Permintaan -->
            <div class="modal fade" id="permintaanModal" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">

                  <!-- HEADER -->
                  <div class="modal-header">
                    <h5 class="modal-title">Data Permintaan Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>

                  <!-- BODY -->
                  <div class="modal-body">

                    <!-- INFO LOKASI -->
                    <div class="mb-3">
                      <label>Lokasi</label>
                      <input type="text" id="modalLokasi" class="form-control" readonly>
                    </div>

                    <!-- TABEL -->
                    <div class="table-responsive">
                      <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light text-center">
                          <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th width="100">Jumlah</th>
                          </tr>
                        </thead>
                        <tbody id="permintaanBody">
                          <!-- isi dari JS -->
                        </tbody>
                      </table>
                    </div>

                  </div>

                  <!-- FOOTER -->
                  <div class="modal-footer">
                    <button class="btn btn-outline-secondary" data-bs-dismiss="modal">
                      Tutup
                    </button>

                    <button class="btn btn-primary">
                      Simpan Permintaan
                    </button>
                  </div>

                </div>
              </div>
            </div>

            <!-- Modal Form -->
            <div class="modal fade" id="modalForm" tabindex="-1">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">

                  <!-- HEADER -->
                  <div class="modal-header bg-warning">
                    <h5 class="modal-title">Form Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>

                  <!-- BODY -->
                  <div class="modal-body">

                    <form action="<?= site_url('bidang/kir/simpan') ?>" method="post">

                      <!-- hidden id (buat edit) -->
                      <input type="hidden" name="id" id="form_id">

                      <div class="barang-wrapper">

                        <div class="barang-item border rounded p-3 mb-3">

                          <div class="d-flex justify-content-between mb-3">
                            <strong>Data Barang</strong>
                            <button type="button" class="btn btn-danger btn-sm hapus-barang">Hapus</button>
                          </div>

                          <div class="row g-3">

                            <!-- NAMA BARANG -->
                            <div class="col-md-6">
                              <label class="form-label">Barang</label>
                              <select name="kode_barang[]" class="form-select pilih-barang" required>
                                <option value="">-- Pilih Barang --</option>
                                <?php foreach ($barang as $b): ?>
                                  <option 
  value="<?= $b->no_register ?>"
  data-merk-type="<?= $b->merk_type ?? '' ?>"
  data-tahun="<?= $b->tahun_pengadaan ?? '' ?>">
  <?= $b->nama_barang ?> - <?= $b->no_register ?>
</option>
                                <?php endforeach; ?>
                              </select>
                            </div>

                            <!-- MERK -->
                            <div class="col-md-6">
                              <label>Merk</label>
                              <input type="text" class="form-control merk" readonly>
                            </div>

                            <!-- TAHUN -->
                            <div class="col-md-6">
                              <label>Tahun</label>
                              <input type="text" class="form-control tahun" readonly>
                            </div>

                            <!-- JUMLAH -->
                            <div class="col-md-6">
                              <label>Jumlah</label>
                              <input type="number" name="jumlah[]" class="form-control" required>
                            </div>

                            <!-- KETERANGAN -->
                            <div class="col-md-6">
                              <label>Keterangan</label>
                              <input type="text" name="keterangan[]" class="form-control">
                            </div>

                          </div>

                        </div>
                      </div>

                      <button type="button" class="btn btn-outline-primary tambah-barang mb-3">
                        + Tambah Barang
                      </button>

                      <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                      </div>

                    </form>

                  </div>

                </div>
              </div>
            </div>



            </div>
        </div>
        <!-- END CONTENT WRAPPER -->

        </div>
        <!-- END LAYOUT PAGE -->

    </div>
    </div>


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="<?= base_url('assets/sneat/assets/vendor/libs/jquery/jquery.js') ?>" ></script>
    <script src="<?= base_url('assets/sneat/assets/vendor/libs/popper/popper.js') ?> "></script>
    <script src="<?= base_url('assets/sneat/assets/vendor/js/bootstrap.js') ?> "></script>
    <script src="<?= base_url('assets/sneat/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') ?> "></script>
    <script src="<?= base_url('assets/sneat/assets/vendor/js/menu.js') ?> "></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="<?= base_url('assets/sneat/assets/vendor/libs/apex-charts/apexcharts.js') ?> "></script>

    <!-- Main JS -->
    <script src="<?= base_url('assets/sneat/assets/js/main.js') ?> "></script>

     <!-- Penerimaan JS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script> const APP_URL = "<?= base_url() ?>"; </script>
    <script src="<?= base_url('assets/sneat/assets/js/kir.js') ?>"></script>

    <!-- Page JS -->
    <script src="<?= base_url('assets/sneat/assets/js/dashboards-analytics.js') ?> "></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

</body>
</html>
