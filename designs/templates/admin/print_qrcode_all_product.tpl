<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Print Qrcode</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="js/kjua-0.1.1.min.js"></script>
    <style>
      div.page { page-break-before:always;}
      div.first.page { page-break-before:avoid }
    </style>
  </head>
  <body onload="window.print();">
  <!-- <body> -->
    <div style="width: 900px; margin: 0 auto; padding: 20px; height:1255px;">
      {$i = 1}
      {foreach from=$list_product_data item=v key=i}
      {$q = $i+1}
      {$t = $q % 56}

      {if $t eq 0}
      </div>
      <div class="page"></div>
      <div style="width: 900px; margin: 0 auto; padding: 20px; height:1255px; padding-top: 30px;">
      {/if}
        {if $v.status_blank OR $v.status_blank eq 1}
          <div style="width: 220px; border: 0px solid #000; padding: 0px; float: left; font-size: 10px; opacity: 0;">
            <div id="qrcode" style="float: left; margin-left: 6px; margin-top: 4px;">
              <img src="/images/pl_qrcode.png" width="85" height="85"/>
            </div>
            <div style="float: left;">
              <p style="margin-top: 13px;">11111122222</p>
              <p style="margin-top: -7px;">No Print</p>
              <p style="margin-top: -7px;">No Print</p>
              <p style="margin-top: -7px;">No Print</p>
            </div>
          </div>
        {else}
          <div style="width: 220px; border: 0px solid #000; padding: 0px; float: left; font-size: 10px;">
            <div id="qrcode{$v.id}" style="float: left; margin-left: 6px; margin-top: 4px;"></div>
            <div style="float: left;">
              <p style="margin-top: 13px;">{$v.imei}</p>
              <p style="margin-top: -7px;">{$v.title}</p>
              <p style="margin-top: -7px;">{$v.color_name}</p>
              <p style="margin-top: -7px;">{$v.storage_name}</p>
            </div>
          </div>
        {/if}

      {/foreach}
    </div>

    <script>
    {foreach from=$list_product_data item=v}

      {if empty($v.status_blank)}
        var content{$v.id} = '{$v.imei}';
        var el{$v.id} = kjua({
                render: 'image',
                text: content{$v.id},
                fill: '#000',
                back: '#ffffff',
                quiet: 2,
                mode:'label',
                label:"PLP",
                mSize: 10,
                rounded:100,
                size: 85,
                fontcolor: '#000'
        });
        $('#qrcode{$v.id}').html(el{$v.id});
      {/if}

    {/foreach}

    </script>
  </body>
</html>
