<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cascading Dropdown Bootstrap Cascader Example</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.7/flatly/bootstrap.min.css">
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link href="{{ url('vendor/cascadingPlugin/dist/css/bootstrap-cascader-1241e02452.min.css') }}" rel="stylesheet"
        type="text/css">
    <style>
        body {
            background-color: #fafafa;
        }

        .container {
            margin: 150px auto;
        }

    </style>
</head>

<body>
    <div id="jquery-script-menu">
        <div class="jquery-script-center">
            <ul>
                <li><a href="https://www.jqueryscript.net/form/Cascading-Dropdown-Bootstrap-Cascader.html">Download This
                        Plugin</a></li>
                <li><a href="https://www.jqueryscript.net/">Back To jQueryScript.Net</a></li>
            </ul>
            <script type="text/javascript">
                <!--
                google_ad_client = "ca-pub-2783044520727903";
                /* jQuery_demo */
                google_ad_slot = "2780937993";
                google_ad_width = 728;
                google_ad_height = 90;
                //
                -->
            </script>
            <script type="text/javascript" src="https://pagead2.googlesyndication.com/pagead/show_ads.js">
            </script>
        </div>
        <div class="jquery-script-clear"></div>
    </div>
    </div>
    <div class="container">
        <h1>Cascading Dropdown Bootstrap Cascader Example</h12>
            <div class="form-group">
                <div class="col-sm-10">
                    <div id="example"></div>
                </div>
            </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"
        integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous">
    </script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="{{ url('vendor/cascadingPlugin/dist/js/bootstrap-cascader-dcbf0e3207.min.js') }}"></script>
    <script>
        $(function() {
            var o = "ABCDEFJHIJKL".split(""),
                n = function() {
                    return function(n, c) {
                        setTimeout(function() {
                            var e = n.length + 1,
                                d = [];
                            if (4 < e) return c(d);
                            var i = "",
                                t = "";
                            0 < n.length && (i = n[n.length - 1].c, t = n[n.length - 1].n), $.each(o,
                                function(n, c) {
                                    var a = {
                                        c: i + n,
                                        n: t + c
                                    };
                                    4 == e && (a.hasChild = !1), d.push(a)
                                }), c(d)
                        }, 500)
                    }
                };
            $("#example").bsCascader({
                splitChar: " / ",
                btnCls: 'btn-primary',
                openOnHover: !0,
                lazy: !0,
                placeHolder: 'Select...',
                loadData: n()
            })
        });
    </script>
    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-36251023-1']);
        _gaq.push(['_setDomainName', 'jqueryscript.net']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') +
                '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);
        })();
    </script>
</body>

</html>
