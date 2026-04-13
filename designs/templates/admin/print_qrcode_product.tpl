<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Print Qrcode</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="js/kjua-0.1.1.min.js"></script>
  </head>
  <body onload="window.print();">
    <div style="width: 900px; margin: 0 auto;">
      <div style="width: 100px; border: 1px solid #eee; padding: 5px; font-size: 10px;">
        <div id="qrcode"></div>
        <center>{$list_product_data.imei}</center>
        <center>{$list_product_data.title}</center>
      </div>


    </div>
    <script>
      var content = '{$list_product_data.imei}';
      var el = kjua({
              render: 'image',
              text: content,
              fill: '#000',
              back: '#ffffff',
              quiet: 2,
              mode:'label',
              label:"PELIN",
              mSize: 10,
              rounded:100,
              size: 100,
              fontcolor: '#000'
      });
      $('#qrcode').html(el);
    </script>
  </body>
</html>
