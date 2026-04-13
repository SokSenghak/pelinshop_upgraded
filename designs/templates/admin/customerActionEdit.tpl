{extends file="admin/layout.tpl"}
{block name="main"}
    <ul class="breadcrumb">
        <li><a href="{$admin_file}">ទំព័រដើម (Home)</a></li>
        <li class="active">ព័ត៌មានអតិថិជន (Customer Information)</li>
    </ul>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="glyphicon glyphicon-user"></i>&nbsp;កែប្រែព័ត៌មានអតិថិជន (Edit Customer Information)</h3>
        </div>
        <div class="panel-body">
            <form role="form" action="{$admin_file}?task=customer&amp;action=edit&amp;id={$smarty.get.id}" method="post">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>ឈ្មោះអតិថិជន (Customer Name):</label><span style="color:red">*{if $error.name eq 1}Please
							Enter Customer Name!!!{/if}</span>
							<input type="text" name="name" id="name" class="form-control" placeholder="Enter Customer Name" value="{if $edit.name}{$edit.name}{/if}" />
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>លេខអត្តសញ្ញាណប័ណ្ណ (Personal ID):</label>
							<input type="text" name="idnumber" id="idnumber" class="form-control" placeholder="Enter Customer ID" value="{if $edit.idnumber}{$edit.idnumber}{/if}" />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>លេខទូរស័ព្ទ (Phone Number):</label>
							<span style="color:red">*
							{if $error.phone eq 1}
								Please Enter Phone Number!!!
							{/if}
							{if $error.phone eq 2}
								This Phone Number already existed. Please Enter New Phone Number!!!
							{/if}</span>
							<input type="text" name="phone" id="phone" class="form-control"
								placeholder="Enter Customer Phone" value="{if $edit.phone}{$edit.phone}{/if}" />
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>អុីមែល (Email Address):</label>
							<input type="text" name="email" id="email" class="form-control"
								placeholder="Enter Customer Email" value="{if $edit.email}{$edit.email}{/if}" />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>អាសយដ្ឋាន (Address):</label>
							<textarea type="text" name="address" id="address" class="form-control" placeholder="Enter Customer Address">{if $edit.address}{$edit.address}{/if}</textarea>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<input name="_id" type="hidden" value="{$edit.id}" />
						<button class="btn btn-success btn-md" type="submit"><i class="glyphicon glyphicon-save"></i> រក្សាទុក (Save)</button>
					</div>
				</div>
            </form>
        </div>
    </div>
    {include file="common/paginate.tpl"}
{/block}