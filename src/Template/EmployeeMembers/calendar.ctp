<!DOCTYPE html>
<html>
    <head>
        <title>Zabuto | Calendar | Show Data</title>
        <meta name="robots" content="noindex, nofollow">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <!-- jQuery CDN -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

        <!-- Bootstrap CDN -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="//oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <!-- Example style -->
        <link rel="stylesheet" type="text/css" href="//zabuto.com/assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $this->request->webroot; ?>calendar/examples/style.css">

        <!-- Zabuto Calendar -->
        <script src="<?php echo $this->request->webroot; ?>calendar/zabuto_calendar.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo $this->request->webroot; ?>calendar/zabuto_calendar.min.css">

    </head>
    <body>

        <!-- container -->
        <div class="container example">
            <div class="row">
                <div class="col-xs-5">
                    <div id="my-calendar"></div>



                </div>
                <div class="col-xs-6 col-xs-offset-1">

                    <code>
                        &lt;!-- show date events with a modal window --&gt;
                        &lt;script type=&quot;application/javascript&quot;&gt;
                        $(document).ready(function () {
                        $(&quot;#my-calendar&quot;).zabuto_calendar({
                        <span>ajax: {
                            url: &quot;show_data.php&quot;,
                            modal: true
                            }</span>
                        });
                        });
                        &lt;/script&gt;

                        &lt;!-- use fixed data --&gt;
                        &lt;script type=&quot;application/javascript&quot;&gt;
                        var eventData = [
                        {"date":"2015-01-01","badge":false,"title":"Example 1"},
                        {"date":"2015-01-02","badge":true,"title":"Example 2"}
                        ];
                        $(document).ready(function () {
                        $(&quot;#my-calendar&quot;).zabuto_calendar({
                        <span>data: eventData</span>
                        });
                        });
                        &lt;/script&gt;
                    </code>

                </div>
            </div>
        </div>
        <!-- /container -->
        <script type="application/javascript">
            $(document).ready(function () {
            $("#my-calendar").zabuto_calendar({
            ajax: {
            url: "<?php echo $this->request->webroot . 'calendar/examples/show_data.php' ?>",
            modal: true
            }
            });
            });
        </script>
    </body>
</html>
