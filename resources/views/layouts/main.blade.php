<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Transaction App</title><!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="AdminLTE v4 | Dashboard">
    <meta name="author" content="ColorlibHQ">
    <meta name="description"
          content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS.">
    <meta name="keywords"
          content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard">
    <!--end::Primary Meta Tags--><!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
          integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous"><!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css"
          integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous">
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css"
          integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous">
    <!--end::Third Party Plugin(Bootstrap Icons)--><!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{asset('css/adminlte.css')}}"><!--end::Required Plugin(AdminLTE)--><!-- apexcharts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
          integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous"><!-- jsvectormap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
          integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"/>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css"/>

</head> <!--end::Head--> <!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary"> <!--begin::App Wrapper-->

<div class="app-wrapper"> <!--begin::Header-->
    <nav class="app-header navbar navbar-expand bg-body"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Start Navbar Links-->
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"> <i
                            class="bi bi-list"></i> </a></li>
            </ul> <!--end::Start Navbar Links--> <!--begin::End Navbar Links-->

        </div> <!--end::Container-->
    </nav> <!--end::Header--> <!--begin::Sidebar-->
    <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
            <!--begin::Brand Link--> <a href="./index.html" class="brand-link"> <!--begin::Brand Image-->
                <!--end::Brand Image--> <!--begin::Brand Text--> <span
                    class="brand-text fw-light">Transaction App</span>
                <!--end::Brand Text--> </a> <!--end::Brand Link--> </div> <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
            <nav class="mt-2"> <!--begin::Sidebar Menu-->
                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{route('home')}}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-house-fill"></i>
                            <p>Home</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('transaction')}}"
                           class="nav-link {{ request()->is('transaction') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-card-list"></i>
                            <p>Upload Transaksi</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('tag')}}" class="nav-link {{ request()->is('tag') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-gear-fill"></i>
                            <p>Master Tag</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('produk')}}" class="nav-link {{ request()->is('produk') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-gear-fill"></i>
                            <p>Master Produk</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('jasa')}}" class="nav-link {{ request()->is('jasa') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-gear-fill"></i>
                            <p>Master Jasa</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('transaction_jasa')}}" class="nav-link {{ request()->is('transaksi-jasa') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-card-list"></i>
                            <p>Transaksi Jasa</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div> <!--end::Sidebar Wrapper-->
    </aside> <!--end::Sidebar--> <!--begin::App Main-->
    <main class="app-main"> <!--begin::App Content Header-->
        <div class="app-content-header"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">@yield('title', 'Title')</h3>
                    </div>
                </div> <!--end::Row-->
            </div> <!--end::Container-->
        </div> <!--end::App Content Header--> <!--begin::App Content-->
        <div class="app-content"> <!--begin::Container-->
            @yield('content')
        </div> <!--end::App Content-->
    </main> <!--end::App Main--> <!--begin::Footer-->
    <footer class="app-footer"> <!--begin::To the end-->
        <div class="float-end d-none d-sm-inline"></div> <!--end::To the end--> <!--begin::Copyright-->
        <strong>
            <a href="#" class="text-decoration-none">Transaction App</a>.
        </strong>
        All rights reserved.
        <!--end::Copyright-->
    </footer> <!--end::Footer-->
</div> <!--end::App Wrapper--> <!--begin::Script--> <!--begin::Third Party Plugin(OverlayScrollbars)-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js"
        integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script>
<!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script>
<!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script>
<!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
<script src="{{asset('js/adminlte.js')}}"></script> <!--end::Required Plugin(AdminLTE)-->
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!--begin::OverlayScrollbars Configure-->
<script>
    const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
    const Default = {
        scrollbarTheme: "os-theme-light",
        scrollbarAutoHide: "leave",
        scrollbarClickScroll: true,
    };
    document.addEventListener("DOMContentLoaded", function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (
            sidebarWrapper &&
            typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined"
        ) {
            OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                scrollbars: {
                    theme: Default.scrollbarTheme,
                    autoHide: Default.scrollbarAutoHide,
                    clickScroll: Default.scrollbarClickScroll,
                },
            });
        }
    });
</script> <!--end::OverlayScrollbars Configure--> <!-- OPTIONAL SCRIPTS --> <!-- sortablejs -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"
        integrity="sha256-ipiJrswvAR4VAx/th+6zWsdeYmVae0iJuiR+6OqHJHQ=" crossorigin="anonymous"></script>
<!-- sortablejs -->
<script>
    const connectedSortables =
        document.querySelectorAll(".connectedSortable");
    connectedSortables.forEach((connectedSortable) => {
        let sortable = new Sortable(connectedSortable, {
            group: "shared",
            handle: ".card-header",
        });
    });

    const cardHeaders = document.querySelectorAll(
        ".connectedSortable .card-header",
    );
    cardHeaders.forEach((cardHeader) => {
        cardHeader.style.cursor = "move";
    });
</script> <!-- apexcharts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const myAlert = {
        success: (title, text) => {
            Swal.fire({
                title,
                text,
                icon: 'success'
            })
        },
        error: (title, text) => {
            Swal.fire({
                title,
                text,
                icon: 'error'
            })
        },
        confirmation: (title, confirm, cancel) => {
            return Swal.fire({
                title,
                showCancelButton: true,
                confirmButtonText: "Ya",
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire("Changes are saved", "", "success");
                    return Promise.resolve('Confirm')
                } else if (result.isDenied) {
                    Swal.fire("Changes are not saved", "", "info");
                    return Promise.reject('Reject')
                }
            })
        }
    }
</script>
@if(session('success'))
    <script>
        myAlert.success('{{ session('success') }}')
    </script>
@endif
@if(session('error'))
    <script>
        myAlert.error('{{ session('error') }}')
    </script>
@endif
@yield('script')
</body><!--end::Body-->

</html>
