<!doctype html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <title>{{ env('APP_NAME') }}</title>
    <meta name='robots' content='max-image-preview:large'/>

    <script>
        window._wpemojiSettings = {
            "baseUrl": "https:\/\/s.w.org\/images\/core\/emoji\/14.0.0\/72x72\/",
            "ext": ".png",
            "svgUrl": "https:\/\/s.w.org\/images\/core\/emoji\/14.0.0\/svg\/",
            "svgExt": ".svg",
            "source": {"concatemoji": "https:\/\/demo2.strongtheme.com\/coinone\/wp-includes\/js\/wp-emoji-release.min.js?ver=6.1.7"}
        };
        /*! This file is auto-generated */
        !function (e, a, t) {
            var n, r, o, i = a.createElement("canvas"), p = i.getContext && i.getContext("2d");

            function s(e, t) {
                var a = String.fromCharCode,
                    e = (p.clearRect(0, 0, i.width, i.height), p.fillText(a.apply(this, e), 0, 0), i.toDataURL());
                return p.clearRect(0, 0, i.width, i.height), p.fillText(a.apply(this, t), 0, 0), e === i.toDataURL()
            }

            function c(e) {
                var t = a.createElement("script");
                t.src = e, t.defer = t.type = "text/javascript", a.getElementsByTagName("head")[0].appendChild(t)
            }

            for (o = Array("flag", "emoji"), t.supports = {
                everything: !0,
                everythingExceptFlag: !0
            }, r = 0; r < o.length; r++) t.supports[o[r]] = function (e) {
                if (p && p.fillText) switch (p.textBaseline = "top", p.font = "600 32px Arial", e) {
                    case"flag":
                        return s([127987, 65039, 8205, 9895, 65039], [127987, 65039, 8203, 9895, 65039]) ? !1 : !s([55356, 56826, 55356, 56819], [55356, 56826, 8203, 55356, 56819]) && !s([55356, 57332, 56128, 56423, 56128, 56418, 56128, 56421, 56128, 56430, 56128, 56423, 56128, 56447], [55356, 57332, 8203, 56128, 56423, 8203, 56128, 56418, 8203, 56128, 56421, 8203, 56128, 56430, 8203, 56128, 56423, 8203, 56128, 56447]);
                    case"emoji":
                        return !s([129777, 127995, 8205, 129778, 127999], [129777, 127995, 8203, 129778, 127999])
                }
                return !1
            }(o[r]), t.supports.everything = t.supports.everything && t.supports[o[r]], "flag" !== o[r] && (t.supports.everythingExceptFlag = t.supports.everythingExceptFlag && t.supports[o[r]]);
            t.supports.everythingExceptFlag = t.supports.everythingExceptFlag && !t.supports.flag, t.DOMReady = !1, t.readyCallback = function () {
                t.DOMReady = !0
            }, t.supports.everything || (n = function () {
                t.readyCallback()
            }, a.addEventListener ? (a.addEventListener("DOMContentLoaded", n, !1), e.addEventListener("load", n, !1)) : (e.attachEvent("onload", n), a.attachEvent("onreadystatechange", function () {
                "complete" === a.readyState && t.readyCallback()
            })), (e = t.source || {}).concatemoji ? c(e.concatemoji) : e.wpemoji && e.twemoji && (c(e.twemoji), c(e.wpemoji)))
        }(window, document, window._wpemojiSettings);
    </script>
    <style>
        img.wp-smiley,
        img.emoji {
            display: inline !important;
            border: none !important;
            box-shadow: none !important;
            height: 1em !important;
            width: 1em !important;
            margin: 0 0.07em !important;
            vertical-align: -0.1em !important;
            background: none !important;
            padding: 0 !important;
        }
    </style>
    <link rel='stylesheet' id='classic-theme-styles-css' href='{{ asset('wp-includes/css/classic-themes.min68b3.css?ver=1') }}'
          media='all'/>
    <style id='global-styles-inline-css'>
        body {
            --wp--preset--color--black: #000000;
            --wp--preset--color--cyan-bluish-gray: #abb8c3;
            --wp--preset--color--white: #ffffff;
            --wp--preset--color--pale-pink: #f78da7;
            --wp--preset--color--vivid-red: #cf2e2e;
            --wp--preset--color--luminous-vivid-orange: #ff6900;
            --wp--preset--color--luminous-vivid-amber: #fcb900;
            --wp--preset--color--light-green-cyan: #7bdcb5;
            --wp--preset--color--vivid-green-cyan: #00d084;
            --wp--preset--color--pale-cyan-blue: #8ed1fc;
            --wp--preset--color--vivid-cyan-blue: #0693e3;
            --wp--preset--color--vivid-purple: #9b51e0;
            --wp--preset--gradient--vivid-cyan-blue-to-vivid-purple: linear-gradient(135deg, rgba(6, 147, 227, 1) 0%, rgb(155, 81, 224) 100%);
            --wp--preset--gradient--light-green-cyan-to-vivid-green-cyan: linear-gradient(135deg, rgb(122, 220, 180) 0%, rgb(0, 208, 130) 100%);
            --wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange: linear-gradient(135deg, rgba(252, 185, 0, 1) 0%, rgba(255, 105, 0, 1) 100%);
            --wp--preset--gradient--luminous-vivid-orange-to-vivid-red: linear-gradient(135deg, rgba(255, 105, 0, 1) 0%, rgb(207, 46, 46) 100%);
            --wp--preset--gradient--very-light-gray-to-cyan-bluish-gray: linear-gradient(135deg, rgb(238, 238, 238) 0%, rgb(169, 184, 195) 100%);
            --wp--preset--gradient--cool-to-warm-spectrum: linear-gradient(135deg, rgb(74, 234, 220) 0%, rgb(151, 120, 209) 20%, rgb(207, 42, 186) 40%, rgb(238, 44, 130) 60%, rgb(251, 105, 98) 80%, rgb(254, 248, 76) 100%);
            --wp--preset--gradient--blush-light-purple: linear-gradient(135deg, rgb(255, 206, 236) 0%, rgb(152, 150, 240) 100%);
            --wp--preset--gradient--blush-bordeaux: linear-gradient(135deg, rgb(254, 205, 165) 0%, rgb(254, 45, 45) 50%, rgb(107, 0, 62) 100%);
            --wp--preset--gradient--luminous-dusk: linear-gradient(135deg, rgb(255, 203, 112) 0%, rgb(199, 81, 192) 50%, rgb(65, 88, 208) 100%);
            --wp--preset--gradient--pale-ocean: linear-gradient(135deg, rgb(255, 245, 203) 0%, rgb(182, 227, 212) 50%, rgb(51, 167, 181) 100%);
            --wp--preset--gradient--electric-grass: linear-gradient(135deg, rgb(202, 248, 128) 0%, rgb(113, 206, 126) 100%);
            --wp--preset--gradient--midnight: linear-gradient(135deg, rgb(2, 3, 129) 0%, rgb(40, 116, 252) 100%);
            --wp--preset--duotone--dark-grayscale: url('#wp-duotone-dark-grayscale');
            --wp--preset--duotone--grayscale: url('#wp-duotone-grayscale');
            --wp--preset--duotone--purple-yellow: url('#wp-duotone-purple-yellow');
            --wp--preset--duotone--blue-red: url('#wp-duotone-blue-red');
            --wp--preset--duotone--midnight: url('#wp-duotone-midnight');
            --wp--preset--duotone--magenta-yellow: url('#wp-duotone-magenta-yellow');
            --wp--preset--duotone--purple-green: url('#wp-duotone-purple-green');
            --wp--preset--duotone--blue-orange: url('#wp-duotone-blue-orange');
            --wp--preset--font-size--small: 13px;
            --wp--preset--font-size--medium: 20px;
            --wp--preset--font-size--large: 36px;
            --wp--preset--font-size--x-large: 42px;
            --wp--preset--spacing--20: 0.44rem;
            --wp--preset--spacing--30: 0.67rem;
            --wp--preset--spacing--40: 1rem;
            --wp--preset--spacing--50: 1.5rem;
            --wp--preset--spacing--60: 2.25rem;
            --wp--preset--spacing--70: 3.38rem;
            --wp--preset--spacing--80: 5.06rem;
        }

        :where(.is-layout-flex) {
            gap: 0.5em;
        }

        body .is-layout-flow > .alignleft {
            float: left;
            margin-inline-start: 0;
            margin-inline-end: 2em;
        }

        body .is-layout-flow > .alignright {
            float: right;
            margin-inline-start: 2em;
            margin-inline-end: 0;
        }

        body .is-layout-flow > .aligncenter {
            margin-left: auto !important;
            margin-right: auto !important;
        }

        body .is-layout-constrained > .alignleft {
            float: left;
            margin-inline-start: 0;
            margin-inline-end: 2em;
        }

        body .is-layout-constrained > .alignright {
            float: right;
            margin-inline-start: 2em;
            margin-inline-end: 0;
        }

        body .is-layout-constrained > .aligncenter {
            margin-left: auto !important;
            margin-right: auto !important;
        }

        body .is-layout-constrained > :where(:not(.alignleft):not(.alignright):not(.alignfull)) {
            max-width: var(--wp--style--global--content-size);
            margin-left: auto !important;
            margin-right: auto !important;
        }

        body .is-layout-constrained > .alignwide {
            max-width: var(--wp--style--global--wide-size);
        }

        body .is-layout-flex {
            display: flex;
        }

        body .is-layout-flex {
            flex-wrap: wrap;
            align-items: center;
        }

        body .is-layout-flex > * {
            margin: 0;
        }

        :where(.wp-block-columns.is-layout-flex) {
            gap: 2em;
        }

        .has-black-color {
            color: var(--wp--preset--color--black) !important;
        }

        .has-cyan-bluish-gray-color {
            color: var(--wp--preset--color--cyan-bluish-gray) !important;
        }

        .has-white-color {
            color: var(--wp--preset--color--white) !important;
        }

        .has-pale-pink-color {
            color: var(--wp--preset--color--pale-pink) !important;
        }

        .has-vivid-red-color {
            color: var(--wp--preset--color--vivid-red) !important;
        }

        .has-luminous-vivid-orange-color {
            color: var(--wp--preset--color--luminous-vivid-orange) !important;
        }

        .has-luminous-vivid-amber-color {
            color: var(--wp--preset--color--luminous-vivid-amber) !important;
        }

        .has-light-green-cyan-color {
            color: var(--wp--preset--color--light-green-cyan) !important;
        }

        .has-vivid-green-cyan-color {
            color: var(--wp--preset--color--vivid-green-cyan) !important;
        }

        .has-pale-cyan-blue-color {
            color: var(--wp--preset--color--pale-cyan-blue) !important;
        }

        .has-vivid-cyan-blue-color {
            color: var(--wp--preset--color--vivid-cyan-blue) !important;
        }

        .has-vivid-purple-color {
            color: var(--wp--preset--color--vivid-purple) !important;
        }

        .has-black-background-color {
            background-color: var(--wp--preset--color--black) !important;
        }

        .has-cyan-bluish-gray-background-color {
            background-color: var(--wp--preset--color--cyan-bluish-gray) !important;
        }

        .has-white-background-color {
            background-color: var(--wp--preset--color--white) !important;
        }

        .has-pale-pink-background-color {
            background-color: var(--wp--preset--color--pale-pink) !important;
        }

        .has-vivid-red-background-color {
            background-color: var(--wp--preset--color--vivid-red) !important;
        }

        .has-luminous-vivid-orange-background-color {
            background-color: var(--wp--preset--color--luminous-vivid-orange) !important;
        }

        .has-luminous-vivid-amber-background-color {
            background-color: var(--wp--preset--color--luminous-vivid-amber) !important;
        }

        .has-light-green-cyan-background-color {
            background-color: var(--wp--preset--color--light-green-cyan) !important;
        }

        .has-vivid-green-cyan-background-color {
            background-color: var(--wp--preset--color--vivid-green-cyan) !important;
        }

        .has-pale-cyan-blue-background-color {
            background-color: var(--wp--preset--color--pale-cyan-blue) !important;
        }

        .has-vivid-cyan-blue-background-color {
            background-color: var(--wp--preset--color--vivid-cyan-blue) !important;
        }

        .has-vivid-purple-background-color {
            background-color: var(--wp--preset--color--vivid-purple) !important;
        }

        .has-black-border-color {
            border-color: var(--wp--preset--color--black) !important;
        }

        .has-cyan-bluish-gray-border-color {
            border-color: var(--wp--preset--color--cyan-bluish-gray) !important;
        }

        .has-white-border-color {
            border-color: var(--wp--preset--color--white) !important;
        }

        .has-pale-pink-border-color {
            border-color: var(--wp--preset--color--pale-pink) !important;
        }

        .has-vivid-red-border-color {
            border-color: var(--wp--preset--color--vivid-red) !important;
        }

        .has-luminous-vivid-orange-border-color {
            border-color: var(--wp--preset--color--luminous-vivid-orange) !important;
        }

        .has-luminous-vivid-amber-border-color {
            border-color: var(--wp--preset--color--luminous-vivid-amber) !important;
        }

        .has-light-green-cyan-border-color {
            border-color: var(--wp--preset--color--light-green-cyan) !important;
        }

        .has-vivid-green-cyan-border-color {
            border-color: var(--wp--preset--color--vivid-green-cyan) !important;
        }

        .has-pale-cyan-blue-border-color {
            border-color: var(--wp--preset--color--pale-cyan-blue) !important;
        }

        .has-vivid-cyan-blue-border-color {
            border-color: var(--wp--preset--color--vivid-cyan-blue) !important;
        }

        .has-vivid-purple-border-color {
            border-color: var(--wp--preset--color--vivid-purple) !important;
        }

        .has-vivid-cyan-blue-to-vivid-purple-gradient-background {
            background: var(--wp--preset--gradient--vivid-cyan-blue-to-vivid-purple) !important;
        }

        .has-light-green-cyan-to-vivid-green-cyan-gradient-background {
            background: var(--wp--preset--gradient--light-green-cyan-to-vivid-green-cyan) !important;
        }

        .has-luminous-vivid-amber-to-luminous-vivid-orange-gradient-background {
            background: var(--wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange) !important;
        }

        .has-luminous-vivid-orange-to-vivid-red-gradient-background {
            background: var(--wp--preset--gradient--luminous-vivid-orange-to-vivid-red) !important;
        }

        .has-very-light-gray-to-cyan-bluish-gray-gradient-background {
            background: var(--wp--preset--gradient--very-light-gray-to-cyan-bluish-gray) !important;
        }

        .has-cool-to-warm-spectrum-gradient-background {
            background: var(--wp--preset--gradient--cool-to-warm-spectrum) !important;
        }

        .has-blush-light-purple-gradient-background {
            background: var(--wp--preset--gradient--blush-light-purple) !important;
        }

        .has-blush-bordeaux-gradient-background {
            background: var(--wp--preset--gradient--blush-bordeaux) !important;
        }

        .has-luminous-dusk-gradient-background {
            background: var(--wp--preset--gradient--luminous-dusk) !important;
        }

        .has-pale-ocean-gradient-background {
            background: var(--wp--preset--gradient--pale-ocean) !important;
        }

        .has-electric-grass-gradient-background {
            background: var(--wp--preset--gradient--electric-grass) !important;
        }

        .has-midnight-gradient-background {
            background: var(--wp--preset--gradient--midnight) !important;
        }

        .has-small-font-size {
            font-size: var(--wp--preset--font-size--small) !important;
        }

        .has-medium-font-size {
            font-size: var(--wp--preset--font-size--medium) !important;
        }

        .has-large-font-size {
            font-size: var(--wp--preset--font-size--large) !important;
        }

        .has-x-large-font-size {
            font-size: var(--wp--preset--font-size--x-large) !important;
        }

        .wp-block-navigation a:where(:not(.wp-element-button)) {
            color: inherit;
        }

        :where(.wp-block-columns.is-layout-flex) {
            gap: 2em;
        }

        .wp-block-pullquote {
            font-size: 1.5em;
            line-height: 1.6;
        }
    </style>

    <link rel='stylesheet' id='template-kit-export-css'
      href='{{ asset('wp-content/plugins/template-kit-export/public/assets/css/template-kit-export-public.min365c.css?ver=1.0.21') }}'
      media='all'/>
<link rel='stylesheet' id='hello-elementor-css'
      href='{{ asset('wp-content/themes/hello-elementor/style.minc141.css?ver=2.6.1') }}' media='all'/>
<link rel='stylesheet' id='hello-elementor-theme-style-css'
      href='{{ asset('wp-content/themes/hello-elementor/theme.minc141.css?ver=2.6.1') }}' media='all'/>
<link rel='stylesheet' id='elementor-frontend-css'
      href='{{ asset('wp-content/plugins/elementor/assets/css/frontend-lite.mind5d5.css?ver=3.23.4') }}' media='all'/>
<link rel='stylesheet' id='elementor-post-3-css'
      href='{{ asset('wp-content/uploads/sites/5/elementor/css/post-38b81.css?ver=1706807157') }}' media='all'/>
<link rel='stylesheet' id='elementor-icons-css'
      href='{{ asset('wp-content/plugins/elementor/assets/lib/eicons/css/elementor-icons.mine94d.css?ver=5.30.0') }}'
      media='all'/>
<link rel='stylesheet' id='swiper-css'
      href='{{ asset('wp-content/plugins/elementor/assets/lib/swiper/v8/css/swiper.min94a4.css?ver=8.4.5') }}'
      media='all'/>
<link rel='stylesheet' id='elementor-pro-css'
      href='{{ asset('wp-content/plugins/elementor-pro/assets/css/frontend-lite.min225e.css?ver=3.19.0') }}' media='all'/>
<link rel='stylesheet' id='font-awesome-5-all-css'
      href='{{ asset('wp-content/plugins/elementor/assets/lib/font-awesome/css/all.mind5d5.css?ver=3.23.4') }}'
      media='all'/>
<link rel='stylesheet' id='font-awesome-4-shim-css'
      href='{{ asset('wp-content/plugins/elementor/assets/lib/font-awesome/css/v4-shims.mind5d5.css?ver=3.23.4') }}'
      media='all'/>
<link rel='stylesheet' id='elementor-post-6-css'
      href='{{ asset('wp-content/uploads/sites/5/elementor/css/post-66fe9.css?ver=1706807158') }}' media='all'/>
<link rel='stylesheet' id='elementor-post-634-css'
      href='{{ asset('wp-content/uploads/sites/5/elementor/css/post-6346fe9.css?ver=1706807158') }}' media='all'/>
<link rel='stylesheet' id='elementor-post-582-css'
      href='{{ asset('wp-content/uploads/sites/5/elementor/css/post-5826fe9.css?ver=1706807158') }}' media='all'/>
<link rel='stylesheet' id='google-fonts-1-css'
      href='https://fonts.googleapis.com/css?family=Lexend%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic%7CQuestrial%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic&amp;display=auto&amp;ver=6.1.7'
      media='all'/>
<link rel='stylesheet' id='elementor-icons-shared-0-css'
      href='{{ asset('wp-content/plugins/elementor/assets/lib/font-awesome/css/fontawesome.min52d5.css?ver=5.15.3') }}'
      media='all'/>
<link rel='stylesheet' id='elementor-icons-fa-solid-css'
      href='{{ asset('wp-content/plugins/elementor/assets/lib/font-awesome/css/solid.min52d5.css?ver=5.15.3') }}'
      media='all'/>
<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
<script src='{{ asset('wp-includes/js/jquery/jquery.mina7a0.js?ver=3.6.1') }}' id='jquery-core-js'></script>
<script src='{{ asset('wp-includes/js/jquery/jquery-migrate.mind617.js?ver=3.3.2') }}' id='jquery-migrate-js'></script>
<script src='{{ asset('wp-content/plugins/template-kit-export/public/assets/js/template-kit-export-public.min365c.js?ver=1.0.21') }}'
        id='template-kit-export-js'></script>
<script src='{{ asset('wp-content/plugins/elementor/assets/lib/font-awesome/js/v4-shims.mind5d5.js?ver=3.23.4') }}'
        id='font-awesome-4-shim-js'></script>


    <style>
        .e-con.e-parent:nth-of-type(n+4):not(.e-lazyloaded):not(.e-no-lazyload),
        .e-con.e-parent:nth-of-type(n+4):not(.e-lazyloaded):not(.e-no-lazyload) * {
            background-image: none !important;
        }

        @media screen and (max-height: 1024px) {
            .e-con.e-parent:nth-of-type(n+3):not(.e-lazyloaded):not(.e-no-lazyload),
            .e-con.e-parent:nth-of-type(n+3):not(.e-lazyloaded):not(.e-no-lazyload) * {
                background-image: none !important;
            }
        }

        @media screen and (max-height: 640px) {
            .e-con.e-parent:nth-of-type(n+2):not(.e-lazyloaded):not(.e-no-lazyload),
            .e-con.e-parent:nth-of-type(n+2):not(.e-lazyloaded):not(.e-no-lazyload) * {
                background-image: none !important;
            }
        }
    </style>
    <meta name="theme-color" content="#F1F8FF">

    <style>
        /* General menu styles */
.dropdown-menu {
    font-family: Arial, sans-serif;
    position: relative;
}

.menu {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
}

.menu-item {
    position: relative;
}

.menu-item > a {
    text-decoration: none;
    padding: 10px 15px;
    display: block;
    color: #333;
    /*background-color: #f5f5f5;*/
    border-radius: 5px;
    transition: background-color 0.3s;
}

.menu-item > a:hover {
    background-color: #ddd;
}

/* Submenu styles */
.submenu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    list-style: none;
    padding: 10px 0;
    background-color: #f5f5f5;
    border-radius: 5px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    z-index: 1000;
}

.submenu li {
    padding: 5px 15px;
}

.submenu li a {
    text-decoration: none;
    color: #333;
    display: block;
    transition: color 0.3s;
}

.submenu li a:hover {
    color: #007BFF;
}

/* Show submenu on hover */
.menu-item:hover > .submenu {
    display: block;
}

    </style>

    <script src="//code.jivosite.com/widget/ncGgmn72BI" async></script>

</head>
<body
    class="home page-template page-template-elementor_header_footer page page-id-6 wp-custom-logo elementor-default elementor-template-full-width elementor-kit-3 elementor-page elementor-page-6">

<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0" focusable="false" role="none"
     style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;">
    <defs>
        <filter id="wp-duotone-dark-grayscale">
            <feColorMatrix color-interpolation-filters="sRGB" type="matrix"
                           values=" .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 "/>
            <feComponentTransfer color-interpolation-filters="sRGB">
                <feFuncR type="table" tableValues="0 0.49803921568627"/>
                <feFuncG type="table" tableValues="0 0.49803921568627"/>
                <feFuncB type="table" tableValues="0 0.49803921568627"/>
                <feFuncA type="table" tableValues="1 1"/>
            </feComponentTransfer>
            <feComposite in2="SourceGraphic" operator="in"/>
        </filter>
    </defs>
</svg>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0" focusable="false" role="none"
     style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;">
    <defs>
        <filter id="wp-duotone-grayscale">
            <feColorMatrix color-interpolation-filters="sRGB" type="matrix"
                           values=" .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 "/>
            <feComponentTransfer color-interpolation-filters="sRGB">
                <feFuncR type="table" tableValues="0 1"/>
                <feFuncG type="table" tableValues="0 1"/>
                <feFuncB type="table" tableValues="0 1"/>
                <feFuncA type="table" tableValues="1 1"/>
            </feComponentTransfer>
            <feComposite in2="SourceGraphic" operator="in"/>
        </filter>
    </defs>
</svg>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0" focusable="false" role="none"
     style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;">
    <defs>
        <filter id="wp-duotone-purple-yellow">
            <feColorMatrix color-interpolation-filters="sRGB" type="matrix"
                           values=" .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 "/>
            <feComponentTransfer color-interpolation-filters="sRGB">
                <feFuncR type="table" tableValues="0.54901960784314 0.98823529411765"/>
                <feFuncG type="table" tableValues="0 1"/>
                <feFuncB type="table" tableValues="0.71764705882353 0.25490196078431"/>
                <feFuncA type="table" tableValues="1 1"/>
            </feComponentTransfer>
            <feComposite in2="SourceGraphic" operator="in"/>
        </filter>
    </defs>
</svg>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0" focusable="false" role="none"
     style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;">
    <defs>
        <filter id="wp-duotone-blue-red">
            <feColorMatrix color-interpolation-filters="sRGB" type="matrix"
                           values=" .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 "/>
            <feComponentTransfer color-interpolation-filters="sRGB">
                <feFuncR type="table" tableValues="0 1"/>
                <feFuncG type="table" tableValues="0 0.27843137254902"/>
                <feFuncB type="table" tableValues="0.5921568627451 0.27843137254902"/>
                <feFuncA type="table" tableValues="1 1"/>
            </feComponentTransfer>
            <feComposite in2="SourceGraphic" operator="in"/>
        </filter>
    </defs>
</svg>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0" focusable="false" role="none"
     style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;">
    <defs>
        <filter id="wp-duotone-midnight">
            <feColorMatrix color-interpolation-filters="sRGB" type="matrix"
                           values=" .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 "/>
            <feComponentTransfer color-interpolation-filters="sRGB">
                <feFuncR type="table" tableValues="0 0"/>
                <feFuncG type="table" tableValues="0 0.64705882352941"/>
                <feFuncB type="table" tableValues="0 1"/>
                <feFuncA type="table" tableValues="1 1"/>
            </feComponentTransfer>
            <feComposite in2="SourceGraphic" operator="in"/>
        </filter>
    </defs>
</svg>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0" focusable="false" role="none"
     style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;">
    <defs>
        <filter id="wp-duotone-magenta-yellow">
            <feColorMatrix color-interpolation-filters="sRGB" type="matrix"
                           values=" .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 "/>
            <feComponentTransfer color-interpolation-filters="sRGB">
                <feFuncR type="table" tableValues="0.78039215686275 1"/>
                <feFuncG type="table" tableValues="0 0.94901960784314"/>
                <feFuncB type="table" tableValues="0.35294117647059 0.47058823529412"/>
                <feFuncA type="table" tableValues="1 1"/>
            </feComponentTransfer>
            <feComposite in2="SourceGraphic" operator="in"/>
        </filter>
    </defs>
</svg>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0" focusable="false" role="none"
     style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;">
    <defs>
        <filter id="wp-duotone-purple-green">
            <feColorMatrix color-interpolation-filters="sRGB" type="matrix"
                           values=" .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 "/>
            <feComponentTransfer color-interpolation-filters="sRGB">
                <feFuncR type="table" tableValues="0.65098039215686 0.40392156862745"/>
                <feFuncG type="table" tableValues="0 1"/>
                <feFuncB type="table" tableValues="0.44705882352941 0.4"/>
                <feFuncA type="table" tableValues="1 1"/>
            </feComponentTransfer>
            <feComposite in2="SourceGraphic" operator="in"/>
        </filter>
    </defs>
</svg>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 0 0" width="0" height="0" focusable="false" role="none"
     style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;">
    <defs>
        <filter id="wp-duotone-blue-orange">
            <feColorMatrix color-interpolation-filters="sRGB" type="matrix"
                           values=" .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 "/>
            <feComponentTransfer color-interpolation-filters="sRGB">
                <feFuncR type="table" tableValues="0.098039215686275 1"/>
                <feFuncG type="table" tableValues="0 0.66274509803922"/>
                <feFuncB type="table" tableValues="0.84705882352941 0.41960784313725"/>
                <feFuncA type="table" tableValues="1 1"/>
            </feComponentTransfer>
            <feComposite in2="SourceGraphic" operator="in"/>
        </filter>
    </defs>
</svg>
<a class="skip-link screen-reader-text" href="#content">Skip to content</a>

<div data-elementor-type="header" data-elementor-id="634" class="elementor elementor-634 elementor-location-header"
     data-elementor-post-type="elementor_library">
    <section
        class="elementor-section elementor-top-section elementor-element elementor-element-aabb6c8 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
        data-id="aabb6c8" data-element_type="section"
        data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
        <div class="elementor-container elementor-column-gap-default">
            <div
                class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-b768278"
                data-id="b768278" data-element_type="column">
                <div class="elementor-widget-wrap elementor-element-populated">
                    <div class="elementor-element elementor-element-5e03de4 elementor-widget elementor-widget-image"
                         data-id="5e03de4" data-element_type="widget" data-widget_type="image.default">
                        <div class="elementor-widget-container">
                            <img src="{{ asset('img/logo.png') }}"  alt="">
                            <style>/*! elementor - v3.23.0 - 05-08-2024 */
                                .elementor-widget-image {
                                    text-align: center
                                }

                                .elementor-widget-image a {
                                    display: inline-block
                                }

                                .elementor-widget-image a img[src$=".svg"] {
                                    width: 48px
                                }

                                .elementor-widget-image img {
                                    vertical-align: middle;
                                    display: inline-block
                                }</style>
{{--                            <img fetchpriority="high" width="800" height="207"--}}
{{--                                 src="wp-content/uploads/sites/5/2021/08/Logo-1024x265.png"--}}
{{--                                 class="attachment-large size-large wp-image-613" alt=""--}}
{{--                                 srcset="https://demo2.strongtheme.com/coinone/wp-content/uploads/sites/5/2021/08/Logo-1024x265.png 1024w, https://demo2.strongtheme.com/coinone/wp-content/uploads/sites/5/2021/08/Logo-300x78.png 300w, https://demo2.strongtheme.com/coinone/wp-content/uploads/sites/5/2021/08/Logo-768x199.png 768w, https://demo2.strongtheme.com/coinone/wp-content/uploads/sites/5/2021/08/Logo-800x207.png 800w, https://demo2.strongtheme.com/coinone/wp-content/uploads/sites/5/2021/08/Logo.png 1276w"--}}
{{--                                 sizes="(max-width: 800px) 100vw, 800px"/>--}}
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-0766e43"
                data-id="0766e43" data-element_type="column">
                <div class="elementor-widget-wrap elementor-element-populated">
                    <div
                        class="elementor-element elementor-element-a9c9edf elementor-nav-menu__align-end elementor-nav-menu--stretch elementor-nav-menu--dropdown-tablet elementor-nav-menu__text-align-aside elementor-nav-menu--toggle elementor-nav-menu--burger elementor-widget elementor-widget-nav-menu"
                        data-id="a9c9edf" data-element_type="widget"
                        data-settings="{&quot;full_width&quot;:&quot;stretch&quot;,&quot;layout&quot;:&quot;horizontal&quot;,&quot;submenu_icon&quot;:{&quot;value&quot;:&quot;&lt;i class=\&quot;fas fa-caret-down\&quot;&gt;&lt;\/i&gt;&quot;,&quot;library&quot;:&quot;fa-solid&quot;},&quot;toggle&quot;:&quot;burger&quot;}"
                        data-widget_type="nav-menu.default">
                        <div class="elementor-widget-container">
                            <link rel="stylesheet"
                                  href="{{ asset('wp-content/plugins/elementor-pro/assets/css/widget-nav-menu.min.css') }}">
                            <nav
                                class="elementor-nav-menu--main elementor-nav-menu__container elementor-nav-menu--layout-horizontal e--pointer-none">
                                <ul id="menu-1-a9c9edf" class="elementor-nav-menu">
                                    <li class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-1394">
                                        <a href="{{ route('index') }}" aria-current="page"
                                           class="elementor-item elementor-item-active">Home</a></li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1391">
                                        <a href="{{ route('products') }}" class="elementor-item">Trade</a>
                                        <ul class="submenu">
                                            <li><a href="{{ route('user.dashboard') }}">Future</a></li>
                                            <li><a href="{{ route('user.dashboard') }}">Spot</a></li>
                                            <li><a href="{{ route('user.dashboard') }}">Margin</a></li>
                                            <li><a href="{{ route('user.dashboard') }}">Copy Trading</a></li>
                                            <li><a href="{{ route('user.dashboard') }}">AI Assist</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1388">
                                        <a href="{{ route('market') }}" class="elementor-item">Markets</a></li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1391">
                                        <a href="{{ route('products') }}" class="elementor-item">Buy Crypto</a>
                                        <ul class="submenu">
                                            <li><a href="https://www.moonpay.com/buy" target="_blank">MoonPay</a></li>
                                            <li><a href="https://www.kraken.com/" target="_blank">Kraken</a></li>
                                            <li><a href="https://www.bybit.com/" target="_blank">ByBit</a></li>
                                            <li><a href="https://www.binance.com/" target="_blank">Binance</a></li>
                                        </ul>
                                    </li>
{{--                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1382">--}}
{{--                                        <a href="about/index.html" class="elementor-item">About</a></li>--}}
                                </ul>
                            </nav>
                            <div class="elementor-menu-toggle" role="button" tabindex="0" aria-label="Menu Toggle"
                                 aria-expanded="false">
                                <i aria-hidden="true" role="presentation"
                                   class="elementor-menu-toggle__icon--open eicon-menu-bar"></i>
                                <i aria-hidden="true"
                                                   role="presentation"
                                                   class="elementor-menu-toggle__icon--close eicon-close"></i>
                                <span class="elementor-screen-only">Menu</span>
                            </div>
                            <nav class="elementor-nav-menu--dropdown elementor-nav-menu__container" aria-hidden="true">
                                <ul id="menu-2-a9c9edf" class="elementor-nav-menu">
                                    <li class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-1394">
                                        <a href="{{ route('index') }}" aria-current="page"
                                           class="elementor-item elementor-item-active" tabindex="-1">Home</a></li>
{{--                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1391">--}}
{{--                                        <a href="{{ route('products') }}" class="elementor-item" tabindex="-1">Products</a>--}}
{{--                                    </li>--}}
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1388">
                                        <a href="{{ route('market') }}" class="elementor-item" tabindex="-1">Market
                                            Coin</a></li>
                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1382">
                                        <a href="#about" class="elementor-item" tabindex="-1">About</a></li>

{{--                                    <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1385">--}}
{{--                                        <a href="contact-us/index.html" class="elementor-item" tabindex="-1">Contact--}}
{{--                                            Us</a></li>--}}
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="elementor-column elementor-col-33 elementor-top-column elementor-element elementor-element-7b48a59 elementor-hidden-tablet elementor-hidden-phone"
                data-id="7b48a59" data-element_type="column">
                <div class="elementor-widget-wrap elementor-element-populated">
                    <section
                        class="elementor-section elementor-inner-section elementor-element elementor-element-b59c7b3 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                        data-id="b59c7b3" data-element_type="section">
                        <div class="elementor-container elementor-column-gap-default">
                            <div
                                class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-7c6da81"
                                data-id="7c6da81" data-element_type="column">
                                <div class="elementor-widget-wrap elementor-element-populated">
                                    <div
                                        class="elementor-element elementor-element-cc7529d elementor-align-justify elementor-widget elementor-widget-button"
                                        data-id="cc7529d" data-element_type="widget" data-widget_type="button.default">
                                        <div class="elementor-widget-container">
                                            <div class="elementor-button-wrapper">
                                                 @guest
                                                <a class="elementor-button elementor-button-link elementor-size-sm"
                                                   href="{{ route('register') }}" target="_blank">
                                                    <span class="elementor-button-content-wrapper">
                                                                <span class="elementor-button-text">Sign Up</span>
                                                </span>
                                                </a>
                                                @endguest
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-6515f55"
                                data-id="6515f55" data-element_type="column">
                                <div class="elementor-widget-wrap elementor-element-populated">
                                    <div
                                        class="elementor-element elementor-element-050c9e1 elementor-align-right elementor-widget elementor-widget-button"
                                        data-id="050c9e1" data-element_type="widget" data-widget_type="button.default">
                                        <div class="elementor-widget-container">
                                            <div class="elementor-button-wrapper">
                                                @guest
                                                <a class="elementor-button elementor-button-link elementor-size-sm"
                                                   href="{{ route('login') }}" target="_blank">
						<span class="elementor-button-content-wrapper">
									<span class="elementor-button-text">Login</span>
					</span>
                                                </a>
                                                @else
                                                    <a style="margin-left: 5px" class="elementor-button elementor-button-link elementor-size-sm"
                                                   href="{{ route('user.dashboard') }}" target="_blank">
                                                        <span class="elementor-button-content-wrapper">
                                                                    <span class="elementor-button-text">Dashboard</span>
                                                    </span>
                                                </a>
                                                @endguest
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
</div>

@yield('content')

<div data-elementor-type="footer" data-elementor-id="582" class="elementor elementor-582 elementor-location-footer"
     data-elementor-post-type="elementor_library">
    <section
        class="elementor-section elementor-top-section elementor-element elementor-element-f5c7696 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
        data-id="f5c7696" data-element_type="section">
        <div class="elementor-container elementor-column-gap-default">
            <div
                class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-b6c1931"
                data-id="b6c1931" data-element_type="column"
                data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                <div class="elementor-widget-wrap elementor-element-populated">
                    <section
                        class="elementor-section elementor-inner-section elementor-element elementor-element-731a3d4 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                        data-id="731a3d4" data-element_type="section">
                        <div class="elementor-container elementor-column-gap-default">
                            <div
                                class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-8d87f94"
                                data-id="8d87f94" data-element_type="column">
                                <div class="elementor-widget-wrap elementor-element-populated">
                                    <div
                                        class="elementor-element elementor-element-0851529 elementor-invisible elementor-widget elementor-widget-heading"
                                        data-id="0851529" data-element_type="widget"
                                        data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:200}"
                                        data-widget_type="heading.default">
                                        <div class="elementor-widget-container">
                                            <h2 class="elementor-heading-title elementor-size-default">Get {{ env('APP_NAME') }}
                                                Crypto</h2></div>
                                    </div>
                                    <div
                                        class="elementor-element elementor-element-83d1b7a elementor-invisible elementor-widget elementor-widget-heading"
                                        data-id="83d1b7a" data-element_type="widget"
                                        data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:400}"
                                        data-widget_type="heading.default">
                                        <div class="elementor-widget-container">
                                            <h6 class="elementor-heading-title elementor-size-default">The Ultimate
                                                Security for Your Digital Assets</h6></div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-7760c54"
                                data-id="7760c54" data-element_type="column">
                                <div class="elementor-widget-wrap elementor-element-populated">
                                    <div
                                        class="elementor-element elementor-element-52c232d elementor-invisible elementor-widget elementor-widget-image"
                                        data-id="52c232d" data-element_type="widget"
                                        data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:200}"
                                        data-widget_type="image.default">
                                        <div class="elementor-widget-container">
                                            <img width="592" height="175"
                                                 src="wp-content/uploads/sites/5/2021/07/coinonehome010.png"
                                                 class="elementor-animation-shrink attachment-large size-large wp-image-332"
                                                 alt=""
                                                 srcset="https://demo2.strongtheme.com/coinone/wp-content/uploads/sites/5/2021/07/coinonehome010.png 592w, https://demo2.strongtheme.com/coinone/wp-content/uploads/sites/5/2021/07/coinonehome010-300x89.png 300w"
                                                 sizes="(max-width: 592px) 100vw, 592px"/></div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-66457a1"
                                data-id="66457a1" data-element_type="column">
                                <div class="elementor-widget-wrap elementor-element-populated">
                                    <div
                                        class="elementor-element elementor-element-e4d5c6c elementor-invisible elementor-widget elementor-widget-image"
                                        data-id="e4d5c6c" data-element_type="widget"
                                        data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:400}"
                                        data-widget_type="image.default">
                                        <div class="elementor-widget-container">
                                            <img width="592" height="175"
                                                 src="wp-content/uploads/sites/5/2021/07/coinonehome09.png"
                                                 class="elementor-animation-shrink attachment-large size-large wp-image-331"
                                                 alt=""
                                                 srcset="https://demo2.strongtheme.com/coinone/wp-content/uploads/sites/5/2021/07/coinonehome09.png 592w, https://demo2.strongtheme.com/coinone/wp-content/uploads/sites/5/2021/07/coinonehome09-300x89.png 300w"
                                                 sizes="(max-width: 592px) 100vw, 592px"/></div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-15801da elementor-hidden-phone"
                                data-id="15801da" data-element_type="column">
                                <div class="elementor-widget-wrap elementor-element-populated">
                                    <div
                                        class="elementor-element elementor-element-3f30b9c elementor-invisible elementor-widget elementor-widget-image"
                                        data-id="3f30b9c" data-element_type="widget"
                                        data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:600}"
                                        data-widget_type="image.default">
                                        <div class="elementor-widget-container">
                                            <img width="234" height="68"
                                                 src="wp-content/uploads/sites/5/2021/07/coinonehome011.png"
                                                 class="elementor-animation-shrink attachment-large size-large wp-image-336"
                                                 alt=""/></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
    <section
        class="elementor-section elementor-top-section elementor-element elementor-element-54a2ebf elementor-section-boxed elementor-section-height-default elementor-section-height-default"
        data-id="54a2ebf" data-element_type="section">
        <div class="elementor-container elementor-column-gap-default">
            <div
                class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-afba3d9"
                data-id="afba3d9" data-element_type="column"
                data-settings="{&quot;background_background&quot;:&quot;gradient&quot;}">
                <div class="elementor-widget-wrap elementor-element-populated">
                    <section
                        class="elementor-section elementor-inner-section elementor-element elementor-element-c8fce66 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                        data-id="c8fce66" data-element_type="section">
                        <div class="elementor-container elementor-column-gap-default">
                            <div
                                class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-f318752"
                                data-id="f318752" data-element_type="column">
                                <div class="elementor-widget-wrap elementor-element-populated">
                                    <div
                                        class="elementor-element elementor-element-2fa9851 elementor-invisible elementor-widget elementor-widget-image"
                                        data-id="2fa9851" data-element_type="widget"
                                        data-settings="{&quot;_animation&quot;:&quot;fadeIn&quot;,&quot;_animation_delay&quot;:400}"
                                        data-widget_type="image.default">
                                        <div class="elementor-widget-container">
                                            <img width="800" height="655"
                                                 src="wp-content/uploads/sites/5/2021/08/coinonehome029-1024x838.png"
                                                 class="attachment-large size-large wp-image-591" alt=""
                                                 srcset="https://demo2.strongtheme.com/coinone/wp-content/uploads/sites/5/2021/08/coinonehome029-1024x838.png 1024w, https://demo2.strongtheme.com/coinone/wp-content/uploads/sites/5/2021/08/coinonehome029-300x246.png 300w, https://demo2.strongtheme.com/coinone/wp-content/uploads/sites/5/2021/08/coinonehome029-768x629.png 768w, https://demo2.strongtheme.com/coinone/wp-content/uploads/sites/5/2021/08/coinonehome029-800x655.png 800w, https://demo2.strongtheme.com/coinone/wp-content/uploads/sites/5/2021/08/coinonehome029.png 1250w"
                                                 sizes="(max-width: 800px) 100vw, 800px"/></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
    <section
        class="elementor-section elementor-top-section elementor-element elementor-element-6445f69 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
        data-id="6445f69" data-element_type="section"
        data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
        <div class="elementor-container elementor-column-gap-default">
            <div
                class="elementor-column elementor-col-20 elementor-top-column elementor-element elementor-element-61906ae"
                data-id="61906ae" data-element_type="column">
                <div class="elementor-widget-wrap elementor-element-populated">
                    <div
                        class="elementor-element elementor-element-85102d6 elementor-invisible elementor-widget elementor-widget-image"
                        data-id="85102d6" data-element_type="widget"
                        data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:100}"
                        data-widget_type="image.default">
                        <div class="elementor-widget-container">
                            <img src="{{ asset('img/logo.png') }}"  alt="">

                        </div>
                    </div>
                    <div
                        class="elementor-element elementor-element-1c2b30e elementor-invisible elementor-widget elementor-widget-text-editor"
                        data-id="1c2b30e" data-element_type="widget"
                        data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:400}"
                        data-widget_type="text-editor.default">
                        <div class="elementor-widget-container">
                            <p>Trade crypto.
                            Anytime, Anywhere.
                            </p></div>
                    </div>
                    <div
                        class="elementor-element elementor-element-2baed1f elementor-invisible elementor-widget elementor-widget-image"
                        data-id="2baed1f" data-element_type="widget"
                        data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:400}"
                        data-widget_type="image.default">
                        <div class="elementor-widget-container">
                            <img width="600" height="292" src="wp-content/uploads/sites/5/2021/08/coinonehome030.png"
                                 class="attachment-large size-large wp-image-629" alt=""
                                 srcset="https://demo2.strongtheme.com/coinone/wp-content/uploads/sites/5/2021/08/coinonehome030.png 600w, https://demo2.strongtheme.com/coinone/wp-content/uploads/sites/5/2021/08/coinonehome030-300x146.png 300w"
                                 sizes="(max-width: 600px) 100vw, 600px"/></div>
                    </div>
                </div>
            </div>
            <div
                class="elementor-column elementor-col-20 elementor-top-column elementor-element elementor-element-75950fd"
                data-id="75950fd" data-element_type="column">
                <div class="elementor-widget-wrap elementor-element-populated">
                    <div
                        class="elementor-element elementor-element-4c05f6e elementor-invisible elementor-widget elementor-widget-heading"
                        data-id="4c05f6e" data-element_type="widget"
                        data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:200}"
                        data-widget_type="heading.default">
                        <div class="elementor-widget-container">
                            <h4 class="elementor-heading-title elementor-size-default">Product</h4></div>
                    </div>
                    <div
                        class="elementor-element elementor-element-8d3a485 elementor-tablet-align-center elementor-mobile-align-left elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-invisible elementor-widget elementor-widget-icon-list"
                        data-id="8d3a485" data-element_type="widget"
                        data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:300}"
                        data-widget_type="icon-list.default">
                        <div class="elementor-widget-container">
                            <link rel="stylesheet"
                                  href="wp-content/plugins/elementor/assets/css/widget-icon-list.min.css">
                            <ul class="elementor-icon-list-items">
                                <li class="elementor-icon-list-item">
                                    <a href="{{ route('user.dashboard') }}"><span class="elementor-icon-list-text">Buy Crypto</span></a>
                                </li>
                                <li class="elementor-icon-list-item">
                                    <a href="{{ route('user.dashboard') }}"> <span class="elementor-icon-list-text">Sell Crypto</span></a>
                                </li>
                                <li class="elementor-icon-list-item">
                                    <a href="{{ route('user.dashboard') }}"><span class="elementor-icon-list-text">Track Profit</span></a>
                                </li>
                                <li class="elementor-icon-list-item">
                                    <a href="{{ route('user.dashboard') }}"><span class="elementor-icon-list-text">Realtime Data</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="elementor-column elementor-col-20 elementor-top-column elementor-element elementor-element-24788fe"
                data-id="24788fe" data-element_type="column">
                <div class="elementor-widget-wrap elementor-element-populated">
                    <div
                        class="elementor-element elementor-element-d4a19c8 elementor-invisible elementor-widget elementor-widget-heading"
                        data-id="d4a19c8" data-element_type="widget"
                        data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:400}"
                        data-widget_type="heading.default">
                        <div class="elementor-widget-container">
                            <h4 class="elementor-heading-title elementor-size-default">Company</h4></div>
                    </div>
                    <div
                        class="elementor-element elementor-element-0978a3f elementor-tablet-align-center elementor-mobile-align-left elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-invisible elementor-widget elementor-widget-icon-list"
                        data-id="0978a3f" data-element_type="widget"
                        data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:500}"
                        data-widget_type="icon-list.default">
                        <div class="elementor-widget-container">
                            <ul class="elementor-icon-list-items">
                                <li class="elementor-icon-list-item">
                                    <a href="#about"><span class="elementor-icon-list-text">About Us</span></a>
                                </li>
                                <li class="elementor-icon-list-item">
                                    <a href="#about"><span class="elementor-icon-list-text">Community</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="elementor-column elementor-col-20 elementor-top-column elementor-element elementor-element-a76baf0"
                data-id="a76baf0" data-element_type="column">
                <div class="elementor-widget-wrap elementor-element-populated">
                    <div
                        class="elementor-element elementor-element-cf78ce8 elementor-invisible elementor-widget elementor-widget-heading"
                        data-id="cf78ce8" data-element_type="widget"
                        data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:600}"
                        data-widget_type="heading.default">
                        <div class="elementor-widget-container">
                            <h4 class="elementor-heading-title elementor-size-default">Services</h4></div>
                    </div>
                    <div
                        class="elementor-element elementor-element-bf489ba elementor-tablet-align-center elementor-mobile-align-left elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-invisible elementor-widget elementor-widget-icon-list"
                        data-id="bf489ba" data-element_type="widget"
                        data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:700}"
                        data-widget_type="icon-list.default">
                        <div class="elementor-widget-container">
                            <ul class="elementor-icon-list-items">
                                <li class="elementor-icon-list-item">
                                   <a href="{{ route('user.dashboard') }}"> <span class="elementor-icon-list-text">Download</span></a>
                                </li>
                                <li class="elementor-icon-list-item">
                                    <a href="{{ route('user.dashboard') }}"><span class="elementor-icon-list-text">Desktop Application</span></a>
                                </li>
                                <li class="elementor-icon-list-item">
                                    <a href="{{ route('user.dashboard') }}"><span class="elementor-icon-list-text">Referral</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="elementor-column elementor-col-20 elementor-top-column elementor-element elementor-element-cd0e941"
                data-id="cd0e941" data-element_type="column">
                <div style="display: none" class="elementor-widget-wrap elementor-element-populated">
                    <div
                        class="elementor-element elementor-element-406bdc7 elementor-invisible elementor-widget elementor-widget-heading"
                        data-id="406bdc7" data-element_type="widget"
                        data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:800}"
                        data-widget_type="heading.default">
                        <div class="elementor-widget-container">
                            <h4 class="elementor-heading-title elementor-size-default">Help</h4></div>
                    </div>
                    <div
                        class="elementor-element elementor-element-339bd17 elementor-tablet-align-center elementor-mobile-align-left elementor-icon-list--layout-traditional elementor-list-item-link-full_width elementor-invisible elementor-widget elementor-widget-icon-list"
                        data-id="339bd17" data-element_type="widget"
                        data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:900}"
                        data-widget_type="icon-list.default">
                        <div class="elementor-widget-container">
                            <ul class="elementor-icon-list-items">
                                <li class="elementor-icon-list-item">
                                    <span class="elementor-icon-list-text">Help Center</span>
                                </li>
{{--                                <li class="elementor-icon-list-item">--}}
{{--                                    <span class="elementor-icon-list-text">Privacy</span>--}}
{{--                                </li>--}}
{{--                                <li class="elementor-icon-list-item">--}}
{{--                                    <span class="elementor-icon-list-text">Terms</span>--}}
{{--                                </li>--}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section
        class="elementor-section elementor-top-section elementor-element elementor-element-113be4a elementor-section-boxed elementor-section-height-default elementor-section-height-default"
        data-id="113be4a" data-element_type="section"
        data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
        <div class="elementor-background-overlay"></div>
        <div class="elementor-container elementor-column-gap-default">
            <div
                class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-0dcce92"
                data-id="0dcce92" data-element_type="column">
                <div class="elementor-widget-wrap elementor-element-populated">
                    <div
                        class="elementor-element elementor-element-081eeb4 elementor-invisible elementor-widget elementor-widget-heading"
                        data-id="081eeb4" data-element_type="widget"
                        data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:400}"
                        data-widget_type="heading.default">
                        <div class="elementor-widget-container">
                            <h6 class="elementor-heading-title elementor-size-default">© {{ Date('Y') }} {{ env('APP_NAME') }}</h6></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script type='text/javascript'>
    const lazyloadRunObserver = () => {
        const lazyloadBackgrounds = document.querySelectorAll(`.e-con.e-parent:not(.e-lazyloaded)`);
        const lazyloadBackgroundObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    let lazyloadBackground = entry.target;
                    if (lazyloadBackground) {
                        lazyloadBackground.classList.add('e-lazyloaded');
                    }
                    lazyloadBackgroundObserver.unobserve(entry.target);
                }
            });
        }, {rootMargin: '200px 0px 200px 0px'});
        lazyloadBackgrounds.forEach((lazyloadBackground) => {
            lazyloadBackgroundObserver.observe(lazyloadBackground);
        });
    };
    const events = [
        'DOMContentLoaded',
        'elementor/lazyload/observe',
    ];
    events.forEach((event) => {
        document.addEventListener(event, lazyloadRunObserver);
    });
</script>
<link rel='stylesheet' id='e-animations-css'
      href='wp-content/plugins/elementor/assets/lib/animations/animations.mind5d5.css?ver=3.23.4' media='all'/>
<script src='wp-content/themes/hello-elementor/assets/js/hello-frontend.min8a54.js?ver=1.0.0'
        id='hello-theme-frontend-js'></script>
<script src='wp-content/plugins/elementor-pro/assets/lib/smartmenus/jquery.smartmenus.min1576.js?ver=1.2.1'
        id='smartmenus-js'></script>
<script src='wp-includes/js/imagesloaded.mineda1.js?ver=4.1.4' id='imagesloaded-js'></script>
<script src='wp-content/plugins/elementor/assets/lib/jquery-numerator/jquery-numerator.min3958.js?ver=0.2.1'
        id='jquery-numerator-js'></script>
<script src='wp-content/plugins/elementor-pro/assets/js/webpack-pro.runtime.min225e.js?ver=3.19.0'
        id='elementor-pro-webpack-runtime-js'></script>
<script src='wp-content/plugins/elementor/assets/js/webpack.runtime.mind5d5.js?ver=3.23.4'
        id='elementor-webpack-runtime-js'></script>
<script src='wp-content/plugins/elementor/assets/js/frontend-modules.mind5d5.js?ver=3.23.4'
        id='elementor-frontend-modules-js'></script>
<script src='wp-includes/js/dist/vendor/regenerator-runtime.min3937.js?ver=0.13.9' id='regenerator-runtime-js'></script>
<script src='wp-includes/js/dist/vendor/wp-polyfill.min2c7c.js?ver=3.15.0' id='wp-polyfill-js'></script>
<script src='wp-includes/js/dist/hooks.min6c65.js?ver=4169d3cf8e8d95a3d6d5' id='wp-hooks-js'></script>
<script src='wp-includes/js/dist/i18n.mine57b.js?ver=9e794f35a71bb98672ae' id='wp-i18n-js'></script>
<script id='wp-i18n-js-after'>
    wp.i18n.setLocaleData({'text direction\u0004ltr': ['ltr']});
</script>
<script id='elementor-pro-frontend-js-before'>
    var ElementorProFrontendConfig = {
        "ajaxurl": "https:\/\/demo2.strongtheme.com\/coinone\/wp-admin\/admin-ajax.php",
        "nonce": "699a5b9f89",
        "urls": {
            "assets": "https:\/\/demo2.strongtheme.com\/coinone\/wp-content\/plugins\/elementor-pro\/assets\/",
            "rest": "https:\/\/demo2.strongtheme.com\/coinone\/wp-json\/"
        },
        "shareButtonsNetworks": {
            "facebook": {"title": "Facebook", "has_counter": true},
            "twitter": {"title": "Twitter"},
            "linkedin": {"title": "LinkedIn", "has_counter": true},
            "pinterest": {"title": "Pinterest", "has_counter": true},
            "reddit": {"title": "Reddit", "has_counter": true},
            "vk": {"title": "VK", "has_counter": true},
            "odnoklassniki": {"title": "OK", "has_counter": true},
            "tumblr": {"title": "Tumblr"},
            "digg": {"title": "Digg"},
            "skype": {"title": "Skype"},
            "stumbleupon": {"title": "StumbleUpon", "has_counter": true},
            "mix": {"title": "Mix"},
            "telegram": {"title": "Telegram"},
            "pocket": {"title": "Pocket", "has_counter": true},
            "xing": {"title": "XING", "has_counter": true},
            "whatsapp": {"title": "WhatsApp"},
            "email": {"title": "Email"},
            "print": {"title": "Print"}
        },
        "facebook_sdk": {"lang": "en_US", "app_id": ""},
        "lottie": {"defaultAnimationUrl": "https:\/\/demo2.strongtheme.com\/coinone\/wp-content\/plugins\/elementor-pro\/modules\/lottie\/assets\/animations\/default.json"}
    };
</script>
<script src='wp-content/plugins/elementor-pro/assets/js/frontend.min225e.js?ver=3.19.0'
        id='elementor-pro-frontend-js'></script>
<script src='wp-content/plugins/elementor/assets/lib/waypoints/waypoints.min05da.js?ver=4.0.2'
        id='elementor-waypoints-js'></script>
<script src='wp-includes/js/jquery/ui/core.min3f14.js?ver=1.13.2' id='jquery-ui-core-js'></script>
<script id='elementor-frontend-js-before'>
    var elementorFrontendConfig = {
        "environmentMode": {"edit": false, "wpPreview": false, "isScriptDebug": false},
        "i18n": {
            "shareOnFacebook": "Share on Facebook",
            "shareOnTwitter": "Share on Twitter",
            "pinIt": "Pin it",
            "download": "Download",
            "downloadImage": "Download image",
            "fullscreen": "Fullscreen",
            "zoom": "Zoom",
            "share": "Share",
            "playVideo": "Play Video",
            "previous": "Previous",
            "next": "Next",
            "close": "Close",
            "a11yCarouselWrapperAriaLabel": "Carousel | Horizontal scrolling: Arrow Left & Right",
            "a11yCarouselPrevSlideMessage": "Previous slide",
            "a11yCarouselNextSlideMessage": "Next slide",
            "a11yCarouselFirstSlideMessage": "This is the first slide",
            "a11yCarouselLastSlideMessage": "This is the last slide",
            "a11yCarouselPaginationBulletMessage": "Go to slide"
        },
        "is_rtl": false,
        "breakpoints": {"xs": 0, "sm": 480, "md": 768, "lg": 1025, "xl": 1440, "xxl": 1600},
        "responsive": {
            "breakpoints": {
                "mobile": {
                    "label": "Mobile Portrait",
                    "value": 767,
                    "default_value": 767,
                    "direction": "max",
                    "is_enabled": true
                },
                "mobile_extra": {
                    "label": "Mobile Landscape",
                    "value": 880,
                    "default_value": 880,
                    "direction": "max",
                    "is_enabled": false
                },
                "tablet": {
                    "label": "Tablet Portrait",
                    "value": 1024,
                    "default_value": 1024,
                    "direction": "max",
                    "is_enabled": true
                },
                "tablet_extra": {
                    "label": "Tablet Landscape",
                    "value": 1200,
                    "default_value": 1200,
                    "direction": "max",
                    "is_enabled": false
                },
                "laptop": {
                    "label": "Laptop",
                    "value": 1366,
                    "default_value": 1366,
                    "direction": "max",
                    "is_enabled": false
                },
                "widescreen": {
                    "label": "Widescreen",
                    "value": 2400,
                    "default_value": 2400,
                    "direction": "min",
                    "is_enabled": false
                }
            }
        },
        "version": "3.23.4",
        "is_static": false,
        "experimentalFeatures": {
            "e_optimized_css_loading": true,
            "additional_custom_breakpoints": true,
            "container_grid": true,
            "e_swiper_latest": true,
            "e_nested_atomic_repeaters": true,
            "e_onboarding": true,
            "theme_builder_v2": true,
            "hello-theme-header-footer": true,
            "home_screen": true,
            "ai-layout": true,
            "landing-pages": true,
            "e_lazyload": true,
            "page-transitions": true,
            "notes": true,
            "form-submissions": true,
            "e_scroll_snap": true
        },
        "urls": {
            "assets": "https:\/\/demo2.strongtheme.com\/coinone\/wp-content\/plugins\/elementor\/assets\/",
            "ajaxurl": "https:\/\/demo2.strongtheme.com\/coinone\/wp-admin\/admin-ajax.php"
        },
        "nonces": {"floatingButtonsClickTracking": "da13c9d64f"},
        "swiperClass": "swiper",
        "settings": {"page": [], "editorPreferences": []},
        "kit": {
            "body_background_background": "gradient",
            "active_breakpoints": ["viewport_mobile", "viewport_tablet"],
            "global_image_lightbox": "yes",
            "lightbox_enable_counter": "yes",
            "lightbox_enable_fullscreen": "yes",
            "lightbox_enable_zoom": "yes",
            "lightbox_enable_share": "yes",
            "lightbox_title_src": "title",
            "lightbox_description_src": "description",
            "hello_header_logo_type": "logo",
            "hello_header_menu_layout": "horizontal",
            "hello_footer_logo_type": "logo"
        },
        "post": {"id": 6, "title": "CoinOne%20%E2%80%93%20Cryptocurrency", "excerpt": "", "featuredImage": false}
    };
</script>
<script src='wp-content/plugins/elementor/assets/js/frontend.mind5d5.js?ver=3.23.4' id='elementor-frontend-js'></script>
<script src='wp-content/plugins/elementor-pro/assets/js/preloaded-elements-handlers.min225e.js?ver=3.19.0'
        id='pro-preloaded-elements-handlers-js'></script>

</body>
</html>
