<nav class="navbar">
    <div class="navbar__content--left">
        <div onclick="location.href='https://ganadoyucatan.com/'" class="navbar--logo"><img src="{{ asset('static/new/Iconos/Forma2710.png') }}" alt="Cow" srcset=""></div>
        <p onclick="location.href='/tianguisTienda'">Ganado Comercial</p>
        <p onclick="location.href='/tienda'">Ganado genético</p>
        <p onclick="location.href='/subastas'">Subasta</p>
        <p onclick="location.href='/embriones'">Embriones</p>
        <p onclick="location.href='/pajillas'">Pajillas</p>
        <p onclick="location.href='/blog'">Blog</p>
        <p onclick="location.href='/recomendaciones'">Recomendaciones</p>
        <p onclick="location.href='{{ url('/register') }}'">Publicar gratis</p>

    </div>
    <div class="navbar__content--right">
        <p>MENU</p>
        <div class="menu-container">
            <div class="hamburger-menu">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
            <div class="menu-list">
                <div class="menu-top">
                    <img src="" alt="">
                    <div class="close-menu">
                        <span>CERRAR MENU</span>
                        <img width="25" height="25" src="https://img.icons8.com/ios-glyphs/30/ffffff/delete-sign.png" alt="delete-sign"/>
                    </div>
                </div>
                <div class="menu-central">
                    <div class="menu-content">
                        <p>Publicación</p>
                        <p class="click-menu" onclick="location.href='{{ url('/register') }}'">Crea tu cuenta ganadero</p>
                        <p class="click-menu" onclick="location.href='{{url('/login')}}'">Ingresa ganadero</p>
                    </div>
                    <div class="menu-content highlight">
                        <p>Servicios</p>
                        <p class="click-menu" onclick="location.href='/tienda'">Ganado genético</p>
                        <p class="click-menu" onclick="location.href='/tianguisTienda'">Ganado comercial</p>
                        <p class="click-menu" onclick="location.href='/subastas'">Subastas</p>
                        <p class="click-menu" onclick="location.href='/embriones'">Embriones</p>
                        <p class="click-menu" onclick="location.href='/pajillas'">Pajillas</p>
                        <p class="click-menu" onclick="location.href='/blog'">Blog</p>
                        <p class="click-menu" onclick="location.href='{{ url('/register') }}'">Publicar gratis</p>

                    </div>
                </div>
                <div class="menu-social">
                    <div class="social-media--contact-container" style="justify-content: center;">
                        <img class="social-icon" onclick="location.href='https://www.youtube.com/@ganadoyucatanpeninsular6593'" width="25" height="25" src="https://img.icons8.com/material-sharp/50/ffffff/youtube-play.png" alt="youtube-play"/>
                        <img class="social-icon" onclick="location.href='https://www.facebook.com/ganadoyucatan'" width="25" height="25" src="https://img.icons8.com/windows/50/ffffff/facebook-f--v2.png" alt="facebook-f--v2"/>
                        <img class="social-icon" onclick="location.href='https://www.instagram.com/ganado_yuc/'" width="25" height="25" src="https://img.icons8.com/ios/50/ffffff/instagram-new--v1.png" alt="instagram-new--v1"/>
                    </div>
                </div>
            </div>
            <!-- <ul class="menu-list">
                <li><a href="#">Home</a></li>
                <li><a href="#">Tianguis Ganadero</a></li>
                <li><a href="#">Ganado Genético</a></li>
                <li><a href="#">Subasta</a></li>
                <li><a href="#">Noticias</a></li>
            </ul> -->
        </div>
    </div>
</nav>
