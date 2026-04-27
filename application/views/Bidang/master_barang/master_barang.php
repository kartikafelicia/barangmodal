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

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Master Data</span>
            </li>
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
            Master Data
            </span>
        </div>
        </nav>
        <!-- END NAVBAR -->

        <!-- CONTENT WRAPPER -->
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">

            <div class="card">
                <h5 class="card-header">
                  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                    <!-- Judul -->
                    <span class="fw-bold">Master Barang Modal</span>

                    <!-- Search + Button -->
                    <div class="d-flex align-items-center gap-2">

                      <!-- Search -->
                      <input type="text"
                            id="searchInput"
                            class="form-control form-control-sm"
                            placeholder="Cari barang..."
                            style="width: 220px;">
                        
                       <!-- Export -->
                      <a href="<?= site_url('master_barang/export_excel') ?>" 
                        class="btn btn-success btn-sm" target="_blank">
                        Export Excel
                      </a>
                      <a href="<?= site_url('master_barang/export_pdf') ?>" 
                        class="btn btn-primary btn-sm" target="_blank">
                        Export PDF
                      </a>
                      
                      <!-- Button -->
                      <button class="btn btn-danger btn-sm"
                              data-bs-toggle="modal"
                              data-bs-target="#modalTambah">
                        + Tambah Data
                      </button>

                    </div>

                  </div>
                </h5>

                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr class="text-center">
                        <th>#</th>
                        <th>Lokasi</th>
                        <th>Unit</th>
                        <th>Kode Barang</th>
                        <th>Kode Neraca</th>
                        <th>No Register</th>
                        <th>Nama Barang</th>
                        <th>Merk/Type</th>
                        <th>Ukuran CC</th>
                        <th>Bahan</th>
                        <th>Tahun</th>
                        <th>Kondisi B</th>
                        <th>Kondisi KB</th>
                        <th>Kondisi RB</th>
                        <th>Rangka Seri</th>
                        <th>Nomor Mesin</th>
                        <th>Nomor Nopol</th>
                        <th>Nomor BPKB</th>
                        <th>Asal Usul Pemda</th>
                        <th>Asal Usul Unit</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                        <th>Harga</th>
                        <th>Sisa Umur</th>
                        <th>Beban Rp.</th>
                        <th>Akumulasi Susut Rp.</th>
                        <th>Keterangan</th>
                        <th>Kategori</th>
                        <th>Sub Kategori</th>
                        <th width="120" class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php if(!empty($barang)) : ?>
                        <?php $no = 1; foreach($barang as $row) : ?>
                        <tr>
                            <th scope="row"><?= $no++ ?></th>
                            <td><?= $row->lokasi ?></td>
                            <td><?= $row->unit ?></td>
                            <td><?= $row->kode_barang ?></td>
                            <td><?= $row->kode_neraca ?></td>
                            <td><?= $row->no_register ?></td>
                            <td><?= $row->nama_barang ?></td>
                            <td><?= $row->merk_type ?></td>
                            <td><?= $row->ukuran_cc ?></td>
                            <td><?= $row->bahan ?></td>
                            <td><?= $row->tahun_pengadaan ?></td>
                            <td><?= $row->kondisi_B ?></td>
                            <td><?= $row->kondisi_KB ?></td>
                            <td><?= $row->kondisi_RB ?></td>
                            <td><?= $row->rangka_seri ?></td>
                            <td><?= $row->nomor_mesin ?></td>
                            <td><?= $row->nomor_nopol; ?></td>
                            <td><?= $row->nomor_bpkb ?></td>
                            <td><?= $row->asal_usul_pemda?></td>
                            <td><?= $row->asal_usul_unit ?></td>
                            <td><?= $row->jumlah ?></td>
                            <td><?= $row->satuan?></td>
                            <td><?= number_format($row->harga,0,',','.') ?></td>
                            <td><?= $row->sisa_umur ?></td>
                            <td><?= $row->beban_rp ?></td>
                            <td><?= $row->akumulasi_susut_rp ?></td>
                            <td><?= $row->keterangan ?></td>
                            <td><?= $row->kategori ?></td>
                            <td><?= $row->sub_kategori ?></td>
                            <td class="text-center">
                              <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary"
                                        data-bs-toggle="dropdown">
                                  <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <ul class="dropdown-menu">
                                  <li>
                                    <a class="dropdown-item text-warning btn-edit"
                                      href="javascript:void(0)"
                                      data-id="<?= $row->id ?>">
                                      <i class="bx bx-edit-alt me-1"></i> Edit
                                    </a>
                                  </li>
                                  <li>
                                    <a class="dropdown-item text-danger btn-hapus"
                                      href="javascript:void(0)"
                                      data-id="<?= $row->id ?>">
                                      <i class="bx bx-trash me-1"></i> Hapus
                                    </a>
                                  </li>
                                </ul>
                              </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                        <td colspan="14" class="text-center text-muted">
                            Belum ada data
                        </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                    </table>
                </div>
                <div class="mt-3">
                <?= $links ?>
                </div>
            </div>

            <!-- Modal Tambah Data -->
            <div class="modal fade" id="modalTambah" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">

                <form action="<?= site_url('master_barang/tambah') ?>" method="post">

                    <div class="modal-header">
                    <h5 class="modal-title">Tambah Master Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                          <label class="form-label">Lokasi</label>
                          <select name="lokasi" class="form-select" required>
                            <option value="">-- Pilih Lokasi --</option>
                            <?php foreach($lokasi as $l): ?>
                              <option value="<?= $l->lokasi ?>">
                                <?= $l->lokasi ?>
                              </option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Unit</label>
                          <input type="text" name="unit" class="form-control">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Kode Barang</label>
                          <input type="text" name="kode_barang" class="form-control">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Kode Neraca</label>
                          <input type="text" name="kode_neraca" class="form-control">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">No Register</label>
                          <input type="text" name="no_register" class="form-control">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Nama Barang</label>
                          <input type="text" name="nama_barang" class="form-control">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Merk/Type</label>
                          <input type="text" name="merk_type" class="form-control">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Ukuran CC</label>
                          <input type="text" name="ukuran_cc" class="form-control">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Bahan</label>
                          <input type="text" name="bahan" class="form-control">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Tahun Pengadaan</label>
                          <input type="number" name="tahun_pengadaan" class="form-control">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Kondisi B</label>
                          <input type="text" name="kondisi_B" class="form-control">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Kondisi KB</label>
                          <input type="text" name="kondisi_B" class="form-control">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Kondisi RB</label>
                          <input type="text" name="kondisi_B" class="form-control">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Rangka Seri</label>
                          <input type="text" name="rangka_seri" class="form-control">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Nomor Mesin</label>
                          <input type="text" name="nomor_mesin" class="form-control">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Nomor Nopol</label>
                          <input type="text" name="nomor_nopol" class="form-control">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Nomor BPKB</label>
                          <input type="text" name="nomor_bpkb" class="form-control">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Asal Usul Pemda</label>
                          <input type="text" name="asal_usul_pemda" class="form-control">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Asal Usul Unit</label>
                          <input type="text" name="asal_usul_unit" class="form-control">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Jumlah</label>
                          <input type="number" name="jumlah" class="form-control">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Satuan</label>
                          <input type="number" name="satuan" class="form-control">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Harga</label>
                          <input type="number" name="harga" class="form-control">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Sisa Umur</label>
                          <input type="number" name="sisa_umur" class="form-control">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Beban (Rp) </label>
                          <input type="number" name="beban_rp" class="form-control">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Akumulasi Susut (Rp) </label>
                          <input type="number" name="akumulasi_susut_rp" class="form-control">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Keterangan</label>
                          <input type="text" name="keterangan" class="form-control">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Kategori</label>
                          <select name="kategori" class="form-select">
                              <option value="">-- Pilih --</option>
                              <?php foreach($kategori as $k) : ?>
                              <option value="<?= $k->kategori ?>">
                                  <?= $k->kategori ?>
                              </option>
                              <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Sub Kategori</label>
                          <select name="sub_kategori" class="form-select">
                              <option value="">-- Pilih --</option>
                              <option value="Extrakomtabel">Extrakomtabel</option>
                              <option value="Intrakomtabel">Intrakomtabel</option>
                          </select>
                        </div>
                    </div>
                    </div>

                    <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Simpan</button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    </div>

                </form>

                </div>
            </div>
            </div>

            <!-- Modal Edit -->
            <div class="modal fade" id="modalEdit" tabindex="-1">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">

                  <form id="formEdit">

                    <div class="modal-header">
                      <h5 class="modal-title">Edit Barang</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                   <div class="modal-body">
                    <div class="container-fluid">
                      <div class="row g-3">
                      <input type="hidden" name="id" id="edit_id">
                        <div class="col-md-6">
                          <label class="form-label">Lokasi</label>
                          <select name="lokasi" class="form-select" required>
                            <option value="">-- Pilih Lokasi --</option>
                            <?php foreach($lokasi as $l): ?>
                              <option value="<?= $l->lokasi ?>">
                                <?= $l->lokasi ?>
                              </option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Unit</label>
                          <input type="text" name="unit" class="form-control">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Kode Barang</label>
                          <input type="text" name="kode_barang" class="form-control">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Kode Neraca</label>
                          <input type="text" name="kode_neraca" class="form-control">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">No Register</label>
                          <input type="text" name="no_register" class="form-control">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Nama Barang</label>
                          <input type="text" name="nama_barang" class="form-control">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Merk/Type</label>
                          <input type="text" name="merk_type" class="form-control">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Ukuran CC</label>
                          <input type="text" name="ukuran_cc" class="form-control">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Bahan</label>
                          <input type="text" name="bahan" class="form-control">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Tahun Pengadaan</label>
                          <input type="number" name="tahun_pengadaan" class="form-control">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Kondisi B</label>
                          <input type="text" name="kondisi_B" class="form-control">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Kondisi KB</label>
                          <input type="text" name="kondisi_B" class="form-control">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Kondisi RB</label>
                          <input type="text" name="kondisi_B" class="form-control">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Rangka Seri</label>
                          <input type="text" name="rangka_seri" class="form-control">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Nomor Mesin</label>
                          <input type="text" name="nomor_mesin" class="form-control">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Nomor Nopol</label>
                          <input type="text" name="nomor_nopol" class="form-control">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Nomor BPKB</label>
                          <input type="text" name="nomor_bpkb" class="form-control">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Asal Usul Pemda</label>
                          <input type="text" name="asal_usul_pemda" class="form-control">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Asal Usul Unit</label>
                          <input type="text" name="asal_usul_unit" class="form-control">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Jumlah</label>
                          <input type="number" name="jumlah" class="form-control">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Satuan</label>
                          <input type="number" name="satuan" class="form-control">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Harga</label>
                          <input type="number" name="harga" class="form-control">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Sisa Umur</label>
                          <input type="number" name="sisa_umur" class="form-control">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Beban (Rp) </label>
                          <input type="number" name="beban_rp" class="form-control">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Akumulasi Susut (Rp) </label>
                          <input type="number" name="akumulasi_susut_rp" class="form-control">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Keterangan</label>
                          <input type="text" name="keterangan" class="form-control">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Kategori</label>
                          <select name="kategori" class="form-select">
                              <option value="">-- Pilih --</option>
                              <?php foreach($kategori as $k) : ?>
                              <option value="<?= $k->kategori ?>">
                                  <?= $k->kategori ?>
                              </option>
                              <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Sub Kategori</label>
                          <select name="sub_kategori" class="form-select">
                              <option value="">-- Pilih --</option>
                              <option value="Extrakomtabel">Extrakomtabel</option>
                              <option value="Intrakomtabel">Intrakomtabel</option>
                          </select>
                        </div>

                        </div>
                      </div>
                    </div>

                    <div class="modal-footer">
                      <button type="submit" class="btn btn-warning">Update</button>
                    </div>

                  </form>

                </div>
              </div>
            </div>

            <!-- Modal Hapus -->
            <div class="modal fade" id="modalDelete" tabindex="-1">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">

                  <div class="modal-header">
                    <h5 class="modal-title text-danger">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>

                  <div class="modal-body">
                    Yakin ingin menghapus data ini?
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                      Batal
                    </button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">
                      Ya, Hapus
                    </button>
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
    <!-- Master Data JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script> const APP_URL = "<?= base_url() ?>"; </script>
    <script src="<?= base_url('assets/sneat/assets/js/master_barang.js') ?>"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

</body>
</html>
