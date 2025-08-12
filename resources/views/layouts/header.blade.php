<header>
    <h1>Klik <span>TUMBAS</span></h1>
    <nav>
       <a href="{{ route('home') }}">Beranda</a>
            <a href="{{ route('kategori.makanan', 'makanan') }}">Kategori</a>
            <a href="{{ route('tentang') }}">Tentang</a>
            @if(Auth::guard('admin')->check())
    <a href="{{ route('admin.profile') }}" class="profile-icon">👤</a>
@elseif(Auth::guard('web')->check()) {{-- web = member --}}
    <a href="{{ route('member.profile') }}" class="profile-icon">👤</a>
@else
    <a href="{{ route('login') }}" class="profile-icon">👤</a>
@endif
       
    </nav>
</header>

<style>
    header {
        background-color: #0288d1;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 20px;
        color: white;
    }
    header h1 {
        font-size: 20px;
        font-weight: bold;
    }
    header h1 span {
        color: yellow;
    }
    nav {
        display: flex;
        align-items: center;
        gap: 20px;
    }
    nav a {
        color: white;
        text-decoration: none;
        font-size: 14px;
    }
    .search-box {
        display: flex;
        align-items: center;
        background: white;
        border-radius: 20px;
        padding: 5px 10px;
    }
    .search-box input {
        border: none;
        outline: none;
        padding: 5px;
    }
    .profile-icon {
        margin-left: 10px;
        background: white;
        border-radius: 50%;
        padding: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .profile-icon i {
        color: black;
    }
</style>
