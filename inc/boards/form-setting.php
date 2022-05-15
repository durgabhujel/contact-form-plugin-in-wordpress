<div class="sp-tabs-board" style=display:none;>......
</div>
<!--form configration-->
<div class="line"></div>
<div class="sp-form-labels">
    <div class="sp-option-labels">
     <h2>Form field Configurations</h2>
    </div><!--sp-form-labels-->
    <!-- contact us field-->
    <div class="sp-option-wrapper">
        <label for="title">Form Title</label><br>
       <input type="text" name="form_title" value="<?php echo esc_attr($ap_setting['form_title']) ?>">
    </div>
    <!-- contact us-->
    <!--first name-->
    <div class="sp-option-wrapper">
        <label for="first_name">First Name Label</label>
        <div class="sp-option-field">
            <input type="text" name="first_name" id="first_name" value="<?php echo esc_attr($ap_setting['first_name'])?>">
        </div>
    </div>
    <!--first name-->
    <!--last name-->
    <div class="sp-option-wrapper">
        <label for="last_name">Last Name Label</label>
        <div class="sp-option-field">
            <input type="text" name="last_name" id="last_name" value="<?php echo esc_attr($ap_setting['last_name']); ?>"/>
        </div>
    </div>
    <!--last name-->
    <!--admin_email_url-->
    <div class="sp-option-wrapper">
        <label for="email">Email Label</label>
        <div class="sp-option-field">
            <input type="text" name="admin_email_url" id="email" value="<?php echo esc_attr($ap_setting['admin_email_url']); ?>"/>
        </div>
    </div>
    <!--your message-->
    <div class="sp-option-wrapper">
        <label for="your_message"> Message Label</label>
        <div class="sp-option-field">
            <input type="text" name="your_message" id="your_message" value="<?php echo esc_attr($ap_setting['your_message']) ;?>"/>

        </div>
    </div>
    <!-- your message-->
    <!--submit meassage-->
    <div class="sp-option-wrapper">
        <label for="Submit_message">Submit label</label>
        <div class="submit-btn">
            <input type="text" name="submit_your_message" value="<?php echo esc_attr($ap_setting['submit_your_message'])?>"/>
        </div>
  </div>
</div>
