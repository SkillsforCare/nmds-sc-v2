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
                <nav id="proposition-menu">
                    <a href="{{ route('pages.home') }}" id="proposition-name">{{ config('app.short_name') }}</a>
                    <div style="display: flex; justify-content: space-between;">
                        <ul id="proposition-links">
                        <li><a href="{{ route('pages.about') }}">About</a></li>
                    </ul>
                        <ul  id="proposition-links" class="align-right" style="text-align: right;">
                            @guest

                                <li><a href="{{ route('login') }}">Login</a></li>

                            @else
                                <li><a>Hi, {{ auth()->user()->full_name }}</a></li>

                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Sign out
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </nav>
            </div>
        </div>


    </div>
</header>
<div id="global-header-bar"></div>

