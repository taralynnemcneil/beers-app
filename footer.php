</main>

<footer class="alert alert-info">
    <div class="col-sm-8">
        &copy; 2016 | COMP1006 Intro to Web Programming | Tara McNeil
    </div>
    
    <!-- weather widget start -->
    <div id="m-booked-small-t3-60630"> 
        <div class="booked-weather-160x36 w160x36-01" style="background-color:#f7fcff; color:#333333; border-radius:4px; -moz-border-radius:4px;"> 
                <a style="color:#08488D;" href="//www.booked.net/weather/barrie-26910" class="booked-weather-160x36-city">Barrie</a> 
                <div class="booked-weather-160x36-degree">
                    <span class="plus">+</span>13&deg;
                    <span>C</span>
                </div> 
        </div> 
    </div>
    
    <script type="text/javascript"> 
        var css_file=document.createElement("link"); 
        css_file.setAttribute("rel","stylesheet"); 
        css_file.setAttribute("type","text/css"); 
        css_file.setAttribute("href",'//s.bookcdn.com/css/w/bw-160-36.css?v=0.0.1'); 
        document.getElementsByTagName("head")[0].appendChild(css_file); 
        
        function setWidgetData(data) { 
            if(typeof(data) != 'undefined' && data.results.length > 0) { 
                for(var i = 0; i < data.results.length; ++i) { 
                    var objMainBlock = document.getElementById('m-booked-small-t3-60630'); 
                    if(objMainBlock !== null) { 
                            var copyBlock = document.getElementById('m-bookew-weather-copy-'+data.results[i].widget_type); 
                            objMainBlock.innerHTML = data.results[i].html_code; if(copyBlock !== null) objMainBlock.appendChild(copyBlock); 
                    } 
                }
            } else { 
                 alert('data=undefined||data.results is empty'); 
            } 
        } 
    </script> 
    <script type="text/javascript" charset="UTF-8" src="http://widgets.booked.net/weather/info?action=get_weather_info&ver=4&cityID=26910&type=13&scode=2&ltid=3457&domid=w209&cmetric=1&wlangID=1&color=f7fcff&wwidth=158&header_color=fff5d9&text_color=333333&link_color=08488D&border_form=0&footer_color=fff5d9&footer_text_color=333333&transparent=0"></script>
    <!-- weather widget end -->
    
</footer>
<div id="fb-root"></div>
    <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6&appId=474030372793085";
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

<!-- Latest compiled and minified JavaScript -->
<script src="Scripts/lib/jquery-2.2.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<!-- Sortable Table -->
<script src="Scripts/sorttable.js"></script>

</body>
</html>