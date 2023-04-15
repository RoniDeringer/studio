@php $titlePage = ucfirst(session()->get('activePage')) @endphp
<style>
    *, *:before, *:after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }
    :root {
        minFontSize + (maxFontSize - minFontSize) * (100vw - minVWidth)/(maxVWidth - minVWidth)
    }
    .l {
        background-color: rgba(0,0,0,0.7);
        border-radius: 0.75em;
        box-shadow: 0.125em 0.125em 0 0.125em rgba(0,0,0,0.3) inset;
        color: #fdea7b;
        display: inline-flex;
        align-items: center;
        margin: auto;
        padding: 0.15em;
        width: 3em;
        height: 1.5em;
        transition: background-color 0.1s 0.3s ease-out, box-shadow 0.1s 0.3s ease-out;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }
    .l:before, .l:after {
        content: "";
        display: block;
    }
    .l:before {
        background-color: #d7d7d7;
        border-radius: 50%;
        width: 1.2em;
        height: 1.2em;
        transition: background-color 0.1s 0.3s ease-out, transform 0.3s ease-out;
        z-index: 1;
    }
    .l:after {
        background:
            linear-gradient(transparent 50%, rgba(0,0,0,0.15) 0) 0 50% / 50% 100%,
            repeating-linear-gradient(90deg,#bbb 0,#bbb,#bbb 20%,#999 20%,#999 40%) 0 50% / 50% 100%,
            radial-gradient(circle at 50% 50%,#888 25%, transparent 26%);
        background-repeat: no-repeat;
        border: 0.25em solid transparent;
        border-left: 0.4em solid #d8d8d8;
        border-right: 0 solid transparent;
        transition: border-left-color 0.1s 0.3s ease-out, transform 0.3s ease-out;
        transform: translateX(-22.5%);
        transform-origin: 25% 50%;
        width: 1.2em;
        height: 1em;
    }
    /* Checked */
    .l:checked {
        background-color: rgba(0,0,0,0.45);
        box-shadow: 0.125em 0.125em 0 0.125em rgba(0,0,0,0.1) inset;
    }
    .l:checked:before {
        background-color: currentColor;
        transform: translateX(125%)
    }
    .l:checked:after {
        border-left-color: currentColor;
        transform: translateX(-2.5%) rotateY(180deg);
    }
    /* Other States */
    .l:focus {
        /* Usually an anti-A11Y practice but set to remove an annoyance just for this demo */
        outline: 0;
    }    
</style>

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Página</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{ $titlePage }}</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">{{ $titlePage }}</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="mt-2 d-flex">
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="l" type="checkbox" checked onclick="darkMode(this)">
                    </div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="d-none" id="logout-form">
                @csrf
            </form>
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                        <i class="fa fa-user me-sm-1"></i>
                        <span class="d-sm-inline d-none"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            Sair</span>
                    </a>
                </li>
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
