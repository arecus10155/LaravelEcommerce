<xsl:stylesheet version="1.0" 
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/products">

 <html>
   <head>
   <meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
</head>
 <body>

 <section>
   <div style="margin-top: 80px;">

 
  <h1 align="center">All Products</h1>
  <a href="javascript:;" style="margin-left:1400px;" onclick="window.print()" class="btn btn-warning"><i class="fa fa-print t-plus-1 fa-fw fa-lg"></i> Print PDF</a>
  
   <table border="3"   align="center" style="margin-top: 20px;">
   <tr>
    <th>id</th>
    <th>title</th>
    <th>price</th>
    <th>image</th>
    <th>category</th>
    <th>product_code</th>
    <th>color</th>
    <th>quantity</th>
    <th>short_description</th>
    <th>long_description</th>
   </tr>
    <xsl:for-each select="productList">
   <tr>
   <td><xsl:value-of select="id"/></td>
    <td><xsl:value-of select="title"/></td>
    <td><xsl:value-of select="price"/></td>
    <td><xsl:value-of select="image"/></td>
    
    <td><xsl:value-of select="category"/></td>
    <td><xsl:value-of select="product_code"/></td>
    <td><xsl:value-of select="color"/></td>
    <td><xsl:value-of select="quantity"/></td>
    <td><xsl:value-of select="short_description"/></td>
    <td><xsl:value-of select="long_description"/></td>
   </tr>
    </xsl:for-each>
    </table>
  
    </div>
</section>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
</xsl:template>
</xsl:stylesheet>