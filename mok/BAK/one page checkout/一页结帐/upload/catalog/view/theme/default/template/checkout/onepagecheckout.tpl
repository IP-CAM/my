<?php echo $header; ?>
<div class="container">
    <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
            <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
    </ul>
    <?php if ($error_warning) { ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php } ?>
    <div class="row"><?php echo $column_left; ?>
        <?php if ($column_left && $column_right) { ?>
            <?php $class = 'col-sm-6'; ?>
        <?php } elseif ($column_left || $column_right) { ?>
            <?php $class = 'col-sm-9'; ?>
        <?php } else { ?>
            <?php $class = 'col-sm-12'; ?>
        <?php } ?>
        <div id="content">
            <h1 style="text-align: center"><?=$heading_title?></h1>

            <div class="row">
                <div class="checkout checkout-checkout">

                        <?=$content_top; ?>

                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 payment-data">
                        <div class="t-head">
                            <?=$text_customer?>
                        </div>
                        <div id="payment-address">
                            <div class="checkout-content" style="overflow: hidden; display: block;">
                                <div class="fields-group">
                                    <label for="firstname-ch"><span class="required">*</span>   <?=$text_full_name?> :</label><br>
                                    <input type="text" id="firstname-ch" name="firstname" value="" class="form-control large-field">
                                    <span class="error"></span>

                                </div>

                                <div class="fields-group">
                                    <label for="telephone-ch"><span class="required">*</span>   <?=$text_telephone?>:</label><br>
                                    <input type="tel" id="telephone-ch" name="telephone"
                                           value="<?php echo $telephone; ?>" class="form-control large-field">
                                    <span class="error"></span>

                                </div>

                                <div class="fields-group">
                                    <label for="email-ch">   <?=$text_email?>:</label><br>
                                    <input type="text" id="email-ch" name="email" value="<?php echo $email; ?>"
                                           class="form-control large-field">
                                    <span class="error"></span>

                                </div>

                                <div class="fields-group">
                                    <label for="city-ch"><span class="required">*</span>   <?=$text_town?>:</label><br>
                                    <input type="text" id="city-ch" name="city" value="<?php echo $city; ?>"
                                           class="form-control large-field">
                                    <span class="error"></span>
                                </div>

                                <div class="fields-group">
                                    <label for="delivery">  <?=$text_delivery_method?>:</label><br>
                                    <select name="shipping_method" id="shipping_method" class="form-control large-field">
                                        <?php foreach ($shippig_methods as $shipping_method) { ?>
                                            <option
                                                value='{"title": "<?php echo $shipping_method['title'] ?>", "code": "<?php echo $shipping_method['value'] ?>"}'
                                                class="form-control large-field <?= substr($shipping_method['value'], strpos($shipping_method['value'], '.')+1 )?>"><?php echo $shipping_method['title'] ?></option>

                                        <?php } ?>
                                    </select>
                                    <br>
                                    <div class="group-check">
                                        <label><input id="to-office" class="delivery-type" type="radio"
                                                      name="delivery-type" checked="checked"
                                                      value=" <?=$text_delivery_type_1?>">   <?=$text_delivery_type_1?></label> &nbsp;&nbsp;
                                        <label><input id="to-adress" class="delivery-type" type="radio"
                                                      name="delivery-type" value=" <?=$text_delivery_type_2?>">   <?=$text_delivery_type_2?></label>
                                    </div>
                                    <input type="text" name="address_1" id="address_1" value="<?php echo $adress_1 ?>"
                                           class="form-control large-field" placeholder="  <?=$text_delivery_placeholder?>">
                                    <span class="error"></span>

                                </div>
                                <div class="fields-group">
                                    <label for="payment_select">  <?=$text_payment_method?>:</label><br>
                                    <select id="payment_select" name="payment_method" class="form-control large-field">
                                        <?php foreach ($payment_methods as $payment_method) { ?>
                                            <option
                                                value='{"title": "<?php echo $payment_method['title'] ?>", "code": "<?php echo $payment_method['code'] ?>"}'
                                                class="payment_method_value <?php echo $payment_method['code']?>"
                                                style=""><?php echo $payment_method['title'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="fields-group">
                                    <label for="comment_field">  <?=$text_comment?>:</label><br>
                                    <input type="text" id="comment_field" class="form-control large-field" name="comment"
                                           value="<?php echo $comment ?>">
                                </div>
                            </div>
                        </div>
                        <div id="confirm">
                            <div class="payment">
                                <div id="button-confirm" class=" btn btn-lg btn-success">
                                    <?=$text_confirm?>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 checkout-data">
                        <div class="cart-info table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <td class="name t-head">  <?=$text_product?></td>
                                    <td class="price t-head"><?=$text_price?></td>
                                    <td class="quantity t-head"><?=$text_quantity?></td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($products as $product) { ?>
                                    <tr>
                                        <td class="name">
                                            <a href="/index.php?route=product/product&product_id=<?php echo $product['product_id'] ?>"><?php echo $product['name'] ?></a>
                                            <div class="p-model">
                                                <?php echo $product['model'] ?>                                </div>
                                            <div class="cart-option">
                                                <?php foreach ($product['option'] as $option) { ?>
                                                    -
                                                    <small><?php echo $option['name']; ?>
                                                        : <?php echo $option['value']; ?></small><br/>
                                                <?php } ?>
                                                <?php if ($product['recurring']): ?>
                                                    -
                                                    <small><?php echo $text_payment_profile ?>
                                                        : <?php echo $product['profile_name'] ?></small>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td class="price"><?php echo $product['price'] ?>   </td>
                                        <td class="quantity"><?php echo $product['quantity'] ?>   </td>
                                    </tr>

                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row table-bottom">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td class="shop-total">
                                                <?=$text_total?>: <span><?php echo $cart_total ?></span>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                            </div>
                        </div>

                    </div>
                    <div class="col-xs-12 checkout-subinfo">
<?=$content_bottom?>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $column_right; ?></div>
</div>
<script type="text/javascript"><!--



    $(document).ready(function () {

        $('#button-confirm').on('click', function () {

            $.ajax({
                url: 'index.php?route=checkout/onepagecheckout',
                type: 'post',
                data: $('.checkout-checkout .payment-data input[type=\'text\'], .checkout-checkout .payment-data input[type=\'tel\'], .checkout-checkout .payment-data input[type=\'radio\']:checked, .checkout-checkout .payment-datainput input[type=\'checkbox\']:checked, .checkout-checkout .payment-data  select '),
                dataType: 'json',
                beforeSend: function () {
                    $('#button-confirm').addClass('preloader');

                },
                complete: function () {
                    $('#button-confirm').removeClass('preloader');

                },
                success: function (json) {
                    console.log(json);
                    if (json.error) {
                        if (json['error']['firstname']) {
                            $('#firstname-ch+.error').html(json['error']['firstname']);
                        }


                        if (json['error']['email']) {
                            $('#email-ch+.error').html(json['error']['email']);
                        }

                        if (json['error']['telephone']) {
                            $('#telephone-ch+.error').html(json['error']['telephone']);
                        }

                        if (json['error']['address_1']) {
                            $('#address_1+.error').html(json['error']['address_1']);
                        }

                        if (json['error']['city']) {
                            $('#city-ch+.error').html(json['error']['city']);
                        }
                    } else {
                        if (json.credit)
                            credit_confirm('/index.php?route=checkout/part_payment_cart/getResult&from_privat24=true');
                        else
                            location = '/opencart-2302/index.php?route=checkout/success'

                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });


        });


    });
    //--></script>
<?php echo $footer; ?>
