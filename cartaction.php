<?php 
// Include the database connection file 
require_once 'dbconnection.inc.php'; 
 
// Initialize shopping cart class 
require_once 'cart.class.php'; 
$cart = new Cart; 
 
// Default redirect page 
$redirectURL = 'index3.php'; 
 
// Process request based on the specified action 
if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){ 
    if($_REQUEST['action'] == 'addToCart' && !empty($_REQUEST['id'])){ 
        $food_id = $_REQUEST['id']; 
 
        // Fetch product details from the database 
        $sqlQ = "SELECT * FROM tbl_food WHERE food_id=?"; 
        $stmt = $conn->prepare($sqlQ); 
        $stmt->bind_param("i", $db_id); 
        $db_id = $food_id; 
        $stmt->execute(); 
        $result = $stmt->get_result(); 
        $productRow = $result->fetch_assoc(); 
 
        $itemData = array( 
            'id' => $productRow['food_id'], 
            'image' => $productRow['food_image'], 
            'name' => $productRow['food_name'], 
            'category' => $productRow['food_category'], 
            'price' => $productRow['food_sellingprice'], 
            'qty' => 1 
        ); 
         
        // Insert item to cart 
        $insertItem = $cart->insert($itemData); 
         
        // Redirect to cart page 
        $redirectURL = $insertItem?'viewcart.php':'index3.php'; 
    }elseif($_REQUEST['action'] == 'updateCartItem' && !empty($_REQUEST['id'])){ 
        // Update item data in cart 
        $itemData = array( 
            'rowid' => $_REQUEST['id'], 
            'qty' => $_REQUEST['qty'] 
        ); 
        $updateItem = $cart->update($itemData); 
         
        // Return status 
        echo $updateItem?'ok':'err';die; 
    }elseif($_REQUEST['action'] == 'removeCartItem' && !empty($_REQUEST['id'])){ 
        // Remove item from cart 
        $deleteItem = $cart->remove($_REQUEST['id']); 
         
        // Redirect to cart page 
        $redirectURL = 'viewcart.php'; 
    }elseif($_REQUEST['action'] == 'placeOrder' && $cart->total_items() > 0){ 
        $redirectURL = 'checkout.php'; 
         
        // Store post data 
        $_SESSION['postData'] = $_POST; 
     
        $cid = strip_tags($_POST['cid']); 
        $stat = strip_tags($_POST['status']);
        $details = strip_tags($_POST['details']);
        $time = strip_tags($_POST['time']);
        $date = strip_tags($_POST['date']);
        $method = strip_tags($_POST['method']);

        $errorMsg = ''; 
        if(empty($cid)){ 
            $errorMsg .= 'Please enter Customer ID.<br/>'; 
        } 
        if(empty($stat)){ 
            $errorMsg .= 'Please enter Reservation Status.<br/>'; 
        } 
        if(empty($date)){ 
            $errorMsg .= 'Please enter Reservation Date.<br/>'; 
        } 
        // if(empty($email1) || !filter_var($email1, FILTER_VALIDATE_EMAIL)){ 
        //     $errorMsg .= 'Please enter a valid email.<br/>'; 
        // } 
        if(empty($details)){ 
            $errorMsg .= 'Please enter Reservation Details.<br/>'; 
        } if(empty($time)){ 
            $errorMsg .= 'Please enter Reservation Time.<br/>'; 
        }
         
        if(empty($errorMsg)){ 
            // Insert customer data into the database 
            $sqlQ = "INSERT INTO tbl_order(customer_id, created_on, updated_on, order_total, payment_method, order_status) VALUES (?,NOW(),NOW(),?,?,?)"; 
            $stmt = $conn->prepare($sqlQ); 
            $stmt->bind_param("idss", $db_cid, $db_total1, $db_method, $db_status); 
            $db_cid = $cid;
            $db_method = $method;
            $db_status = $stat; 
            $db_total = $cart->total(); 
            $db_total1 = $db_total + 150;
            $insertOrd = $stmt->execute(); 
             
            if($insertOrd){ 
                $ordID = $stmt->insert_id;

                //Update reservation details
                $sqlQ = "INSERT INTO tbl_reservations(reservation_details, `time`, `date`, order_id, customer_id, created_on, updated_on) VALUES(?, ?, ?, ?, ?, NOW(), NOW())"; 
                $stmt = $conn->prepare($sqlQ); 
                $stmt->bind_param("sssii", $db_details, $db_time, $db_date, $db_order_id, $db_customer_id); 
                $db_customer_id = $cid; 
                $db_details = $details; 
                $db_order_id = $ordID; 
                $db_time = $time; 
                $db_date = $date; 
                $insertreserve = $stmt->execute(); 
                     
                    // Retrieve cart items 
                    $cartItems = $cart->contents(); 
                     
                    // Insert order details in the database 
                    if(!empty($cartItems)){ 
                        $sqlQ = "INSERT INTO tbl_orderdetails(food_name, food_id, quantity, price, order_id, created_on) VALUES (?,?,?,?,?,NOW())"; 
                        $stmt = $conn->prepare($sqlQ); 
                        foreach($cartItems as $item){ 
                            $stmt->bind_param("sssdi", $db_fname, $db_fid, $db_quantity, $db_fprice, $db_order_id); 
                            $db_order_id = $ordID; 
                            $db_fid = $item['id']; 
                            $db_quantity = $item['qty']; 
                            $db_fname = $item['name']; 
                            $db_fprice = $item['price']; 
                            $insertitemsss = $stmt->execute(); 
                        } 

                        // Deduct food quantities from the database 
                    if($insertitemsss){ 
                        $sqlQ = "UPDATE tbl_food SET quantity = quantity - $db_quantity WHERE food_id = ?"; 
                        $stmt = $conn->prepare($sqlQ); 
                        foreach($cartItems as $item){ 
                            $stmt->bind_param("i", $db_fid); 
                            $db_fid = $item['id']; 
                            $db_quantity = $item['qty']; 
                            $upquan = $stmt->execute(); 
                         
                    } 

                          if($upquan){ 

                        // Remove all items from cart 
                        $cart->destroy(); 
                         
                        // Redirect to the status page 
                        $redirectURL = 'ordersuccess.php?id='.base64_encode($orderID); 
                    }else{ 
                        $sessData['status']['type'] = 'error'; 
                        $sessData['status']['msg'] = 'Something went wrong, please try again.'; 
                    } 
                }else{ 
                    $sessData['status']['type'] = 'error'; 
                    $sessData['status']['msg'] = 'Something went wrong, please try again. 1'; 
                } 
            }else{ 
                $sessData['status']['type'] = 'error'; 
                $sessData['status']['msg'] = 'Something went wrong, please try again. 2';
            } 
        }else{ 
                $sessData['status']['type'] = 'error'; 
                $sessData['status']['msg'] = 'Something went wrong, please try again. 3';
            } 
        }else{ 
                $sessData['status']['type'] = 'error'; 
                $sessData['status']['msg'] = 'Something went wrong, please try again. 4';
            }
        }else{ 
            $sessData['status']['type'] = 'error'; 
            $sessData['status']['msg'] = '<p>Please fill all the mandatory fields.</p>'.$errorMsg;  
        } 
         
        // Store status in session 
        $_SESSION['sessData'] = $sessData; 
    
    } 

// Redirect to the specific page 
header("Location: $redirectURL"); 
exit();
?>
