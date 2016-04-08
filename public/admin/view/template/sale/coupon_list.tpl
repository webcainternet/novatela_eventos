<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
       <div class="pull-right">
        <a href="<?php echo $coupon_list; ?>" data-toggle="tooltip" title="Check Current Coupon List" class="btn btn-primary">Back To Coupon List Page</a>
      </div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>">
      <div class="panel-group" id="accordion">
        <div class="panel panel-default">
          <div class="panel-heading">
             <div class="container-fluid">
               <div class="pull-right">
                <button type="button" class="btn btn-primary btn-lg save" >Save</button>
             </div>
              <h4 class="panel-title"><?php echo $step1; ?></h4>
            </div>
          </div>
          <div class="panel-collapse collapse" id="collapse-checkout-option">
            <div class="panel-body">

          <form class="form-horizontal">
          <div class="form-group">
           <label class="col-sm-2 control-label" for="input-name1"><span data-toggle="tooltip" title="<?php echo $help_code; ?>">Nome do cupom</span></label>
          <div class="col-sm-10">
           <input type="text" placeholder="Enter Name" name="name1" value="" maxlength="20" class="form-control"/>
          </div>
        </div>

          <div class="form-group">
           <label class="col-sm-2 control-label" for="input-code"><span data-toggle="tooltip" title="<?php echo $help_code; ?>"><?php echo $entry_code; ?></span></label>
          <div class="col-sm-10">
           <input type="text" placeholder="Enter Code" name="prefix" value="<?php echo $imdevcoupon_coupon_prefix; ?>" maxlength="4" class="form-control"/>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="input-code"><span data-toggle="tooltip" title="<?php echo $help_number; ?>">Number of Coupons</span></label>
          <div class="col-sm-10">
            <input type="text"  placeholder="Number" name="number" value="<?php echo $imdevcoupon_coupon_number; ?>" class="form-control" >
          </div>
        </div>
        <div class="form-group">
           <label class="col-sm-2 control-label" for="input-type"><span data-toggle="tooltip" title="<?php echo $help_type; ?>"><?php echo $entry_type; ?></span></label>
            <div class="col-sm-10">
            <select name="ctype" class="form-control">
                  <?php if ($imdevcoupon_coupon_type == 'P') { ?>
                  <option value="P" selected="selected"><?php echo $text_percent; ?></option>
                  <?php } else { ?>
                  <option value="P"><?php echo $text_percent; ?></option>
                  <?php } ?>
                  <?php if ($imdevcoupon_coupon_type == 'F') { ?>
                  <option value="F" selected="selected"><?php echo $text_amount; ?></option>
                  <?php } else { ?>
                  <option value="F"><?php echo $text_amount; ?></option>
                  <?php } ?>
                </select>
          </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="input-discount"><?php echo $entry_discount; ?></label>
            <div class="col-sm-10">
            <input type="text"  placeholder="Enter discount amount" name="discount" value="<?php echo $imdevcoupon_coupon_discount; ?>" class="form-control"/>
          </div>
        </div>
        <div class="form-group">
           <label class="col-sm-2 control-label" for="input-type"><span data-toggle="tooltip" title="<?php echo $help_total; ?>">Total Amount</span></label>
            <div class="col-sm-10">
             <input type="text"  placeholder="Enter total amount" name="total" value="<?php echo $imdevcoupon_coupon_total; ?>"  class="form-control"/>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_free_shipping; ?>">Free Shipping </span></label>
          <div class="col-sm-10">
            <label class="radio-inline">
              <?php if ($imdevcoupon_free_shipping) { ?>
              <input type="radio" name="imdevcoupon_free_shipping" value="1" checked="checked" />
              <?php echo $text_yes; ?>
              <?php } else { ?>
              <input type="radio" name="imdevcoupon_free_shipping" value="1" />
              <?php echo $text_yes; ?>
              <?php } ?>
            </label>
            <label class="radio-inline">
              <?php if (!$imdevcoupon_free_shipping) { ?>
              <input type="radio" name="imdevcoupon_free_shipping" value="0" checked="checked" />
              <?php echo $text_no; ?>
              <?php } else { ?>
              <input type="radio" name="imdevcoupon_free_shipping" value="0" />
              <?php echo $text_no; ?>
              <?php } ?>
            </label>
          </div>
        </div>

        <!--  <div class="form-group">
          <label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_shipping_applied; ?>">Shipping Applied</span>
             <i  data-toggle="tooltip" title="New Feature"  class="fa fa-star"></i>
          </label>

          <div class="col-sm-10">
            <label class="radio-inline">
              <?php if ($imdevcoupon_shipping_amount) { ?>
              <input type="radio" name="imdevcoupon_shipping_amount" value="1" checked="checked" />
              <?php echo $text_yes; ?>
              <?php } else { ?>
              <input type="radio" name="imdevcoupon_shipping_amount" value="1" />
              <?php echo $text_yes; ?>
              <?php } ?>
            </label>
            <label class="radio-inline">
              <?php if (!$imdevcoupon_shipping_amount) { ?>
              <input type="radio" name="imdevcoupon_shipping_amount" value="0" checked="checked" />
              <?php echo $text_no; ?>
              <?php } else { ?>
              <input type="radio" name="imdevcoupon_shipping_amount" value="0" />
              <?php echo $text_no; ?>
              <?php } ?>

            </label>
          </div>
        </div> -->

         <div class="form-group">
         <label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_logged; ?>"><?php echo $entry_logged; ?></span></label>

          <div class="col-sm-10">
            <label class="radio-inline">
              <?php if ($imdevcoupon_coupon_logged) { ?>
              <input type="radio" name="imdevcoupon_coupon_logged" value="1" checked="checked" />
              <?php echo $text_yes; ?>
              <?php } else { ?>
              <input type="radio" name="imdevcoupon_coupon_logged" value="1" />
              <?php echo $text_yes; ?>
              <?php } ?>
            </label>
            <label class="radio-inline">
              <?php if (!$imdevcoupon_coupon_logged) { ?>
              <input type="radio" name="imdevcoupon_coupon_logged" value="0" checked="checked" />
              <?php echo $text_no; ?>
              <?php } else { ?>
              <input type="radio" name="imdevcoupon_coupon_logged" value="0" />
              <?php echo $text_no; ?>
              <?php } ?>
            </label>
          </div>
        </div>
        <div class="form-group customergroup">
          <label class="col-sm-2 control-label"><?php echo $entry_customergroup; ?></label>
          <div class="col-sm-10">
            <div class="well well-sm" style="height: 150px; overflow: auto;">
              <?php foreach ($customergroups as $customergroup) { ?>
              <div class="checkbox">
                <label>
                  <?php if (in_array($customergroup['customer_group_id'], $imdevcoupon_customergroup)) { ?>
                  <input type="checkbox" name="imdevcoupon_customergroup" value="<?php echo $customergroup['customer_group_id']; ?>" checked="checked" />
                  <?php echo $customergroup['name']; ?>
                  <?php } else { ?>
                  <input type="checkbox" name="imdevcoupon_customergroup" value="<?php echo $customergroup['customer_group_id']; ?>" />
                  <?php echo $customergroup['name']; ?>
                  <?php } ?>
                </label>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
        <div class="form-group">
                <label class="col-sm-2 control-label" for="input-product"><span data-toggle="tooltip" title="<?php echo $help_product; ?>"><?php echo $entry_product; ?></span></label>
                <div class="col-sm-10">
                  <input type="text" name="product" value="" placeholder="<?php echo $entry_product; ?>" id="input-product" class="form-control" />
                  <div id="coupon-product" class="well well-sm" style="height: 150px; overflow: auto;">
                    <?php foreach ($coupon_product as $coupon_product) { ?>
                    <div  class="<?php echo $coupon_product['product_id']; ?>" id="coupon-product<?php echo $coupon_product['product_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $coupon_product['name']; ?>
                      <input type="hidden" name="coupon_product[]" value="<?php echo $coupon_product['product_id']; ?>" />
                    </div>
                    <?php } ?>
                  </div>
                </div>
          </div>
          <div class="form-group">
                <label class="col-sm-2 control-label" for="input-category"><span data-toggle="tooltip" title="<?php echo $help_category; ?>"><?php echo $entry_category; ?></span></label>
                <div class="col-sm-10">
                  <input type="text" name="category" value="" placeholder="<?php echo $entry_category; ?>" id="input-category" class="form-control" />
                  <div id="coupon-category" class="well well-sm" style="height: 150px; overflow: auto;">
                    <?php foreach ($coupon_category as $coupon_category) { ?>
                    <div class="<?php echo $coupon_category['category_id']; ?>" id="coupon-category<?php echo $coupon_category['category_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $coupon_category['name']; ?>
                      <input type="hidden" name="coupon_category[]" value="<?php echo $coupon_category['category_id']; ?>" />
                    </div>
                    <?php } ?>
                  </div>
                </div>
          </div>
          <div class="form-group">
                <label class="col-sm-2 control-label" for="input-date-start"><?php echo $entry_date_start; ?></label>
                <div class="col-sm-3">
                  <div class="input-group date">
                    <input type="text" name="sdate" value="<?php echo $imdevcoupon_coupon_sdate; ?>" placeholder="<?php echo $entry_date_start; ?>"data-date-format="YYYY-MM-DD"  id="input-date-start" class="form-control" />
                    <span class="input-group-btn">
                    <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                    </span></div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-date-end"><?php echo $entry_date_end; ?></label>
                <div class="col-sm-3">
                  <div class="input-group date">
                    <input type="text" name="edate" value="<?php echo $imdevcoupon_coupon_edate; ?>" placeholder="<?php echo $entry_date_end; ?>" data-date-format="YYYY-MM-DD"  id="input-date-end" class="form-control" />
                    <span class="input-group-btn">
                    <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                    </span></div>
                </div>
              </div>
             <div class="form-group">
                <label class="col-sm-2 control-label" for="input-uses-total"><span data-toggle="tooltip" title="<?php echo $help_uses_total; ?>"><?php echo $entry_uses_total; ?></span></label>
                <div class="col-sm-10">
                 <input type="text" colspan="12" placeholder="Enter number" name="usetotal" value="<?php echo $imdevcoupon_coupon_usetotal; ?>" class="form-control" />
              </div>
            </div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="input-uses-customer"><span data-toggle="tooltip" title="<?php echo $help_uses_customer; ?>"><?php echo $entry_uses_customer; ?></span></label>
            <div class="col-sm-10">
             <input type="text" placeholder="Enter number" name="cuse" value="<?php echo $imdevcoupon_coupon_cuse; ?>"  class="form-control"/>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label" for="input-uses-customer"><span data-toggle="tooltip" title="The above setting will be used for coupon generation">Save</span></label>
            <div class="col-sm-10">
            <button type="button" class="btn btn-primary btn-lg save" >Save</button>
          </div>
        </div>
        
</form>

            </div>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title"><?php echo $step2; ?></h4>
          </div>
          <div class="panel-collapse collapse" id="collapse-import-coupon">
            <div class="panel-body">
                     <a onclick="location = '<?php echo $upload_action; ?>'" data-toggle="tooltip" title="Import My Coupons" class="btn btn-primary">Import</a>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
</div>
<script type="text/javascript">
$('.deleteall').click(function(){
  if(confirm('Are you sure You want to delete all coupons?')){
    return true;
  } else {
    return false;
  }
});
</script>
<script type="text/javascript">
$('.save').on('click',function(){
  $('.errorn,.errorp').removeClass('warning').html('');
  var name1 = $('input[name = "name1"]').val();
  var prefix = $('input[name = "prefix"]').val();
  var number = $('input[name = "number"]').val();
  var ctype = $('select[name = "ctype"]').val();
  var discount = $('input[name = "discount"]').val();
  var shipamount = $('input[name = "imdevcoupon_shipping_amount"]:checked').val();
  var freeshipping = $('input[name = "imdevcoupon_free_shipping"]:checked').val();
  var logged = $('input[name = "imdevcoupon_coupon_logged"]:checked').val();
  var total = $('input[name = "total"]').val();
  var sdate = $('input[name = "sdate"]').val();
  var edate = $('input[name = "edate"]').val();
  var ccat = [];
  var temp = $('#coupon-category').children().length;
  for (var i = 1; i <= temp; i++) {
    ccat[i-1] = $('#coupon-category div:nth-child('+i+')').attr("class");
  };
  var pid = [];
  var temp = $('#coupon-product').children().length;
  for (var i = 1; i <= temp; i++) {
    pid[i-1] = $('#coupon-product div:nth-child('+i+')').attr("class");
  };

var customergroup = $('input[name = "imdevcoupon_customergroup"]:checked').map(function() {
    return this.value;
}).get();
   
  var usetotal = $('input[name = "usetotal"]').val();
  var cuse = $('input[name = "cuse"]').val();

 
  $.ajax({
    type: 'post',
    data: 'name1=' + name1 + '&prefix=' + prefix + '&number=' + number + '&ctype=' + ctype + '&discount=' + discount + '&shipamount=' + shipamount + '&freeshipping=' + freeshipping + '&logged=' + logged + '&customergroup=' + customergroup + '&total=' + total + '&sdate=' + sdate + '&edate=' + edate + '&usetotal=' + usetotal + '&cuse=' + cuse + '&ccat=' + ccat  + '&pid=' + pid,
  url: 'index.php?route=sale/coupon/setting&token=<?php echo $token; ?>',
  dataType: 'json',
  success: function(data) {
         $('#collapse-import-coupon').parent().find('.panel-heading .panel-title').html('<a href="#collapse-import-coupon" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle">Step 2: Click To Import Above Coupons </a>');
      
      $('a[href=\'#collapse-import-coupon\']').trigger('click');
  }
  });
  
});

</script>
<script type="text/javascript">
$(document).ready(function() {
      $('#collapse-checkout-option').parent().find('.panel-heading .panel-title').html('<a href="#collapse-checkout-option" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle">Step 1: Fill form below to import coupons</a>');
      
      $('a[href=\'#collapse-checkout-option\']').trigger('click');
       
}); 
</script>
  <script type="text/javascript"><!--
$('input[name=\'product\']').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
      dataType: 'json',     
      success: function(json) {
        response($.map(json, function(item) {
          return {
            label: item['name'],
            value: item['product_id']
          }
        }));
      }
    });
  },
  'select': function(item) {
    $('input[name=\'product\']').val('');
    console.log(item);
    $('#coupon-product' + item['value']).remove();
    
    $('#coupon-product').append('<div  class="'+item['value']+'" id="coupon-product' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="coupon_product[]" value="' + item['value'] + '" /></div>'); 
  }
});

$('#coupon-product').delegate('.fa-minus-circle', 'click', function() {
  $(this).parent().remove();
});

// Category
$('input[name=\'category\']').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: 'index.php?route=catalog/category/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
      dataType: 'json',
      success: function(json) {
        response($.map(json, function(item) {
          return {
            label: item['name'],
            value: item['category_id']
          }
        }));
      }
    });
  },
  'select': function(item) {
    $('input[name=\'category\']').val('');
    
    $('#coupon-category' + item['value']).remove();
    
    $('#coupon-category').append('<div class="'+item['value']+'" id="coupon-category' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="coupon_category[]" value="' + item['value'] + '" /></div>');
  } 
});

$('#coupon-category').delegate('.fa-minus-circle', 'click', function() {
  $(this).parent().remove();
});
//--></script>
  <script type="text/javascript"><!--
$('.date').datetimepicker({
  pickTime: false
});
//--></script>
<?php echo $footer; ?>