<?php
require "functions.php";
session_start();
$id = $_SESSION['id'];

$addressOptions = getAddressOptionsByUserID($id);
$cardOptions = getCardPaymentOptionsByUserID($id);
$paypalOptions = getPayPalPaymentOptionsByUserID($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Diary</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <script type="text/javascript" src="script/script.js"></script>
</head>
<body class="orderDiaryBody" onload="paperColorType();getTotalPrice()">

<div class="orderDiaryMain">
    <div class="orderDiaryContent">
        <form>
            <div class="orderDiaryLeft">

                <div class="title">Create Diary</div>
                <div class="paperColorType">
                    <div class="inputTitle">Paper Color Type:</div>
                    <div class="paperColorTypeOption">
                        <input type="radio" name="paperColorType" value="color" onclick="changePaperColorType()" checked="checked"><span>Color</span>
                        <input type="radio" name="paperColorType" value="theme" onclick="changePaperColorType()"><span>Theme</span>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="paperColor">
                    <div class="inputTitle">Paper Color:</div>
                    <input id="paperColor" type="color">
                </div>
                <div class="clear"></div>
                <div class="paperTheme">
                    <div class="inputTitle">Paper Theme:</div>
                    <select id="paperTheme">
                        <option>Test1</option>
                    </select>
                </div>
                <div class="clear"></div>
                <div class="paperType">
                    <div class="inputTitle">Paper Type:</div>
                    <div class="paperTypeOption">
                        <input type="radio" name="paperType" value="plain"><span>Plain</span>
                        <input type="radio" name="paperType" value="lined"><span>Lined</span>
                        <input type="radio" name="paperType" value="dotted"><span>Dotted</span>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="coverColor">
                    <div class="inputTitle">Cover Color:</div>
                    <input type="color">
                </div>
                <div class="clear"></div>
                <div class="coverText">
                    <div class="inputTitle">Cover Text:</div>
                    <input type="text">
                </div>
                <div class="clear"></div>
                <div class="diaryPrice">
                    <div class="inputTitle">Unit Price:</div>
                    <div id="diaryPrice" class="price"></div>
                </div>

            </div>

            <div class="orderDiaryRight">

                <div class="title">Order Details</div>
                <div class="quantity">
                    <div class="inputTitle">Quantity:</div>
                    <input id="quantity" type="number" value="0" onchange="getTotalPrice(this)">
                </div>
                <div class="paymentMethod">
                    <div class="inputTitle">Payment Method:</div>
                    <div class="paymentMethodOption">
                        <input type="radio" name="paymentMethod" value="Card" checked="checked" onclick="changePaymentOption()"><span>Card</span>
                        <input type="radio" name="paymentMethod" value="PayPal" onclick="changePaymentOption()"><span>PayPal</span>
                    </div>
                </div>
                <div class="paymentAccount">
                    <div class="inputTitle">Payment Account:</div>
                    <select id="Card">
                        <?php
                            if($cardOptions->num_rows == 0){
                                echo "<option> No Card Payment Method, Please Add Payment Method </option>";
                            }else{
                                while($card = $cardOptions->fetch_assoc()){
                                    echo "<option value='" . $card['id'] ."'>";
                                    echo $card['type'] . " : " . $card['account'];
                                    echo "</option>";
                                }
                            }
                        ?>
                    </select>
                    <select id="PayPal" hidden="hidden">
                        <?php
                            if($paypalOptions->num_rows == 0){
                                echo "<option> No PayPal Payment Method, Please Add Payment Method </option>";
                            }else{
                                while($paypal = $paypalOptions->fetch_assoc()){
                                    echo "<option value='" . $paypal['id'] ."'>";
                                    echo $paypal['type'] . " : " . $paypal['account'];
                                    echo "</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="address">
                    <div class="inputTitle">Address:</div>
                    <select>
                        <?php
                            if($addressOptions->num_rows == 0){
                                echo "<option> No Address, Please Add New Address </option>";
                            }else{
                                while($address = $addressOptions->fetch_assoc()){
                                    echo "<option value='" . $address['id'] . "'>";
                                    echo $address['name'] . " : " . $address['address'];
                                    echo "</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="postage">
                    <div class="inputTitle">Postage:</div>
                    <div class="price">$10</div>
                </div>
                <div class="totalPrice">
                    <div class="inputTitle">Total Price:</div>
                    <div id="totalPrice" class="price"></div>
                </div>

            </div>

            <div class="buttonDiv">
                <button class="button" type="submit">Submit</button>
            </div>
        </form>
    </div>

</div>

</body>
</html>