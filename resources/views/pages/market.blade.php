@extends('pages.layout.app')
@section('content')

    <div data-elementor-type="wp-page" data-elementor-id="1251" class="elementor elementor-1251"
         data-elementor-post-type="page">

        <br>
        <section
            class="elementor-section elementor-top-section elementor-element elementor-element-cdd7164 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
            data-id="cdd7164" data-element_type="section">
             <h4 style="text-align: center">Cryptocurrency Market</h4>
            <div class="elementor-container elementor-column-gap-default">

               <!-- TradingView Widget BEGIN -->
            <div class="tradingview-widget-container">
              <div class="tradingview-widget-container__widget"></div>
              <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/" rel="noopener nofollow" target="_blank"></a></div>
              <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-screener.js" async>
              {
              "width": "100%",
              "height": 550,
              "defaultColumn": "overview",
              "screener_type": "crypto_mkt",
              "displayCurrency": "USD",
              "colorTheme": "light",
              "locale": "en"
            }
              </script>
            </div>
            <!-- TradingView Widget END -->
            </div>
        </section>
        <section
            class="elementor-section elementor-top-section elementor-element elementor-element-3a7ef85 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
            data-id="3a7ef85" data-element_type="section">
            <div class="elementor-container elementor-column-gap-default">
                <div
                    class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-30af76e"
                    data-id="30af76e" data-element_type="column">
                    <div class="elementor-widget-wrap">
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
