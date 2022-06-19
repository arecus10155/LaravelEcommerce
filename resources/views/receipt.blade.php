<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html" />

    <!-- TODO customize transformation rules 
         syntax recommendation http://www.w3.org/TR/xslt 
    -->
    <xsl:template match="/receipt">
        <html>

        <head>
            <title>receipt.xsl</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
        </head>

        <body>
            <style>
                body {

                    background: #eee;
                }

                .invoice {
                    background: #fff;
                    padding: 20px
                }

                .invoice-company {
                    font-size: 20px
                }

                .invoice-header {
                    margin: 0 -20px;
                    background: #f0f3f4;
                    padding: 20px
                }

                .invoice-date,
                .invoice-from,
                .invoice-to {
                    display: table-cell;
                    width: 1%
                }

                .invoice-from,
                .invoice-to {
                    padding-right: 20px
                }

                .invoice-date .date,
                .invoice-from strong,
                .invoice-to strong {
                    font-size: 16px;
                    font-weight: 600
                }

                .invoice-date {
                    text-align: right;
                    padding-left: 20px
                }

                .invoice-price {
                    background: #f0f3f4;
                    display: table;
                    width: 100%
                }

                .invoice-price .invoice-price-left,
                .invoice-price .invoice-price-right {
                    display: table-cell;
                    padding: 20px;
                    font-size: 20px;
                    font-weight: 600;
                    width: 75%;
                    position: relative;
                    vertical-align: middle
                }

                .invoice-price .invoice-price-left .sub-price {
                    display: table-cell;
                    vertical-align: middle;
                    padding: 0 20px
                }

                .invoice-price small {
                    font-size: 12px;
                    font-weight: 400;
                    display: block
                }

                .invoice-price .invoice-price-row {
                    display: table;
                    float: left
                }

                .invoice-price .invoice-price-right {
                    width: 25%;
                    background: #2d353c;
                    color: #fff;
                    font-size: 28px;
                    text-align: right;
                    vertical-align: bottom;
                    font-weight: 300
                }

                .invoice-price .invoice-price-right small {
                    display: block;
                    opacity: .6;
                    position: absolute;
                    top: 10px;
                    left: 10px;
                    font-size: 12px
                }

                .invoice-footer {
                    border-top: 1px solid #ddd;
                    padding-top: 10px;
                    font-size: 10px
                }

                .invoice-note {
                    color: #999;
                    margin-top: 80px;
                    font-size: 85%
                }

                .invoice>div:not(.invoice-footer) {
                    margin-bottom: 20px
                }

                .btn.btn-white,
                .btn.btn-white.disabled,
                .btn.btn-white.disabled:focus,
                .btn.btn-white.disabled:hover,
                .btn.btn-white[disabled],
                .btn.btn-white[disabled]:focus,
                .btn.btn-white[disabled]:hover {
                    color: #2d353c;
                    background: #fff;
                    border-color: #d9dfe3;
                }
            </style>
<br/><br/>
<div class="container">

<a href="javascript:;" onclick="window.print()" class="btn btn-warning" style="margin-left: 15px;"><i class="fa fa-print t-plus-1 fa-fw fa-lg"></i> Print PDF</a>
</div>
 
            <br/><br/>
         
            <div class="container">
                <div class="col-md-12">
                    
                    <div class="invoice">

                        <div>
                            Lmuted, Inc
                        </div>

                        <div class="invoice-header">
                            <div class="invoice-from">
                                <small>from</small>
                                <address class="m-t-5 m-b-5">
                                    <strong class="text-inverse">L-muted, Inc.</strong><br />
                                    No.100 Jalan Pcl18,
                                    Lorong 1,
                                    Johor Bahru, 81300<br />
                                    Phone: (011) 123-3290<br />
                                    Fax: (012) 624-5190
                                </address>
                            </div>

                            <div class="invoice-to">
                                <small>to</small>
                                <address class="m-t-5 m-b-5">
                                    <strong class="text-inverse">
                                        <xsl:value-of select="username" /><br />
                                    </strong>
                                    <xsl:value-of select="address" />
                                </address>
                            </div>

                            <div class="invoice-date">
                                <small>Receipt</small>
                                <div class="date text-inverse m-t-5">
                                    <xsl:value-of select="dateTime" />
                                </div>
                                <div class="invoice-detail">Order ID:
                                    <xsl:value-of select="orderID" /><br />
                                    Status: <span class="badge rounded-pill bg-warning text-dark">
                                        <xsl:value-of select="status" />
                                    </span>
                                    <br />
                                    Services Product
                                </div>
                            </div>
                        </div>


                        <div class="invoice-content">

                            <div class="table-responsive">
                                <table class="table table-invoice">
                                    <thead>
                                        <tr>
                                            <th>Products</th>

                                            <th class="text-center" width="10%">Qty</th>
                                            <th class="text-center" width="10%">Price</th>
                                            <th class="text-right" width="20%">LINE TOTAL</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <xsl:for-each select="productList">
                                            <tr>

                                                <td>

                                                    <small>
                                                        <xsl:value-of select="name" />
                                                    </small>
                                                </td>
                                                <td class="text-center">
                                                    <xsl:value-of select="quantity" />
                                                </td>
                                                <td class="text-center">
                                                    <xsl:value-of select="price" />
                                                </td>
                                                <td class="text-right">
                                                    <xsl:value-of select="linePrice" />
                                                </td>
                                            </tr>

                                        </xsl:for-each>
                                    </tbody>

                                </table>
                            </div>

                            <div class="invoice-price">
                            <div class="invoice-price-left">
                                <div class="invoice-price-row">
                                    <div class="sub-price">
                                        <small>SUBTOTAL</small>
                                        <span class="text-inverse">RM
                                            <xsl:value-of select="totalPrice" />
                                        </span>
                                    </div>

                                </div>
                            </div>
                            <div class="invoice-price-right">
                                <small>TOTAL</small> <span class="f-w-600">RM
                                    <xsl:value-of select="totalPrice" />
                                </span>
                            </div>
                        </div>

                        </div>

                       


                        <div class="invoice-note">
                            * Make all cheques payable to L-MUTED<br />
                            * 100% Guaranteed goods will be shipping out between 5 working days.<br />
                            * If you have any questions concerning this invoice, contact WengHong, 011-12341411, Lmuted@gmail.com<br />
                        </div>

                        <div class="invoice-footer">
                            <p class="text-center m-b-5 f-w-600">
                                THANK YOU FOR YOUR SUPPORT
                            </p>
                            <p class="text-center">
                                <span class="m-r-10"><i class="fa fa-fw fa-lg fa-globe"></i> Lmuted.com</span>
                                <span class="m-r-10"><i class="fa fa-fw fa-lg fa-phone-volume"></i> T:011-12341411</span>
                                <span class="m-r-10"><i class="fa fa-fw fa-lg fa-envelope"></i> Lmuted@gmail.com</span>
                            </p>
                        </div>

                    </div>
                </div>

            </div>

            <!-- <div class="container" style="margin-top: 50px;">
                <h3>Lmuted, Inc</h3>

                <small>from</small>
                  <xsl:value-of select="username" />
            </div>
                
            <xsl:value-of select="username" />
            <xsl:value-of select="address" />
            <xsl:value-of select="dateTime" />
            <xsl:value-of select="orderID" />
            <xsl:value-of select="status" />

            <xsl:for-each select="productList">
                <xsl:value-of select="image" />


                <xsl:value-of select="name" />
                <xsl:value-of select="quantity" />
                <xsl:value-of select="price" />
                <xsl:value-of select="linePrice" />

            </xsl:for-each> -->
        </body>

        </html>
    </xsl:template>

</xsl:stylesheet>