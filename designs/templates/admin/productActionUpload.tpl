{extends file="admin/layout.tpl"}
{block name="main"}
<ul class="breadcrumb">
  <li><a href="{$admin_file}">ទំព័រដើម (Home)</a></li>
  <li><a href="{$admin_file}?task=product">ផលិតផល (Product)</a> </li>
  <li class="active">ដាក់រូបថត (Upload)</li>
</ul>
{if $error}
  <div class="alert alert-danger" data-dismiss="alert">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {if $error.no_image eq 1}សូមរកមើលរូបថតដើម្បីដាក់ចូល។ (Please browse file to upload.)<br />{/if}
    {if $error.size eq 1}រូបថតដែលបានដាក់លើសពីទំហំអតិបរមា។ (File photo uploaded exceeds maximum upload size.)<br />{/if}
    {if $error.type eq 1}រូបថតដែលដាក់ចូលមិនត្រឹមត្រូវ។ (Unsupported file type of photo uploaded.) <br />{/if}
    {if $error.error eq 1}បញ្ហាបានកើតឡើងនៅពេលដាក់រូបថត។ (An error ocurred when uploading photo.) <br />{/if}
  </div>
{/if}
  <div class="panel panel-primary">
    <div class="panel-heading"><h3 class="panel-title">ដាក់រូបថតសម្រាប់ផលិតផល (Upload photo for product)</h3></div>
    <div class="panel-body">
      <h4 class="text-muted">សូមដាក់រូបភាពផលិតផល (Please upload your product image)</h4>
      <span style="color:red">ទំហំរូបភាព (image size): 8 Mb. ប្រភេទរូបភាព (image type): .jpg, .png, .jpeg, .gif.</span>
      <hr style="margin-bottom:10px;margin-top:10px;">
      <form action="{$admin_file}?task=product&action=upload&id={$product_id}" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <p>សូមជ្រើសរើសរូបថតដើម្បីដាក់សម្រាប់ផលិតផល។ (Please select photo to upload in product.)</p>
          <input type="file" name="photo">
          <br />
          <button class="btn btn-success" type="submit" name="submit" required ><i class="glyphicon glyphicon-picture"></i> ដាក់រូបថត (Upload)</button>
        </div>
      </form>
    </div>
  </div>


{/block}
