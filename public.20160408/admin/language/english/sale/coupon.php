<?php
// Heading  
$_['heading_title']       = 'Easy Import Coupon';

// Text
$_['text_success']        = 'Success: You have modified coupons!';
$_['text_success_upload']        = 'Success: You have uploaded coupons!';
$_['text_success_delete']        = 'Success: You have deleted all coupons!';
$_['text_percent']        = 'Percentage';
$_['text_amount']         = 'Fixed Amount';

$_['step1']               = 'Step1: Set your settings';
$_['step2']               = 'Step2: Export Csv Template';
$_['step3']               = 'Step3: Import Csv Template';


$_['help_code']           = 'This field is optional. If you want to prefix first 4 characters of coupon you can enter here.';
$_['help_type']           = 'Percentage or Fixed Amount.';
$_['help_number']         = 'Enter the number of coupon you want to generate';
$_['help_logged']         = 'Customer must be logged in to use the coupon.';
$_['help_free_shipping']  = 'Only apply this coupon if shipping is available for product';
$_['help_shipping_applied']  = 'When discount is applied by coupon, also consider shipping amount in total amount';
$_['help_logged']         = 'Customer must be logged in to use the coupon.';
$_['help_total']          = 'The total amount that must be reached before the coupon is valid.';
$_['help_category']       = 'Choose all products under selected category.';
$_['help_product']        = 'Choose specific products the coupon will apply to. Select no products to apply coupon to entire cart.';
$_['help_uses_total']     = 'The maximum number of times the coupon can be used by any customer. Leave blank for unlimited';
$_['help_uses_customer']  = 'The maximum number of times the coupon can be used by a single customer. Leave blank for unlimited';

//Button
$_['get_csvtemplate']     = 'Export Coupons';
$_['get_products_csvtemplate']     = 'Product Template';
$_['get_cat_csvtemplate']     = 'Category Template';
$_['button_csvimport']    = 'Import Coupons';
$_['button_upload']       = 'Upload';
$_['button_delete_all']         = 'Delete All';
$_['button_help']         = 'How to use?';
$_['button_help_frame']         = 'Steps for bulk uploading coupons';

// Entry
$_['entry_name']          = 'Coupon Name:';
$_['entry_description']   = 'Coupon Description:';
$_['entry_code']          = 'Coupon Prefix Code';
$_['entry_type']          = 'Coupon Type';
$_['entry_discount']      = 'Discount:';
$_['entry_logged']        = 'Customer Login';
$_['entry_shipping']      = 'Free Shipping';
$_['entry_total']         = 'Total Amount';
$_['entry_category']      = 'Category';
$_['entry_product']       = 'Product';
$_['entry_date_start']    = 'Date Start:';
$_['entry_date_end']      = 'Date End:';
$_['entry_uses_total']    = 'Uses Per Coupon';
$_['entry_uses_customer'] = 'Uses Per Customer';
$_['entry_status']        = 'Status:';
$_['entry_cart']          = 'Also consider shipping amount: <div class="help">Enable this to include shipping price in calculating coupon discount</div>';

// Error
$_['error_exists']        = 'Warning: Coupon code is already in use!';
$_['error_permission']    = 'Warning: You do not have permission to modify coupons!';
$_['error_name']          = 'Coupon Name must be between 3 and 64 characters!';
$_['error_description']   = 'Coupon Description must be greater than 3 characters!';
$_['error_code']          = 'Code must be between 3 and 64 characters!';
$_['error_code_duplicate'] = 'Code must be unique!';

$_['error_filename']   = 'Filename must be between 3 and 128 characters!';
$_['error_filetype']   = 'Invalid file type!';
$_['error_upload']     = 'The Uploaded file is not similar to CSV template. Please use that template for your reference';

//negative_value 
$_['negativeValue'] = 'Please enter a positive value';
$_['helpContent']  = '<ol>
<li> Download Product Template and Category template for your reference</li>
<li>You can see product id and category id from reference files above.</li>
<li>Click Coupon Settings to set your settings for importing coupons.</li>
<li>Download Coupon CSV Template contains coupons based on your settings.</li>
<li>Open CSV and add your product id or category id.</li>
<li>While modifying CSV Template, please note:
<ol type="i"><li>Dont leave name and code column empty</li>
<li>All codes are unique. If you modify make sure it is unique.</li>
<li>New option "shipping-amount" is provided to exclude shipping amount.</li>
<li>Use Product Template to find product id.</li>
<li>Use Category Template to find category id.</li>
<li>For applying on multiple products and categories use semicolon between id\'s.</li>
<li>For ex: 12;13;56 This will apply coupon to product ids 12, 13 & 56</li></ol></li></ol>';

?>