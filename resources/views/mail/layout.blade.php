<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>A responsive two column example</title>
    <style>
        /* A simple css reset */
        body, table, thead, tbody, tr, td, img {
            padding: 0;
            margin: 0;
            border: none;
            border-spacing: 0px;
            border-collapse: collapse;
            vertical-align: top;
        }

        /* Add some padding for small screens */
        .wrapper {
            padding-left: 10px;
            padding-right: 10px;
        }

        h1, h2, h3, h4, h5, h6, p {
            margin: 0;
            padding: 0;
            padding-bottom: 20px;
            line-height: 1.6;
            font-family: 'Helvetica', 'Arial', sans-serif;
        }

        p, a, li {
            font-family: 'Helvetica', 'Arial', sans-serif;
        }

        img {
            width: 100%;
            display: block;
        }

        @media only screen and (max-width: 620px) {

            .wrapper .section {
                width: 100%;
            }

            .wrapper .column {
                width: 100%;
                display: block;
            }
        }
        @yield('css')
    </style>
</head>

<body>
<table width="100%">
    <tbody>
    <tr>
        <td class="wrapper" width="600" align="center">
            <table class="section header" cellpadding="0" cellspacing="0" width="600">
                <tr>
                    <td class="column">
                        <table>
                            <tbody>
                            <tr>
                                <td align="left">
                                    @yield('content')
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>