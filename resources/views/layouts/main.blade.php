@extends('layouts.static')

@section('js')
    <script type="text/javascript" id="js-app-data">
        document.getElementsByTagName('html')[0].class = "js";

        window.app = {
            'session'  : "{!! Session::getId() !!}",

        @if (env('APP_DEBUG'))
            'debug'      : true,
        @else
            'debug'      : false,
        @endif

            'favicon'    : {
                'normal' : "{{ asset('static/img/assets/Favicon_Vivian.ico') }}",
                'alert'  : "{{ asset('static/img/assets/Favicon_Vivian_new.ico') }}"
            },

            'title'      : "@yield('title', 'Infinity Next')",

            'url'        : "{!! route('site.home') !!}/",
            'panel_url'  : "{!! route('panel.home') !!}/",
            'media_url'  : "{!! media_url() !!}/",

            @yield('app-js')

            'settings'   : {!! $app['settings']->getJson() !!},

            'version'    : 0,

            'lang'     : {!! json_encode( Lang::get('widget') ) !!}
        };
    </script>

    <script type="text/javascript" id="js-app-stylist">
        {{--
            IMPORTANT
            This relies on information setup by js/app/widgets/stylist.widget.js
            However, this particular script exists outside of the scope of the
            widget framework so that the styling is injected before any document
            rendering happens.
        --}}
        var theme = localStorage.getItem('ib.setting.stylist.theme') || false;
        var css   = localStorage.getItem('ib.setting.stylist.css') || false;

        if (theme)
        {
            document.getElementById('theme-stylesheet').href = window.app.url + "/static/css/skins/" + theme;
        }

        if (css && css.length > 0)
        {
            document.getElementById('user-css').innerHTML = css;
        }
    </script>

    @yield('required-js')

    <script data-no-instant src="{{ mix('static/js/vendor.js') }}"></script>
    <script data-no-instant src="{{ mix('static/js/app.js') }}"></script>
    <script data-no-instant src="{{ mix('static/js/vue.js') }}"></script>
    @parent
@stop

@section('footer')
<footer>
    @yield('footer-inner')

    @if (site_setting('canary'))
    <figure id="canary-bird">
        <img
            src="{{ asset('static/img/assets/canary.svg') }}"
            id="canary-img"
            alt="{{ trans('config.canary', ['site_name' => $app['settings']('siteName')]) }}"
            title="{{ trans('config.canary', ['site_name' => $app['settings']('siteName')]) }}"
        />
    </figure>
    @endif

    <section id="footnotes">
        <!-- Infinity Next is licensed under AGPL 3.0 and any modifications to this software must link to its source code which can be downloaded in a traditional format, such as a repository. -->
        <div class="copyright"><a class="agpl-compliance" href="https://github.com/infinity-next/infinity-next">Infinity Next</a> &copy; <a class="agpl-compliance" href="https://9chan.us">Infinity Next Development Group</a> 2015-{{ now()->year }}</div>
        @if (site_setting('copyrightAddendum', ""))<div class="copyright">{!! site_setting('copyrightAddendum') !!}</div>@endif
    </section>

    <div id="bottom"></div>
</footer>
@stop
