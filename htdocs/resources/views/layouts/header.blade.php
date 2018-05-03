<header role="banner" id="global-header" class="
  with-proposition
">
    <div class="header-wrapper">
        <div class="header-global">
            <div class="header-logo">
                <a href="https://www.gov.uk" title="Go to the GOV.UK homepage" id="logo" class="content">
                    <img src="/css/images/gov.uk_logotype_crown.png" width="36" height="32" alt=""> GOV.UK
                </a>
            </div>

        </div>


        <div class="header-proposition">
            <div class="content">
                <a href="#proposition-links" class="js-header-toggle menu">Menu</a>
                <nav id="proposition-menu">
                    <a href="{{ route('pages.home') }}" id="proposition-name">{{ config('app.short_name') }}</a>

                    <ul id="proposition-links">
                        <li><a href="{{ route('auth.login') }}">Login</a></li>
                        <li><a href="{{ route('pages.about') }}">About</a></li>
                    </ul>

                </nav>
            </div>
        </div>


    </div>
</header>
<div id="global-header-bar"></div>

