<?php
require dirname( dirname(__FILE__) ).'/api/Prozigzig.php';
$h = new Prozigzig($probus);
$query = "SELECT * FROM `tbl_setting`";
		  $set = $h->fetchData($query);
		 
date_default_timezone_set($set['timezone']);

if(isset($_SESSION['stype']))
	{
		if($_SESSION['stype'] == 'sowner')
		{
	
		$query = "SELECT * FROM `tbl_bus_operator` where email='".$_SESSION['busname']."'";
		  $sdata = $h->fetchData($query);
		}
	}
if (isset($_POST["type"])) {
    if ($_POST["type"] == "login") {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $stype = $_POST["stype"];
        $sel_lan = $_POST["sel_lan"];
        if ($stype == "mowner") {
            $count = $h->login($username, $password, "admin");
            if ($count == -1) {
                $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
            } else {
                if ($count == 1) {
                    $_SESSION["busname"] = $username;
                    $_SESSION["stype"] = $stype;
                    $_SESSION["sel_lan"] = $sel_lan;
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Login Successfully!",
                        "message" => "welcome admin!!",
                        "action" => "dashboard.php",
                    ];
                } else {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "false",
                        "title" => "Please Use Valid Data!!",
                        "message" => "Invalid Data!!",
                        "action" => "index.php",
                    ];
                }
            }
        } else {
            $count = $h->login($username, $password, "tbl_bus_operator");
            if ($count == -1) {
                $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
            } else {
                if ($count == 1) {
                    $_SESSION["busname"] = $username;
                    $_SESSION["stype"] = $stype;
                    $_SESSION["sel_lan"] = $sel_lan;
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Login Successfully!",
                        "message" => "welcome Bus Operator!!",
                        "action" => "dashboard.php",
                    ];
                } else {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "false",
                        "title" => "Please Use Valid Data!!",
                        "message" => "Invalid Data!!",
                        "action" => "index.php",
                    ];
                }
            }
        }
    } elseif ($_POST['type'] == 'book_ticket') {
        $uid = $_POST['uid'];
        $probus_id = $_POST['bus_id'];
        $operator_id = $_POST['operator_id'];
        $seatlist = $_POST['seatlist'];
        $slist = explode(',', $_POST['seatlist']);
        $book_date = $_POST['book_date'];
        $pickup_id = $_POST['pickup_id'];
        $drop_id = $_POST['drop_id'];
        $tax = $_POST['tax'];
        $tax_amt = $_POST['tax_amt'];
        $cou_amt = $_POST['cou_amt'];
        $wall_amt = $_POST['wall_amt'];
        $subtotal = $_POST['subtotal'];
        $total = $_POST['total'];
        $total_seat = $_POST['total_seat'];
        $payment_method_id = $_POST['payment_method_id'];
        $transaction_id = $_POST['transaction_id'];
        $user_type = $_POST['user_type'];
        $commission = $_POST['commission'];
        $comm_per = $_POST['comm_per'];
        $ope_commission = $_POST['ope_commission'];
        $boarding_city = $_POST['boarding_city'];
        $drop_city = $_POST['drop_city'];
        $ticket_price = $_POST['ticket_price'];
        $probus_picktime = $_POST['bus_picktime'];
        $probus_droptime = $_POST['bus_droptime'];
        $Difference_pick_drop = $_POST['Difference_pick_drop'];
        $sub_pick_time = $_POST['sub_pick_time'];
        $sub_pick_place = $_POST['sub_pick_place'];
        $sub_pick_address = $_POST['sub_pick_address'];
        $sub_pick_mobile = $_POST['sub_pick_mobile'];
        $sub_drop_time = $_POST['sub_drop_time'];
        $sub_drop_place = $_POST['sub_drop_place'];
        $sub_drop_address = $_POST['sub_drop_address'];
        $probus_board_date = $_POST['bus_board_date'];
        $probus_drop_date = $_POST['bus_drop_date'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $ccode = $_POST['ccode'];
        $mobile = $_POST['mobile'];
        $check_seat = $h->queryfire("select * from tbl_book_pessenger where seat_no IN('" . $seatlist . "') and book_date='" . $book_date . "'")->num_rows;
        if ($check_seat != 0) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "false",
                "title" => "Choosen Seat Booked Please Select Another One!!",
                "message" => "Seat Validation!!",
                "action" => "book_ticket.php",
            ];
        } else {
            $table = "tbl_book";
            $field_values = [
                "mobile",
                "ccode",
                "email",
                "name",
                "bus_drop_date",
                "bus_board_date",
                "sub_drop_address",
                "sub_drop_place",
                "sub_drop_time",
                "sub_pick_mobile",
                "sub_pick_address",
                "sub_pick_place",
                "uid",
                "bus_id",
                "operator_id",
                "book_date",
                "pickup_id",
                "drop_id",
                "tax",
                "tax_amt",
                "cou_amt",
                "wall_amt",
                "subtotal",
                "total",
                "total_seat",
                "payment_method_id",
                "Difference_pick_drop",
                "bus_picktime",
                "ticket_price",
                "boarding_city",
                "drop_city",
                "transaction_id",
                "user_type",
                "commission",
                "comm_per",
                "ope_commission",
                "bus_droptime",
                "sub_pick_time",
            ];

            $data_values = [
                $mobile,
                $ccode,
                $email,
                $name,
                $probus_drop_date,
                $probus_board_date,
                $sub_drop_address,
                $sub_drop_place,
                $sub_drop_time,
                $sub_pick_mobile,
                $sub_pick_address,
                $sub_pick_place,
                $uid,
                $probus_id,
                $operator_id,
                $book_date,
                $pickup_id,
                $drop_id,
                $tax,
                $tax_amt,
                $cou_amt,
                $wall_amt,
                $subtotal,
                $total,
                $total_seat,
                $payment_method_id,
                $Difference_pick_drop,
                $probus_picktime,
                $ticket_price,
                $boarding_city,
                $drop_city,
                $transaction_id,
                $user_type,
                $commission,
                $comm_per,
                $ope_commission,
                $probus_droptime,
                $sub_pick_time,
            ];

            $book_id = $h->insertDataId($field_values, $data_values, $table);

            $pname = $_POST['pname'];
            $age = $_POST['page'];
            $gender = $_POST['gender'];
            for ($i = 0; $i < count($slist); $i++) {
                $name = $h->real_string($pname[$i]);
                $age = $age[$i];
                $seat_no = $slist[$i];
                $genders = $gender[$i];

                $table = "tbl_book_pessenger";
                $field_values = ["book_id", "bus_id", "name", "gender", "seat_no", "age", "book_date"];
                $data_values = ["$book_id", "$probus_id", "$name", "$genders", "$seat_no", "$age", "$book_date"];

                $check = trim($h->insertData($field_values, $data_values, $table));
            }
            if ($check == -1) {
                $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
            } else {
                $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Book Ticket Successfully!!", "message" => "Ticket Section!!", "action" => "book_ticket.php"];
            }
        }
    } elseif ($_POST["type"] == "add_cash") {
        $rcash = $_POST['rcash'];
        $message = $_POST['message'];
        $store_id = $_POST['store_id'];

        $timestamp = date("Y-m-d H:i:s");

        $table = "tbl_cash";
        $field_values = ["operator_id", "Remark", "amt", "receive_date"];
        $data_values = ["$store_id", "$message", "$rcash", "$timestamp"];

        $checks = trim($h->insertData($field_values, $data_values, $table));
        if ($checks == -1) {
            $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
        } else {
            if ($checks == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Add Cash Successfully!!",
                    "message" => "Cash section!",
                    "action" => "list_bus_operator.php",
                ];
            } 
        }
    } elseif ($_POST['type'] == 'add_driver') {
        $driver_name = $h->real_string($_POST['driver_name']);
        $email = $h->real_string($_POST['email']);
        $password = $h->real_string($_POST['password']);
        $mobile = $h->real_string($_POST['mobile']);
        $status = $_POST['status'];
        $operator_id = $sdata["id"];
        $check_mail = $h->queryfire("Select * from tbl_driver where email='" . $email . "'")->num_rows;
        if ($check_mail) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "false",
                "title" => "Email Address Already Used!!",
                "message" => "Same Email Detected!!",
                "action" => "add_driver.php",
            ];
        } else {
            $table = "tbl_driver";
            $field_values = ["driver_name", "email", "password", "mobile", "status", "operator_id"];
            $data_values = ["$driver_name", "$email", "$password", "$mobile", "$status", "$operator_id"];

            $checks = trim($h->insertData($field_values, $data_values, $table));
            if ($checks == -1) {
                $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
            } else {
                if ($checks == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Add Driver Successfully!!",
                        "message" => "Driver section!",
                        "action" => "add_driver.php",
                    ];
                } 
            }
        }
    } elseif ($_POST['type'] == 'edit_driver') {
        $driver_name = $h->real_string($_POST['driver_name']);
        $email = $h->real_string($_POST['email']);
        $password = $h->real_string($_POST['password']);
        $mobile = $h->real_string($_POST['mobile']);
        $operator_id = $sdata["id"];
        $status = $_POST['status'];
        $id = $_POST['id'];
        $check_mail = $h->queryfire("Select * from tbl_driver where email='" . $email . "' and id!=" . $id . "")->num_rows;
        if ($check_mail) {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "false",
                "title" => "Email Address Already Used!!",
                "message" => "Same Email Detected!!",
                "action" => "add_driver.php?id=" . $id . "",
            ];
        } else {
            $table = "tbl_driver";
            $field = ['driver_name' => $driver_name, 'email' => $email, 'password' => $password, 'mobile' => $mobile, 'status' => $status];
            $where = "where id=" . $id . " and operator_id=" . $operator_id . "";

            $check = trim($h->updateData($field, $table, $where));
            if ($check == -1) {
                $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
            } else {
                if ($check == 1) {
                    $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Driver Update Successfully!!", "message" => "Driver section!", "action" => "list_driver.php"];
                } 
            }
        }
    } elseif ($_POST['type'] == 'add_payout') {
        $operator_id = $sdata["id"];
        $amt = $_POST['amt'];
        $r_type = $_POST['r_type'];
        $acc_number = $_POST['acc_number'];
        $bank_name = $_POST['bank_name'];
        $acc_name = $_POST['acc_name'];
        $ifsc_code = $_POST['ifsc_code'];
        $upi_id = $_POST['upi_id'];
        $paypal_id = $_POST['paypal_id'];

        $total_earn = $h->queryfire("select sum((subtotal -(cou_amt+commission)) - ((subtotal -cou_amt) * ope_commission/100)) as total_amt from tbl_book where operator_id=" . $sdata["id"] . " and book_status ='Completed'")->fetch_assoc();
        $earn = empty($total_earn['total_amt']) ? 0 : number_format((float) $total_earn['total_amt'], 2, '.', '');

        $total_payout = $h->queryfire("select sum(amt) as total_payout from bus_payout_setting where operator_id=" . $sdata["id"] . "")->fetch_assoc();
        $payout = empty($total_payout['total_payout']) ? 0 : number_format((float) $total_payout['total_payout'], 2, '.', '');

        $bs = 0;

        if ($earn == 0) {
        } else {
            $bs = number_format((float) $earn - $payout, 2, '.', '');
        }

        if (floatval($amt) > floatval($set['operator_limit'])) {
            $returnArr = ["ResponseCode" => "401", "Result" => "false", "title" => "You can't Payout Above Your Payout Limit!", "message" => "Payout Problem!!", "action" => "add_payout.php"];
        } elseif (floatval($amt) > floatval($bs)) {
            $returnArr = ["ResponseCode" => "401", "Result" => "false", "title" => "You can't Payout Above Your Earning!" . $bs, "message" => "Payout Problem!!", "action" => "add_payout.php"];
        } else {
            $timestamp = date("Y-m-d H:i:s");
            $table = "bus_payout_setting";
            $field_values = ["operator_id", "amt", "status", "r_date", "r_type", "acc_number", "bank_name", "acc_name", "ifsc_code", "upi_id", "paypal_id"];
            $data_values = ["$operator_id", "$amt", "pending", "$timestamp", "$r_type", "$acc_number", "$bank_name", "$acc_name", "$ifsc_code", "$upi_id", "$paypal_id"];

            $check = trim($h->insertData($field_values, $data_values, $table));
            if ($check == -1) {
                $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
            } else {
                $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Payout Request Submit Successfully!!", "message" => "Payout Submitted!!", "action" => "add_payout.php"];
            }
        }
    } elseif ($_POST["type"] == "op_com_payout") {
        $payout_id = $_POST["payout_id"];
        $target_dir = dirname(dirname(__FILE__)) . "/images/payout/";
        $url = "images/payout/";
        $temp = explode(".", $_FILES["cat_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
        if (end($temp) != "jpg" && end($temp) != "png" && end($temp) != "jpeg") {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "false",
                "title" => "Sorry, only JPG, JPEG, PNG  files are allowed !!",
                "message" => "Upload Problem!!",
                "action" => "op_payout.php",
            ];
        } else {
            move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
            $table = "bus_payout_setting";
            $field = ["proof" => $url, "status" => "completed"];
            $where = "where id=" . $payout_id . "";

            $check = trim($h->updateData($field, $table, $where));
            if ($check == -1) {
                $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
            } else {
                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Payout Update Successfully!!",
                        "message" => "Payout section!",
                        "action" => "op_payout.php",
                    ];
                } 
            }
        
    } }elseif ($_POST["type"] == "add_code") {
        $okey = $_POST["status"];
        $title = $h->real_string($_POST["title"]);

        $table = "tbl_code";
        $field_values = ["ccode", "status"];
        $data_values = ["$title", "$okey"];

        $check = trim($h->insertData($field_values, $data_values, $table));
        if ($check == -1) {
            $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
        } else {
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Country Code Add Successfully!!",
                    "message" => "Country Code section!",
                    "action" => "list_code.php",
                ];
            } 
        }
    } elseif ($_POST['type'] == "edit_bus") {
        $title = $h->real_string($_POST['title']);
        $bno = $h->real_string($_POST['bno']);
        $tick_price = $h->real_string($_POST['tick_price']);
        $driver_direction = $h->real_string($_POST['driver_direction']);
        $decker = $_POST['decker'];
        $operator_id = $sdata['id'];
        $driver_id = $_POST['driver_id'];
        $bstatus = $_POST['bstatus'];
        $rate = $_POST['rate'];
        $totl_seat = $_POST['totl_seat'];
        $seat_limit = $_POST['seat_limit'];
        $bac = $_POST['bac'];
        $is_sleeper = $_POST['is_sleeper'];
        $facilitylist = empty($_POST['facilitylist']) ? "" : implode(',', $_POST['facilitylist']);
        $offday = empty($_POST['offday']) ? "" : implode(',', $_POST['offday']);

        $id = $_POST["id"];
        if ($_FILES["bus_img"]["name"] != '') {
            $target_dir = dirname(dirname(__FILE__)) . "/images/bus/";
            $url = "images/bus/";
            $temp = explode(".", $_FILES["bus_img"]["name"]);
            $newfilename = round(microtime(true)) . '.' . end($temp);
            $target_file = $target_dir . basename($newfilename);
            $url = $url . basename($newfilename);
            if (end($temp) != "jpg" && end($temp) != "png" && end($temp) != "jpeg") {
                $returnArr = ["ResponseCode" => "200", "Result" => "false", "title" => "Sorry, only JPG, JPEG, PNG  files are allowed !!", "message" => "Upload Problem!!", "action" => "add_bus.php?id=" . $id . ""];
            } else {
                if ($decker == 1) {
                    $rows = $_POST['rows'];
                    $columns = $_POST['columns'];

                    // Initialize a variable to store the seat data
                    $seatData = "";
                    $berth_type = 'LOWER';
                    // Loop through the submitted data and process it
                    for ($i = 0; $i < $rows; $i++) {
                        for ($j = 0; $j < $columns; $j++) {
                            $seatData .= $_POST['lower_' . $i . '_' . $j] . ',';
                        }
                        $seatData .= $berth_type . '$;';
                    }

                    // Remove trailing "$;" if it exists
                    if (substr($seatData, -2) === '$;') {
                        $seatData = substr($seatData, 0, -2);
                    }

                    $elements = explode("$;", $seatData); // Split the string into elements

                    $digitCount = 0; // Initialize the count for digits

                    foreach ($elements as $element) {
                        // Split each element into subparts
                        $parts = explode(",", $element);
                        foreach ($parts as $part) {
                            // Check if the part is numeric and doesn't contain letters, or if it's greater than 9
                            if (!empty($part) && $part != "LOWER" && $part != "UPPER") {
                                $digitCount++;
                            }
                        }
                    }
                    if ($digitCount == $totl_seat) {
                        move_uploaded_file($_FILES["bus_img"]["tmp_name"], $target_file);
                        $table = "tbl_bus";
                        $field = [
                            'bus_img' => $url,
                            'title' => $title,
                            'bno' => $bno,
                            'bstatus' => $bstatus,
                            'tick_price' => $tick_price,
                            'driver_direction' => $driver_direction,
                            'decker' => $decker,
                            'lower_row' => $rows,
                            'lower_column' => $columns,
                            'upper_row' => "4",
                            'upper_column' => "4",
                            'rate' => $rate,
                            'totl_seat' => $totl_seat,
                            'seat_limit' => $seat_limit,
                            'bac' => $bac,
                            'is_sleeper' => $is_sleeper,
                            'seat_layout' => $seatData,
                            'bus_facility' => $facilitylist,
                            'offday' => $offday,
                            'driver_id' => $driver_id,
                            'operator_id' => $operator_id,
                        ];
                        $where = "where id=" . $id . "";

                        $check = trim($h->updateData($field, $table, $where));
                        if ($check == -1) {
                            $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
                        } else {
                            $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Bus Update Successfully", "message" => "Bus section!", "action" => "list_bus.php"];
                        }
                    } else {
                        $returnArr = ["ResponseCode" => "200", "Result" => "false", "title" => "Total Seat With Added Seat Total Not Matched Check Proper!!", "message" => "Bus section!", "action" => "add_bus.php?id=" . $id . ""];
                    }
                } else {
                    $rows = $_POST['rows'];
                    $columns = $_POST['columns'];

                    $rowss = $_POST['rowss'];
                    $columnss = $_POST['columnss'];

                    // Initialize a variable to store the seat data
                    $seatData = "";
                    $seatDatas = "";
                    $berth_type = 'LOWER';
                    $berth_types = 'UPPER';
                    // Loop through the submitted data and process it
                    for ($i = 0; $i < $rows; $i++) {
                        for ($j = 0; $j < $columns; $j++) {
                            $seatData .= $_POST['lower_' . $i . '_' . $j] . ',';
                        }
                        $seatData .= $berth_type . '$;';
                    }

                    for ($p = 0; $p < $rowss; $p++) {
                        for ($r = 0; $r < $columnss; $r++) {
                            $seatDatas .= $_POST['upper_' . $p . '_' . $r] . ',';
                        }
                        $seatDatas .= $berth_types . '$;';
                    }

                    // Remove trailing "$;" if it exists
                    if (substr($seatData, -2) === '$;') {
                        $seatData = substr($seatData, 0, -2);
                    }
                    if (substr($seatDatas, -2) === '$;') {
                        $seatDatas = substr($seatDatas, 0, -2);
                    }
                    $mergedSeatData = $seatData . '$;' . $seatDatas;

                    $elements = explode("$;", $mergedSeatData); // Split the string into elements

                    $digitCount = 0; // Initialize the count for digits

                    foreach ($elements as $element) {
                        // Split each element into subparts
                        $parts = explode(",", $element);
                        foreach ($parts as $part) {
                            // Check if the part is numeric and doesn't contain letters, or if it's greater than 9
                            if (!empty($part) && $part != "LOWER" && $part != "UPPER") {
                                $digitCount++;
                            }
                        }
                    }

                    if ($digitCount == $totl_seat) {
                        move_uploaded_file($_FILES["bus_img"]["tmp_name"], $target_file);
                        $table = "tbl_bus";
                        $field = [
                            'bus_img' => $url,
                            'title' => $title,
                            'bno' => $bno,
                            'bstatus' => $bstatus,
                            'tick_price' => $tick_price,
                            'driver_direction' => $driver_direction,
                            'decker' => $decker,
                            'lower_row' => $rows,
                            'lower_column' => $columns,
                            'upper_row' => $rowss,
                            'upper_column' => $columnss,
                            'rate' => $rate,
                            'totl_seat' => $totl_seat,
                            'seat_limit' => $seat_limit,
                            'bac' => $bac,
                            'is_sleeper' => $is_sleeper,
                            'seat_layout' => $mergedSeatData,
                            'bus_facility' => $facilitylist,
                            'offday' => $offday,
                            'driver_id' => $driver_id,
                            'operator_id' => $operator_id,
                        ];
                        $where = "where id=" . $id . "";

                        $check = trim($h->updateData($field, $table, $where));
                        if ($check == -1) {
                            $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
                        } else {
                            $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Bus Update Successfully", "message" => "Bus section!", "action" => "list_bus.php"];
                        }
                    } else {
                        $returnArr = ["ResponseCode" => "200", "Result" => "false", "title" => "Total Seat With Added Seat Total Not Matched Check Proper!!", "message" => "Bus section!", "action" => "add_bus.php?id=" . $id . ""];
                    }
                }
            }
        } else {
            if ($decker == 1) {
                $rows = $_POST['rows'];
                $columns = $_POST['columns'];

                // Initialize a variable to store the seat data
                $seatData = "";
                $berth_type = 'LOWER';
                // Loop through the submitted data and process it
                for ($i = 0; $i < $rows; $i++) {
                    for ($j = 0; $j < $columns; $j++) {
                        $seatData .= $_POST['lower_' . $i . '_' . $j] . ',';
                    }
                    $seatData .= $berth_type . '$;';
                }

                // Remove trailing "$;" if it exists
                if (substr($seatData, -2) === '$;') {
                    $seatData = substr($seatData, 0, -2);
                }

                $elements = explode("$;", $seatData); // Split the string into elements

                $digitCount = 0; // Initialize the count for digits

                foreach ($elements as $element) {
                    // Split each element into subparts
                    $parts = explode(",", $element);
                    foreach ($parts as $part) {
                        // Check if the part is numeric and doesn't contain letters, or if it's greater than 9
                        if (!empty($part) && $part != "LOWER" && $part != "UPPER") {
                            $digitCount++;
                        }
                    }
                }
                if ($digitCount == $totl_seat) {
                    $table = "tbl_bus";
                    $field = [
                        'title' => $title,
                        'bno' => $bno,
                        'bstatus' => $bstatus,
                        'tick_price' => $tick_price,
                        'driver_direction' => $driver_direction,
                        'decker' => $decker,
                        'lower_row' => $rows,
                        'lower_column' => $columns,
                        'upper_row' => "4",
                        'upper_column' => "4",
                        'rate' => $rate,
                        'totl_seat' => $totl_seat,
                        'seat_limit' => $seat_limit,
                        'bac' => $bac,
                        'is_sleeper' => $is_sleeper,
                        'seat_layout' => $seatData,
                        'bus_facility' => $facilitylist,
                        'offday' => $offday,
                        'driver_id' => $driver_id,
                        'operator_id' => $operator_id,
                    ];
                    $where = "where id=" . $id . "";

                    $check = trim($h->updateData($field, $table, $where));
                    if ($check == -1) {
                        $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
                    } else {
                        $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Bus Update Successfully", "message" => "Bus section!", "action" => "list_bus.php"];
                    }
                } else {
                    $returnArr = ["ResponseCode" => "200", "Result" => "false", "title" => "Total Seat With Added Seat Total Not Matched Check Proper!!", "message" => "Bus section!", "action" => "add_bus.php?id=" . $id . ""];
                }
            } else {
                $rows = $_POST['rows'];
                $columns = $_POST['columns'];

                $rowss = $_POST['rowss'];
                $columnss = $_POST['columnss'];

                // Initialize a variable to store the seat data
                $seatData = "";
                $seatDatas = "";
                $berth_type = 'LOWER';
                $berth_types = 'UPPER';
                // Loop through the submitted data and process it
                for ($i = 0; $i < $rows; $i++) {
                    for ($j = 0; $j < $columns; $j++) {
                        $seatData .= $_POST['lower_' . $i . '_' . $j] . ',';
                    }
                    $seatData .= $berth_type . '$;';
                }

                for ($p = 0; $p < $rowss; $p++) {
                    for ($r = 0; $r < $columnss; $r++) {
                        $seatDatas .= $_POST['upper_' . $p . '_' . $r] . ',';
                    }
                    $seatDatas .= $berth_types . '$;';
                }

                // Remove trailing "$;" if it exists
                if (substr($seatData, -2) === '$;') {
                    $seatData = substr($seatData, 0, -2);
                }
                if (substr($seatDatas, -2) === '$;') {
                    $seatDatas = substr($seatDatas, 0, -2);
                }
                $mergedSeatData = $seatData . '$;' . $seatDatas;

                $elements = explode("$;", $mergedSeatData); // Split the string into elements

                $digitCount = 0; // Initialize the count for digits

                foreach ($elements as $element) {
                    // Split each element into subparts
                    $parts = explode(",", $element);
                    foreach ($parts as $part) {
                        // Check if the part is numeric and doesn't contain letters, or if it's greater than 9
                        if (!empty($part) && $part != "LOWER" && $part != "UPPER") {
                            $digitCount++;
                        }
                    }
                }

                if ($digitCount == $totl_seat) {
                    $table = "tbl_bus";
                    $field = [
                        'title' => $title,
                        'bno' => $bno,
                        'bstatus' => $bstatus,
                        'tick_price' => $tick_price,
                        'driver_direction' => $driver_direction,
                        'decker' => $decker,
                        'lower_row' => $rows,
                        'lower_column' => $columns,
                        'upper_row' => $rowss,
                        'upper_column' => $columnss,
                        'rate' => $rate,
                        'totl_seat' => $totl_seat,
                        'seat_limit' => $seat_limit,
                        'bac' => $bac,
                        'is_sleeper' => $is_sleeper,
                        'seat_layout' => $mergedSeatData,
                        'bus_facility' => $facilitylist,
                        'offday' => $offday,
                        'driver_id' => $driver_id,
                        'operator_id' => $operator_id,
                    ];
                    $where = "where id=" . $id . "";

                    $check = trim($h->updateData($field, $table, $where));
                    if ($check == -1) {
                        $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
                    } else {
                        $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Bus Update Successfully", "message" => "Bus section!", "action" => "list_bus.php"];
                    }
                } else {
                    $returnArr = ["ResponseCode" => "200", "Result" => "false", "title" => "Total Seat With Added Seat Total Not Matched Check Proper!!", "message" => "Bus section!", "action" => "add_bus.php?id=" . $id . ""];
                }
            }
        }
    } elseif ($_POST["type"] == "add_coupon") {
        $expire_date = $_POST["expire_date"];
        $operator_id = $sdata["id"];
        $status = $_POST["status"];
        $coupon_code = $_POST["coupon_code"];
        $min_amt = $_POST["min_amt"];
        $coupon_val = $_POST["coupon_val"];
        $description = $h->real_string($_POST["description"]);
        $title = $h->real_string($_POST["title"]);
        $subtitle = $h->real_string($_POST["subtitle"]);
        $target_dir = dirname(dirname(__FILE__)) . "/images/coupon/";
        $url = "images/coupon/";
        $temp = explode(".", $_FILES["coupon_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
        if (end($temp) != "jpg" && end($temp) != "png" && end($temp) != "jpeg") {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "false",
                "title" => "Sorry, only JPG, JPEG, PNG  files are allowed !!",
                "message" => "Upload Problem!!",
                "action" => "add_coupon.php",
            ];
        } else {
            move_uploaded_file($_FILES["coupon_img"]["tmp_name"], $target_file);
            $table = "tbl_coupon";
            $field_values = ["expire_date", "status", "title", "coupon_code", "min_amt", "coupon_val", "description", "subtitle", "coupon_img", "operator_id"];
            $data_values = ["$expire_date", "$status", "$title", "$coupon_code", "$min_amt", "$coupon_val", "$description", "$subtitle", "$url", "$operator_id"];

            $check = trim($h->insertData($field_values, $data_values, $table));
            if ($check == -1) {
                $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
            } else {
                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Coupon Add Successfully!!",
                        "message" => "Coupon section!",
                        "action" => "list_coupon.php",
                    ];
                } 
            }
        }
    } elseif ($_POST["type"] == "edit_coupon") {
        $expire_date = $_POST["expire_date"];
        $operator_id = $sdata["id"];
        $id = $_POST["id"];
        $status = $_POST["status"];
        $coupon_code = $_POST["coupon_code"];
        $min_amt = $_POST["min_amt"];
        $coupon_val = $_POST["coupon_val"];
        $description = $h->real_string($_POST["description"]);
        $title = $h->real_string($_POST["title"]);
        $subtitle = $h->real_string($_POST["subtitle"]);
        $target_dir = dirname(dirname(__FILE__)) . "/images/coupon/";
        $url = "images/coupon/";
        $temp = explode(".", $_FILES["coupon_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
        if ($_FILES["coupon_img"]["name"] != "") {
            if (end($temp) != "jpg" && end($temp) != "png" && end($temp) != "jpeg") {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "false",
                    "title" => "Sorry, only JPG, JPEG, PNG  files are allowed !!",
                    "message" => "Upload Problem!!",
                    "action" => "add_coupon.php?id=" . $id . "",
                ];
            } else {
                move_uploaded_file($_FILES["coupon_img"]["tmp_name"], $target_file);
                $table = "tbl_coupon";
                $field = [
                    "status" => $status,
                    "coupon_img" => $url,
                    "title" => $title,
                    "coupon_code" => $coupon_code,
                    "min_amt" => $min_amt,
                    "coupon_val" => $coupon_val,
                    "description" => $description,
                    "subtitle" => $subtitle,
                    "expire_date" => $expire_date,
                    "operator_id" => $operator_id,
                ];
                $where = "where id=" . $id . "";

                $check = trim($h->updateData($field, $table, $where));
                if ($check == -1) {
                    $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
                } else {
                    if ($check == 1) {
                        $returnArr = [
                            "ResponseCode" => "200",
                            "Result" => "true",
                            "title" => "Coupon Update Successfully!!",
                            "message" => "Coupon section!",
                            "action" => "list_coupon.php",
                        ];
                    } 
                }
            }
        } else {
            $table = "tbl_coupon";
            $field = [
                "status" => $status,
                "title" => $title,
                "coupon_code" => $coupon_code,
                "min_amt" => $min_amt,
                "coupon_val" => $coupon_val,
                "description" => $description,
                "subtitle" => $subtitle,
                "expire_date" => $expire_date,
                "operator_id" => $operator_id,
            ];
            $where = "where id=" . $id . "";

            $check = trim($h->updateData($field, $table, $where));
            if ($check == -1) {
                $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
            } else {
                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Coupon Update Successfully!!",
                        "message" => "Coupon section!",
                        "action" => "list_coupon.php",
                    ];
                } 
            }
        }
    } elseif ($_POST['type'] == "edit_bus_operator") {
        $probus_name = $h->real_string($_POST['title']);
        $status = $_POST['status'];
        $rate = $_POST['rate'];
        $id = $_POST['id'];
        $agent_commission = $_POST['agent_commission'];
        $admin_commission = $_POST['admin_commission'];
        $email = $h->real_string($_POST['email']);
        $password = $h->real_string($_POST['password']);
        $address = $h->real_string($_POST['address']);
        $lats = $_POST['lats'];
        $longs = $_POST['longs'];
        $bank_name = $_POST['bank_name'];
        $ifsc_code = $_POST['ifsc_code'];
        $receipt_name = $_POST['receipt_name'];
        $acc_no = $_POST['acc_no'];
        $pay_id = $_POST['pay_id'];
        $upi_id = $_POST['upi_id'];
        $target_dir = dirname(dirname(__FILE__)) . "/images/busoperator/";
        $url = "images/busoperator/";
        $temp = explode(".", $_FILES["op_img"]["name"]);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);

        if ($_FILES["op_img"]["name"] != "") {
            if (end($temp) != "jpg" && end($temp) != "png" && end($temp) != "jpeg") {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "false",
                    "title" => "Sorry, only JPG, JPEG, PNG  files are allowed !!",
                    "message" => "Upload Problem!!",
                    "action" => "add_bus_operator.php?id=" . $id . "",
                ];
            } else {
                move_uploaded_file($_FILES["op_img"]["tmp_name"], $target_file);

                $table = "tbl_bus_operator";
                $field = [
                    "bus_name" => $probus_name,
                    "op_img" => $url,
                    "status" => $status,
                    "rate" => $rate,
                    "agent_commission" => $agent_commission,
                    "admin_commission" => $admin_commission,
                    "email" => $email,
                    "password" => $password,
                    "address" => $address,
                    "lats" => $lats,
                    "longs" => $longs,
                    "bank_name" => $bank_name,
                    "ifsc_code" => $ifsc_code,
                    "receipt_name" => $receipt_name,
                    "acc_no" => $acc_no,
                    "pay_id" => $pay_id,
                    "upi_id" => $upi_id,
                ];
                $where = "where id=" . $id . "";

                $check = trim($h->updateData($field, $table, $where));
                if ($check == -1) {
                    $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
                } else {
                    if ($check == 1) {
                        $returnArr = [
                            "ResponseCode" => "200",
                            "Result" => "true",
                            "title" => "Bus Operator Update Successfully!!",
                            "message" => "Bus Operator section!",
                            "action" => "list_bus_operator.php",
                        ];
                    } 
                }
            }
        } else {
            $table = "tbl_bus_operator";
            $field = [
                "bus_name" => $probus_name,
                "status" => $status,
                "rate" => $rate,
                "agent_commission" => $agent_commission,
                "admin_commission" => $admin_commission,
                "email" => $email,
                "password" => $password,
                "address" => $address,
                "lats" => $lats,
                "longs" => $longs,
                "bank_name" => $bank_name,
                "ifsc_code" => $ifsc_code,
                "receipt_name" => $receipt_name,
                "acc_no" => $acc_no,
                "pay_id" => $pay_id,
                "upi_id" => $upi_id,
            ];
            $where = "where id=" . $id . "";

            $check = trim($h->updateData($field, $table, $where));
            if ($check == -1) {
                $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
            } else {
                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Bus Operator Update Successfully!!",
                        "message" => "Bus Operator section!",
                        "action" => "list_bus_operator.php",
                    ];
                } 
            }
        }
    } elseif ($_POST['type'] == "add_bus_operator") {
        $probus_name = $h->real_string($_POST['title']);
        $status = $_POST['status'];
        $rate = $_POST['rate'];
        $agent_commission = $_POST['agent_commission'];
        $admin_commission = $_POST['admin_commission'];
        $email = $h->real_string($_POST['email']);
        $password = $h->real_string($_POST['password']);
        $address = $h->real_string($_POST['address']);
        $lats = $_POST['lats'];
        $longs = $_POST['longs'];
        $bank_name = $_POST['bank_name'];
        $ifsc_code = $_POST['ifsc_code'];
        $receipt_name = $_POST['receipt_name'];
        $acc_no = $_POST['acc_no'];
        $pay_id = $_POST['pay_id'];
        $upi_id = $_POST['upi_id'];
        $target_dir = dirname(dirname(__FILE__)) . "/images/busoperator/";
        $url = "images/busoperator/";
        $temp = explode(".", $_FILES["op_img"]["name"]);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
        if (end($temp) != "jpg" && end($temp) != "png" && end($temp) != "jpeg") {
            $returnArr = ["ResponseCode" => "200", "Result" => "false", "title" => "Sorry, only JPG, JPEG, PNG  files are allowed !!", "message" => "Upload Problem!!", "action" => "add_bus_operator.php"];
        } else {
            move_uploaded_file($_FILES["op_img"]["tmp_name"], $target_file);
            $table = "tbl_bus_operator";
            $field_values = ["bus_name", "op_img", "status", "rate", "agent_commission", "admin_commission", "email", "password", "address", "lats", "longs", "bank_name", "ifsc_code", "receipt_name", "acc_no", "pay_id", "upi_id"];
            $data_values = [
                "$probus_name",
                "$url",
                "$status",
                "$rate",
                "$agent_commission",
                "$admin_commission",
                "$email",
                "$password",
                "$address",
                "$lats",
                "$longs",
                "$bank_name",
                "$ifsc_code",
                "$receipt_name",
                "$acc_no",
                "$pay_id",
                "$upi_id",
            ];

            $check = trim($h->insertData($field_values, $data_values, $table));
            if ($check == -1) {
                $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
            } else {
                if ($check == 1) {
                    $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Bus Operator Add Successfully", "message" => "Bus section!", "action" => "add_bus_operator.php"];
                } 
            }
        }
    } elseif ($_POST['type'] == "add_bus") {
        $title = $h->real_string($_POST['title']);
        $bno = $h->real_string($_POST['bno']);
        $tick_price = $h->real_string($_POST['tick_price']);
        $driver_direction = $h->real_string($_POST['driver_direction']);
        $decker = $_POST['decker'];
        $operator_id = $sdata['id'];
        $driver_id = $_POST['driver_id'];
        $bstatus = $_POST['bstatus'];
        $rate = $_POST['rate'];
        $totl_seat = $_POST['totl_seat'];
        $seat_limit = $_POST['seat_limit'];
        $bac = $_POST['bac'];
        $is_sleeper = $_POST['is_sleeper'];
        $facilitylist = empty($_POST['facilitylist']) ? "" : implode(',', $_POST['facilitylist']);
        $offday = empty($_POST['offday']) ? "" : implode(',', $_POST['offday']);
        $target_dir = dirname(dirname(__FILE__)) . "/images/bus/";
        $url = "images/bus/";
        $temp = explode(".", $_FILES["bus_img"]["name"]);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
        if (end($temp) != "jpg" && end($temp) != "png" && end($temp) != "jpeg") {
            $returnArr = ["ResponseCode" => "200", "Result" => "false", "title" => "Sorry, only JPG, JPEG, PNG  files are allowed !!", "message" => "Upload Problem!!", "action" => "add_bus.php"];
        } else {
            if ($decker == 1) {
                $rows = $_POST['rows'];
                $columns = $_POST['columns'];

                // Initialize a variable to store the seat data
                $seatData = "";
                $berth_type = 'LOWER';
                // Loop through the submitted data and process it
                for ($i = 0; $i < $rows; $i++) {
                    for ($j = 0; $j < $columns; $j++) {
                        $seatData .= $_POST['lower_' . $i . '_' . $j] . ',';
                    }
                    $seatData .= $berth_type . '$;';
                }

                // Remove trailing "$;" if it exists
                if (substr($seatData, -2) === '$;') {
                    $seatData = substr($seatData, 0, -2);
                }

                $elements = explode("$;", $seatData); // Split the string into elements

                $digitCount = 0; // Initialize the count for digits

                foreach ($elements as $element) {
                    // Split each element into subparts
                    $parts = explode(",", $element);
                    foreach ($parts as $part) {
                        // Check if the part is numeric and doesn't contain letters, or if it's greater than 9
                        if (!empty($part) && $part != "LOWER" && $part != "UPPER") {
                            $digitCount++;
                        }
                    }
                }
                if ($digitCount == $totl_seat) {
                    move_uploaded_file($_FILES["bus_img"]["tmp_name"], $target_file);
                    $table = "tbl_bus";
                    $field_values = [
                        "bus_img",
                        "title",
                        "bno",
                        "tick_price",
                        "driver_direction",
                        "decker",
                        "lower_row",
                        "lower_column",
                        "upper_row",
                        "upper_column",
                        "bstatus",
                        "rate",
                        "totl_seat",
                        "seat_limit",
                        "bac",
                        "is_sleeper",
                        "seat_layout",
                        "bus_facility",
                        "offday",
                        "driver_id",
                        "operator_id",
                    ];
                    $data_values = [
                        "$url",
                        "$title",
                        "$bno",
                        "$tick_price",
                        "$driver_direction",
                        "$decker",
                        "$rows",
                        "$columns",
                        "4",
                        "4",
                        "$bstatus",
                        "$rate",
                        "$totl_seat",
                        "$seat_limit",
                        "$bac",
                        "$is_sleeper",
                        "$seatData",
                        "$facilitylist",
                        "$offday",
                        "$driver_id",
                        "$operator_id",
                    ];

                    $check = trim($h->insertData($field_values, $data_values, $table));
                    if ($check == -1) {
                        $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
                    } else {
                        $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Bus Add Successfully", "message" => "Bus section!", "action" => "add_bus.php"];
                    }
                } else {
                    $returnArr = ["ResponseCode" => "200", "Result" => "false", "title" => "Total Seat With Added Seat Total Not Matched Check Proper!!", "message" => "Bus section!", "action" => "add_bus.php"];
                }
            } else {
                $rows = $_POST['rows'];
                $columns = $_POST['columns'];

                $rowss = $_POST['rowss'];
                $columnss = $_POST['columnss'];

                // Initialize a variable to store the seat data
                $seatData = "";
                $seatDatas = "";
                $berth_type = 'LOWER';
                $berth_types = 'UPPER';
                // Loop through the submitted data and process it
                for ($i = 0; $i < $rows; $i++) {
                    for ($j = 0; $j < $columns; $j++) {
                        $seatData .= $_POST['lower_' . $i . '_' . $j] . ',';
                    }
                    $seatData .= $berth_type . '$;';
                }

                for ($p = 0; $p < $rowss; $p++) {
                    for ($r = 0; $r < $columnss; $r++) {
                        $seatDatas .= $_POST['upper_' . $p . '_' . $r] . ',';
                    }
                    $seatDatas .= $berth_types . '$;';
                }

                // Remove trailing "$;" if it exists
                if (substr($seatData, -2) === '$;') {
                    $seatData = substr($seatData, 0, -2);
                }
                if (substr($seatDatas, -2) === '$;') {
                    $seatDatas = substr($seatDatas, 0, -2);
                }
                $mergedSeatData = $seatData . '$;' . $seatDatas;

                $elements = explode("$;", $mergedSeatData); // Split the string into elements

                $digitCount = 0; // Initialize the count for digits

                foreach ($elements as $element) {
                    // Split each element into subparts
                    $parts = explode(",", $element);
                    foreach ($parts as $part) {
                        // Check if the part is numeric and doesn't contain letters, or if it's greater than 9
                        if (!empty($part) && $part != "LOWER" && $part != "UPPER") {
                            $digitCount++;
                        }
                    }
                }

                if ($digitCount == $totl_seat) {
                    move_uploaded_file($_FILES["bus_img"]["tmp_name"], $target_file);
                    $table = "tbl_bus";
                    $field_values = [
                        "bus_img",
                        "title",
                        "bno",
                        "tick_price",
                        "driver_direction",
                        "decker",
                        "lower_row",
                        "lower_column",
                        "upper_row",
                        "upper_column",
                        "bstatus",
                        "rate",
                        "totl_seat",
                        "seat_limit",
                        "bac",
                        "is_sleeper",
                        "seat_layout",
                        "bus_facility",
                        "offday",
                        "driver_id",
                        "operator_id",
                    ];
                    $data_values = [
                        "$url",
                        "$title",
                        "$bno",
                        "$tick_price",
                        "$driver_direction",
                        "$decker",
                        "$rows",
                        "$columns",
                        "$rowss",
                        "$columnss",
                        "$bstatus",
                        "$rate",
                        "$totl_seat",
                        "$seat_limit",
                        "$bac",
                        "$is_sleeper",
                        "$mergedSeatData",
                        "$facilitylist",
                        "$offday",
                        "$driver_id",
                        "$operator_id",
                    ];

                    $check = trim($h->insertData($field_values, $data_values, $table));
                    if ($check == -1) {
                        $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
                    } else {
                        $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Bus Add Successfully", "message" => "Bus section!", "action" => "add_bus.php"];
                    }
                } else {
                    $returnArr = ["ResponseCode" => "200", "Result" => "false", "title" => "Total Seat With Added Seat Total Not Matched Check Proper!!", "message" => "Bus section!", "action" => "add_bus.php"];
                }
            }
        }
    } elseif ($_POST['type'] == 'edit_code') {
        $okey = $_POST['status'];
        $title = $h->real_string($_POST['title']);
        $id = $_POST['id'];
        $table = "tbl_code";
        $field = ['status' => $okey, 'ccode' => $title];
        $where = "where id=" . $id . "";

        $check = trim($h->updateData($field, $table, $where));
        if ($check == -1) {
            $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
        } else {
            if ($check == 1) {
                $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Country Code Update Successfully!!", "message" => "Country Code section!", "action" => "list_code.php"];
            } 
        }
    } elseif ($_POST['type'] == 'add_page') {
        $ctitle = $h->real_string($_POST['ctitle']);
        $cstatus = $_POST['cstatus'];
        $cdesc = $h->real_string($_POST['cdesc']);
        $table = "tbl_page";

        $field_values = ["description", "status", "title"];
        $data_values = ["$cdesc", "$cstatus", "$ctitle"];

        $check = trim($h->insertData($field_values, $data_values, $table));
        if ($check == -1) {
            $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
        } else {
            if ($check == 1) {
                $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Page Add Successfully!!", "message" => "Page section!", "action" => "list_page.php"];
            } 
        }
    } elseif ($_POST['type'] == 'edit_page') {
        $id = $_POST['id'];
        $ctitle = $h->real_string($_POST['ctitle']);
        $cstatus = $_POST['cstatus'];
        $cdesc = $h->real_string($_POST['cdesc']);

        $table = "tbl_page";
        $field = ['description' => $cdesc, 'status' => $cstatus, 'title' => $ctitle];
        $where = "where id=" . $id . "";

        $check = trim($h->updateData($field, $table, $where));
        if ($check == -1) {
            $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
        } else {
            if ($check == 1) {
                $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Page Update Successfully!!", "message" => "Page section!", "action" => "list_page.php"];
            } 
        }
    } elseif ($_POST['type'] == 'edit_payment') {
        $attributes = $h->real_string($_POST['p_attr']);
        $ptitle = $h->real_string($_POST['ptitle']);
        $okey = $_POST['status'];
        $id = $_POST['id'];
        $p_show = $_POST['p_show'];
        $target_dir = dirname(dirname(__FILE__)) . "/images/payment/";
        $url = "images/payment/";
        $temp = explode(".", $_FILES["cat_img"]["name"]);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
        if ($_FILES["cat_img"]["name"] != '') {
            if (end($temp) != "jpg" && end($temp) != "png" && end($temp) != "jpeg") {
                $returnArr = ["ResponseCode" => "200", "Result" => "false", "title" => "Sorry, only JPG, JPEG, PNG  files are allowed !!", "message" => "Upload Problem!!", "action" => "edit_payment.php?id=" . $id . ""];
            } else {
                move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
                $table = "tbl_payment_list";
                $field = ['status' => $okey, 'img' => $url, 'attributes' => $attributes, 'subtitle' => $ptitle, 'p_show' => $p_show];
                $where = "where id=" . $id . "";

                $check = trim($h->updateData($field, $table, $where));
                if ($check == -1) {
                    $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
                } else {
                    if ($check == 1) {
                        $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Payment Gateway Update Successfully!!", "message" => "Payment Gateway section!", "action" => "paymentlist.php"];
                    } 
                }
            }
        } else {
            $table = "tbl_payment_list";
            $field = ['status' => $okey, 'attributes' => $attributes, 'subtitle' => $ptitle, 'p_show' => $p_show];
            $where = "where id=" . $id . "";

            $check = trim($h->updateData($field, $table, $where));
            if ($check == -1) {
                $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
            } else {
                if ($check == 1) {
                    $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Payment Gateway Update Successfully!!", "message" => "Payment Gateway section!", "action" => "paymentlist.php"];
                } 
            }
        }
    } elseif ($_POST['type'] == 'add_faq') {
        $question = $h->real_string($_POST['question']);
        $answer = $h->real_string($_POST['answer']);
        $okey = $_POST['status'];

        $table = "tbl_faq";
        $field_values = ["question", "answer", "status"];
        $data_values = ["$question", "$answer", "$okey"];

        $check = trim($h->insertData($field_values, $data_values, $table));
        if ($check == -1) {
            $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
        } else {
            if ($check == 1) {
                $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Faq Add Successfully!!", "message" => "Faq section!", "action" => "list_faq.php"];
            } 
        }
    } elseif ($_POST['type'] == 'add_policy') {
        $hour = $h->real_string($_POST['hour']);
        $rmat = $h->real_string($_POST['rmat']);
        $okey = $_POST['status'];

        $table = "tbl_policy";
        $field_values = ["hour", "rmat"];
        $data_values = ["$hour", "$rmat"];

        $check = trim($h->insertData($field_values, $data_values, $table));
        if ($check == -1) {
            $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
        } else {
            if ($check == 1) {
                $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Cancellation Policy Add Successfully!!", "message" => "Policy section!", "action" => "list_policy.php"];
            } 
        }
    } elseif ($_POST['type'] == 'edit_policy') {
        $hour = $h->real_string($_POST['hour']);
        $rmat = $h->real_string($_POST['rmat']);
        $okey = $_POST['status'];
        $id = $_POST['id'];

        $table = "tbl_policy";
        $field = ['hour' => $hour, 'rmat' => $rmat];
        $where = "where id=" . $id . "";

        $check = trim($h->updateData($field, $table, $where));
        if ($check == -1) {
            $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
        } else {
            if ($check == 1) {
                $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Cancellation Policy Update Successfully!!", "message" => "Policy section!", "action" => "list_policy.php"];
            } 
        }
    } elseif ($_POST['type'] == 'edit_faq') {
        $question = $h->real_string($_POST['question']);
        $answer = $h->real_string($_POST['answer']);
        $okey = $_POST['status'];
        $id = $_POST['id'];

        $table = "tbl_faq";
        $field = ['question' => $question, 'status' => $okey, 'answer' => $answer];
        $where = "where id=" . $id . "";

        $check = trim($h->updateData($field, $table, $where));
        if ($check == -1) {
            $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
        } else {
            if ($check == 1) {
                $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Faq Update Successfully!!", "message" => "Faq section!", "action" => "list_faq.php"];
            } 
        }
    } elseif ($_POST['type'] == 'edit_profile') {
        $dname = $_POST['username'];
        $dsname = $_POST['password'];
        $id = $_POST['id'];
        $table = "admin";
        $field = ['username' => $dname, 'password' => $dsname];
        $where = "where id=" . $id . "";

        $check = trim($h->updateData($field, $table, $where));
        if ($check == -1) {
            $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
        } else {
            if ($check == 1) {
                $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Profile Update Successfully!!", "message" => "Profile  section!", "action" => "profile.php"];
            } 
        }
    } elseif ($_POST['type'] == 'edit_setting') {
        $webname = $h->real_string($_POST['webname']);
        $timezone = $_POST['timezone'];
        $currency = $_POST['currency'];
        $id = $_POST['id'];
        $tax = $_POST['tax'];
        $agent_limit = $_POST['agent_limit'];
        $one_key = $_POST['one_key'];
        $one_hash = $_POST['one_hash'];
        $agent_status = $_POST['agent_status'];
        $scredit = $_POST['scredit'];
        $rcredit = $_POST['rcredit'];
		$sms_type = $_POST['sms_type'];
			$auth_key = $_POST['auth_key'];
			$otp_id = $_POST['otp_id'];
			$acc_id = $_POST['acc_id'];
			$auth_token = $_POST['auth_token'];
			$twilio_number = $_POST['twilio_number'];
			$otp_auth = $_POST['otp_auth'];

        $target_dir = dirname(dirname(__FILE__)) . "/images/website/";
        $url = "images/website/";
        $temp = explode(".", $_FILES["weblogo"]["name"]);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
        if ($_FILES["weblogo"]["name"] != '') {
            if (end($temp) != "jpg" && end($temp) != "png" && end($temp) != "jpeg") {
                $returnArr = ["ResponseCode" => "200", "Result" => "false", "title" => "Sorry, only JPG, JPEG, PNG  files are allowed !!", "message" => "Upload Problem!!", "action" => "setting.php"];
            } else {
                move_uploaded_file($_FILES["weblogo"]["tmp_name"], $target_file);
                $table = "tbl_setting";
                $field = [
                    'timezone' => $timezone,
                    'agent_limit' => $agent_limit,
                    'agent_status' => $agent_status,
                    'weblogo' => $url,
                    'webname' => $webname,
                    'currency' => $currency,
                    'one_key' => $one_key,
                    'one_hash' => $one_hash,
                    'scredit' => $scredit,
                    'rcredit' => $rcredit,
                    'tax' => $tax,
					'otp_auth'=>$otp_auth,
					'twilio_number'=>$twilio_number,
					'auth_token'=>$auth_token,
					'acc_id'=>$acc_id,
					'otp_id'=>$otp_id,
					'auth_key'=>$auth_key,
					'sms_type'=>$sms_type
                ];
                $where = "where id=" . $id . "";

                $check = trim($h->updateData($field, $table, $where));
                if ($check == -1) {
                    $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
                } else {
                    if ($check == 1) {
                        $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Setting Update Successfully!!", "message" => "Setting section!", "action" => "setting.php"];
                    } 
                }
            }
        } else {
            $table = "tbl_setting";
            $field = [
                'timezone' => $timezone,
                'agent_limit' => $agent_limit,
                'agent_status' => $agent_status,
                'webname' => $webname,
                'currency' => $currency,
                'one_key' => $one_key,
                'one_hash' => $one_hash,
                'scredit' => $scredit,
                'rcredit' => $rcredit,
                'tax' => $tax,
					'otp_auth'=>$otp_auth,
					'twilio_number'=>$twilio_number,
					'auth_token'=>$auth_token,
					'acc_id'=>$acc_id,
					'otp_id'=>$otp_id,
					'auth_key'=>$auth_key,
					'sms_type'=>$sms_type
            ];
            $where = "where id=" . $id . "";

            $check = trim($h->updateData($field, $table, $where));
            if ($check == -1) {
                $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
            } else {
                if ($check == 1) {
                    $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Setting Update Successfully!!", "message" => "Offer section!", "action" => "setting.php"];
                } 
            }
        }
    } elseif ($_POST["type"] == "add_city") {
        $okey = $_POST["status"];
        $title = $h->real_string($_POST["title"]);

        $table = "tbl_city";
        $field_values = ["status", "title"];
        $data_values = ["$okey", "$title"];

        $check = trim($h->insertData($field_values, $data_values, $table));
        if ($check == -1) {
            $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
        } else {
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "City Add Successfully!!",
                    "message" => "City section!",
                    "action" => "list_city.php",
                ];
            } 
        }
    } elseif ($_POST["type"] == "add_banner") {
        $okey = $_POST["status"];

        $target_dir = dirname(dirname(__FILE__)) . "/images/banner/";
        $url = "images/banner/";
        $temp = explode(".", $_FILES["cat_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
        if (end($temp) != "jpg" && end($temp) != "png" && end($temp) != "jpeg") {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "false",
                "title" => "Sorry, only JPG, JPEG, PNG  files are allowed !!",
                "message" => "Upload Problem!!",
                "action" => "add_banner.php",
            ];
        } else {
            move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
            $table = "tbl_banner";
            $field_values = ["img", "status"];
            $data_values = ["$url", "$okey"];

            $check = trim($h->insertData($field_values, $data_values, $table));
            if ($check == -1) {
                $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
            } else {
                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Banner Add Successfully!!",
                        "message" => "Banner section!",
                        "action" => "list_banner.php",
                    ];
                } 
            }
        }
    } elseif ($_POST["type"] == "add_facility") {
        $okey = $_POST["status"];
        $title = $h->real_string($_POST["title"]);
        $target_dir = dirname(dirname(__FILE__)) . "/images/facility/";
        $url = "images/facility/";
        $temp = explode(".", $_FILES["cat_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
        if (end($temp) != "jpg" && end($temp) != "png" && end($temp) != "jpeg") {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "false",
                "title" => "Sorry, only JPG, JPEG, PNG  files are allowed !!",
                "message" => "Upload Problem!!",
                "action" => "add_facility.php",
            ];
        } else {
            move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
            $table = "tbl_facility";
            $field_values = ["img", "status", "title"];
            $data_values = ["$url", "$okey", "$title"];

            $check = trim($h->insertData($field_values, $data_values, $table));
            if ($check == -1) {
                $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
            } else {
                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Facility Add Successfully!!",
                        "message" => "Facility section!",
                        "action" => "list_facility.php",
                    ];
                } 
            }
        }
    } elseif ($_POST["type"] == "faq_delete") {
        $id = $_POST["id"];
        $table = "tbl_faq";
        $where = "where id=" . $id . "";

        $check = trim($h->deleteData($where, $table));
        if ($check == -1) {
            $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
        } else {
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "FAQ Delete Successfully!!",
                    "message" => "FAQ section!",
                    "action" => "list_faq.php",
                ];
            } 
        }
    } elseif ($_POST["type"] == "add_subroute") {
        $operator_id = $sdata['id'];
        $board_id = $_POST['board_id'];
        $rpoint = $_POST['rpoint'];
        $btime = $_POST['btime'];
        $status = $_POST['status'];
        // Check for duplicate values in the rpoint array
        $duplicateValues = array_diff_assoc($rpoint, array_unique($rpoint));

        if (!empty($duplicateValues)) {
            // Duplicates found, return a JSON response
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "false",
                "title" => "Duplicate values in the Sub Route Point.",
                "message" => "Duplicate values in the Sub Route Point.",
                "action" => "add_pick_time.php",
            ];
        } else {
            $check = $h->queryfire("select * from tbl_sub_route_time where board_id=" . $board_id . "")->num_rows;
            if ($check != 0) {
                $returnArr = ["ResponseCode" => "200", "Result" => "false", "title" => "Alredy Inserted Please Update Data!!", "message" => "Operation Duplicate DISABLED!!", "action" => "add_pick_time.php"];
            } else {
                // Loop through the boarding points and times
                for ($i = 0; $i < count($rpoint); $i++) {
                    $point_id = $rpoint[$i];
                    $ptime = $btime[$i];
                    $statuss = $status[$i];

                    // Insert each point and time into the database
                    $table = "tbl_sub_route_time";
                    $field_values = ["board_id", "point_id", "ptime", "status", "operator_id"];
                    $data_values = ["$board_id", "$point_id", "$ptime", "$statuss", "$operator_id"];

                    $check = trim($h->insertData($field_values, $data_values, $table));
                }
                if ($check == -1) {
                    $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
                } else {
                    if ($check == 1) {
                        $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Pick up Sub Route Add Successfully!!", "message" => "Pick up Sub Route section!", "action" => "add_pick_time.php"];
                    } 
                }
            }
        }
    } elseif ($_POST["type"] == "add_drop_subroute") {
        $board_id = $_POST['board_id'];
        $rpoint = $_POST['rpoint'];
        $operator_id = $sdata['id'];
        $btime = $_POST['btime'];
        $status = $_POST['status'];
        // Check for duplicate values in the rpoint array
        $duplicateValues = array_diff_assoc($rpoint, array_unique($rpoint));

        if (!empty($duplicateValues)) {
            // Duplicates found, return a JSON response
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "false",
                "title" => "Duplicate values in the Sub Route Point.",
                "message" => "Duplicate values in the Sub Route Point.",
                "action" => "add_drop_time.php",
            ];
        } else {
            $check = $h->queryfire("select * from tbl_drop_sub_route where board_id=" . $board_id . "")->num_rows;
            if ($check != 0) {
                $returnArr = ["ResponseCode" => "200", "Result" => "false", "title" => "Alredy Inserted Please Update Data!!", "message" => "Operation Duplicate DISABLED!!", "action" => "add_drop_time.php"];
            } else {
                // Loop through the boarding points and times
                for ($i = 0; $i < count($rpoint); $i++) {
                    $point_id = $rpoint[$i];
                    $ptime = $btime[$i];
                    $statuss = $status[$i];

                    // Insert each point and time into the database
                    $table = "tbl_drop_sub_route";
                    $field_values = ["board_id", "point_id", "ptime", "status", "operator_id"];
                    $data_values = ["$board_id", "$point_id", "$ptime", "$statuss", "$operator_id"];

                    $check = trim($h->insertData($field_values, $data_values, $table));
                }
                if ($check == -1) {
                    $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
                } else {
                    if ($check == 1) {
                        $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Drop Sub Route Add Successfully!!", "message" => "Drop Sub Route section!", "action" => "add_drop_time.php"];
                    } 
                }
            }
        }
    } elseif ($_POST["type"] == "add_bdpoints") {
        $probus_id = $_POST['bus_id'];
        $operator_id = $sdata['id'];
        $check = $h->queryfire("select * from tbl_board_drop_points where bus_id=" . $probus_id . "")->num_rows;
        if ($check != 0) {
            $returnArr = ["ResponseCode" => "200", "Result" => "false", "title" => "Alredy Inserted Please Update Data!!", "message" => "Operation Duplicate DISABLED!!", "action" => "add_board_drop.php"];
        } else {
            $boarding_points = $_POST['bpoint'];
            $boarding_times = $_POST['btime'];
            $dropping_points = $_POST['dpoint'];
            $dropping_times = $_POST['dtime'];
            $differncetimes = $_POST['differncetime'];

            // Loop through the boarding points and times
            for ($i = 0; $i < count($boarding_points); $i++) {
                $boarding_point = $boarding_points[$i];
                $boarding_time = $boarding_times[$i];
                $dropping_point = $dropping_points[$i];
                $dropping_time = $dropping_times[$i];
                $differncetime = $differncetimes[$i];
                // Insert each point and time into the database
                $table = "tbl_board_drop_points";
                $field_values = ["bus_id", "bpoint", "btime", "dpoint", "dtime", "differncetime", "operator_id"];
                $data_values = ["$probus_id", "$boarding_point", "$boarding_time", "$dropping_point", "$dropping_time", "$differncetime", "$operator_id"];

                $check = trim($h->insertData($field_values, $data_values, $table));
            }
            if ($check == -1) {
                $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
            } else {
                if ($check == 1) {
                    $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Points Add Successfully!!", "message" => "Points section!", "action" => "add_board_drop.php"];
                } 
            }
        }
    } elseif ($_POST["type"] == "edit_bdpoints") {
        $probus_id = $_POST['hidden_bus_id'];
        $id = $_POST['id'];
        $operator_id = $sdata['id'];
        $exist_boarding_points = $_POST['exist_bpoint'];
        $exist_boarding_times = $_POST['exist_btime'];
        $exist_dropping_points = $_POST['exist_dpoint'];
        $exist_dropping_times = $_POST['exist_dtime'];
        $exist_differncetimes = $_POST['exist_differncetime'];

        for ($i = 0; $i < count($exist_boarding_points); $i++) {
            $boarding_point = $exist_boarding_points[$i];
            $boarding_time = $exist_boarding_times[$i];
            $dropping_point = $exist_dropping_points[$i];
            $dropping_time = $exist_dropping_times[$i];
            $differncetime = $exist_differncetimes[$i];
            $idv = $id[$i];
            $table = "tbl_board_drop_points";
            $field = ['bpoint' => $boarding_point, 'btime' => $boarding_time, 'dpoint' => $dropping_point, 'dtime' => $dropping_time, 'differncetime' => $differncetime, 'operator_id' => $operator_id];
            $where = "where id=" . $idv . "";

            $check = trim($h->updateData($field, $table, $where));
        }

        $new_boarding_points = $_POST['new_bpoint'];
        $new_boarding_times = $_POST['new_btime'];
        $new_dropping_points = $_POST['new_dpoint'];
        $new_dropping_times = $_POST['new_dtime'];
        $new_differncetimes = $_POST['new_differncetime'];
        if (is_array($new_boarding_points) && is_array($new_boarding_times) && is_array($new_dropping_points) && is_array($new_dropping_times)) {
            $count = count($new_boarding_points);

            for ($i = 0; $i < $count; $i++) {
                $boarding_point = $new_boarding_points[$i];
                $boarding_time = $new_boarding_times[$i];
                $dropping_point = $new_dropping_points[$i];
                $dropping_time = $new_dropping_times[$i];
                $differncetime = $new_differncetimes[$i];

                // Insert each point and time into the database
                $table = "tbl_board_drop_points";
                $field_values = ["bus_id", "bpoint", "btime", "dpoint", "dtime", "differncetime", "operator_id"];
                $data_values = ["$probus_id", "$boarding_point", "$boarding_time", "$dropping_point", "$dropping_time", "$differncetime", "$operator_id"];

                $checks = trim($h->insertData($field_values, $data_values, $table));
            }
        }
        if ($check == -1) {
            $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
        } else {
            if ($check == 1) {
                $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Points Update Successfully!!", "message" => "Points section!", "action" => "list_board_drop.php"];
            } 
        }
    } elseif ($_POST["type"] == "add_points") {
        $title = $h->real_string($_POST['title']);
        $city_id = $h->real_string($_POST['city_id']);
        $status = $_POST['status'];
        $address = $h->real_string($_POST['address']);
        $mobile = $h->real_string($_POST['mobile']);
        $lats = $h->real_string($_POST['lats']);
        $longs = $h->real_string($_POST['longs']);

        $table = "tbl_points";
        $field_values = ["title", "city_id", "status", "address", "mobile", "longs", "lats"];
        $data_values = ["$title", "$city_id", "$status", "$address", "$mobile", "$longs", "$lats"];

        $check = trim($h->insertData($field_values, $data_values, $table));
        if ($check == -1) {
            $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
        } else {
            if ($check == 1) {
                $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Points Add Successfully!!", "message" => "Points section!", "action" => "list_drop_pick.php"];
            } 
        }
    } elseif ($_POST['type'] == 'edit_subroute') {
        $board_id = $_POST['hidden_boarding_id'];
        $id = $_POST['id'];
        $operator_id = $sdata['id'];
        $exist_rpoint = $_POST['exist_rpoint'];
        $exist_btime = $_POST['exist_btime'];
        $exist_status = $_POST['exist_status'];
        $new_rpoint = $_POST['new_rpoint'];
        $new_btime = $_POST['new_btime'];
        $new_status = $_POST['new_status'];
        function hasDuplicates($array)
        {
            return count($array) !== count(array_unique($array));
        }

        if (!empty($new_rpoint)) {
            // Combine both arrays into a single array
            $combinedRPoint = array_merge($exist_rpoint, $new_rpoint);
        } else {
            // If $new_rpoint is empty or null, just use $exist_rpoint
            $combinedRPoint = $exist_rpoint;
        }

        // Check for duplicates in the combined array
        $duplicateCombinedRPoint = hasDuplicates($combinedRPoint);

        if ($duplicateCombinedRPoint) {
            // Return a JSON response indicating that duplicates are not allowed
            $returnArr = [
                "ResponseCode" => "200", // You can use an appropriate HTTP status code
                "Result" => "false",
                "title" => "Duplicate values are not allowed for Sub Route Points.",
                "action" => "list_pick_time.php",
            ];
        } else {
            for ($i = 0; $i < count($exist_rpoint); $i++) {
                $exist_rpoints = $exist_rpoint[$i];
                $exist_btimes = $exist_btime[$i];
                $exist_statuss = $exist_status[$i];
                $idv = $id[$i];
                $table = "tbl_sub_route_time";
                $field = ['point_id' => $exist_rpoints, 'ptime' => $exist_btimes, 'status' => $exist_statuss, 'operator_id' => $operator_id];
                $where = "where id=" . $idv . "";

                $check = trim($h->updateData($field, $table, $where));
            }

            if (is_array($new_rpoint) && is_array($new_btime) && is_array($new_status)) {
                $count = count($new_rpoint);

                for ($i = 0; $i < $count; $i++) {
                    $new_rpoints = $new_rpoint[$i];
                    $new_btimes = $new_btime[$i];
                    $new_statuss = $new_status[$i];

                    // Insert each point and time into the database
                    $table = "tbl_sub_route_time";
                    $field_values = ["board_id", "point_id", "ptime", "status", "operator_id"];
                    $data_values = ["$board_id", "$new_rpoints", "$new_btimes", "$new_statuss", "$operator_id"];

                    $checks = trim($h->insertData($field_values, $data_values, $table));
                }
            }
            if ($check == -1) {
                $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
            } else {
                if ($check == 1) {
                    $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Sub route Pick up Update Successfully!!", "message" => "Sub route Pick up section!", "action" => "list_pick_time.php"];
                } 
            }
        }
    } elseif ($_POST['type'] == 'edit_drop_subroute') {
        $board_id = $_POST['hidden_boarding_id'];
        $id = $_POST['id'];
        $operator_id = $sdata['id'];
        $exist_rpoint = $_POST['exist_rpoint'];
        $exist_btime = $_POST['exist_btime'];
        $exist_status = $_POST['exist_status'];
        $new_rpoint = $_POST['new_rpoint'];
        $new_btime = $_POST['new_btime'];
        $new_status = $_POST['new_status'];
        function hasDuplicates($array)
        {
            return count($array) !== count(array_unique($array));
        }

        if (!empty($new_rpoint)) {
            // Combine both arrays into a single array
            $combinedRPoint = array_merge($exist_rpoint, $new_rpoint);
        } else {
            // If $new_rpoint is empty or null, just use $exist_rpoint
            $combinedRPoint = $exist_rpoint;
        }

        // Check for duplicates in the combined array
        $duplicateCombinedRPoint = hasDuplicates($combinedRPoint);

        if ($duplicateCombinedRPoint) {
            // Return a JSON response indicating that duplicates are not allowed
            $returnArr = [
                "ResponseCode" => "200", // You can use an appropriate HTTP status code
                "Result" => "false",
                "title" => "Duplicate values are not allowed for Sub Route Points.",
                "action" => "list_drop_time.php",
            ];
        } else {
            for ($i = 0; $i < count($exist_rpoint); $i++) {
                $exist_rpoints = $exist_rpoint[$i];
                $exist_btimes = $exist_btime[$i];
                $exist_statuss = $exist_status[$i];
                $idv = $id[$i];
                $table = "tbl_drop_sub_route";
                $field = ['point_id' => $exist_rpoints, 'ptime' => $exist_btimes, 'status' => $exist_statuss, 'operator_id' => $operator_id];
                $where = "where id=" . $idv . "";

                $check = trim($h->updateData($field, $table, $where));
            }

            if (is_array($new_rpoint) && is_array($new_btime) && is_array($new_status)) {
                $count = count($new_rpoint);

                for ($i = 0; $i < $count; $i++) {
                    $new_rpoints = $new_rpoint[$i];
                    $new_btimes = $new_btime[$i];
                    $new_statuss = $new_status[$i];

                    // Insert each point and time into the database
                    $table = "tbl_drop_sub_route";
                    $field_values = ["board_id", "point_id", "ptime", "status", "operator_id"];
                    $data_values = ["$board_id", "$new_rpoints", "$new_btimes", "$new_statuss", "$operator_id"];

                    $checks = trim($h->insertData($field_values, $data_values, $table));
                }
            }
            if ($check == -1) {
                $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
            } else {
                if ($check == 1) {
                    $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Sub route Drop Update Successfully!!", "message" => "Sub route Drop section!", "action" => "list_drop_time.php"];
                } 
            }
        }
    } elseif ($_POST['type'] == 'edit_points') {
        $title = $h->real_string($_POST['title']);
        $city_id = $h->real_string($_POST['city_id']);
        $status = $_POST['status'];
        $id = $_POST['id'];
        $address = $h->real_string($_POST['address']);
        $mobile = $h->real_string($_POST['mobile']);
        $lats = $h->real_string($_POST['lats']);
        $longs = $h->real_string($_POST['longs']);

        $table = "tbl_points";
        $field = ['city_id' => $city_id, 'status' => $status, 'title' => $title, 'address' => $address, 'mobile' => $mobile, 'lats' => $lats, 'longs' => $longs];
        $where = "where id=" . $id . "";

        $check = trim($h->updateData($field, $table, $where));
        if ($check == -1) {
            $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
        } else {
            if ($check == 1) {
                $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Points Update Successfully!!", "message" => "Points section!", "action" => "list_drop_pick.php"];
            } 
        }
    } elseif ($_POST["type"] == "edit_city") {
        $okey = $_POST["status"];
        $id = $_POST["id"];
        $title = $h->real_string($_POST["title"]);

        $table = "tbl_city";
        $field = ["status" => $okey, "title" => $title];
        $where = "where id=" . $id . "";

        $check = trim($h->updateData($field, $table, $where));
        if ($check == -1) {
            $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
        } else {
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "City Update Successfully!!",
                    "message" => "City section!",
                    "action" => "list_city.php",
                ];
            } 
        }
    } elseif ($_POST["type"] == "edit_banner") {
        $okey = $_POST["status"];
        $id = $_POST["id"];
        $target_dir = dirname(dirname(__FILE__)) . "/images/banner/";
        $url = "images/banner/";
        $temp = explode(".", $_FILES["cat_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
        if ($_FILES["cat_img"]["name"] != "") {
            if (end($temp) != "jpg" && end($temp) != "png" && end($temp) != "jpeg") {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "false",
                    "title" => "Sorry, only JPG, JPEG, PNG  files are allowed !!",
                    "message" => "Upload Problem!!",
                    "action" => "add_banner.php?id=" . $id . "",
                ];
            } else {
                move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
                $table = "tbl_banner";
                $field = ["status" => $okey, "img" => $url];
                $where = "where id=" . $id . "";

                $check = trim($h->updateData($field, $table, $where));
                if ($check == -1) {
                    $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
                } else {
                    if ($check == 1) {
                        $returnArr = [
                            "ResponseCode" => "200",
                            "Result" => "true",
                            "title" => "Banner Update Successfully!!",
                            "message" => "Banner section!",
                            "action" => "list_banner.php",
                        ];
                    } 
                }
            }
        } else {
            $table = "tbl_banner";
            $field = ["status" => $okey];
            $where = "where id=" . $id . "";

            $check = trim($h->updateData($field, $table, $where));
            if ($check == -1) {
                $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
            } else {
                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Banner Update Successfully!!",
                        "message" => "Banner section!",
                        "action" => "list_banner.php",
                    ];
                } 
            }
        }
    } elseif ($_POST["type"] == "edit_facility") {
        $okey = $_POST["status"];
        $id = $_POST["id"];
        $title = $h->real_string($_POST["title"]);
        $target_dir = dirname(dirname(__FILE__)) . "/images/facility/";
        $url = "images/facility/";
        $temp = explode(".", $_FILES["cat_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
        if ($_FILES["cat_img"]["name"] != "") {
            if (end($temp) != "jpg" && end($temp) != "png" && end($temp) != "jpeg") {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "false",
                    "title" => "Sorry, only JPG, JPEG, PNG  files are allowed !!",
                    "message" => "Upload Problem!!",
                    "action" => "add_facility.php?id=" . $id . "",
                ];
            } else {
                move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
                $table = "tbl_facility";
                $field = ["status" => $okey, "img" => $url, "title" => $title];
                $where = "where id=" . $id . "";

                $check = trim($h->updateData($field, $table, $where));
                if ($check == -1) {
                    $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
                } else {
                    if ($check == 1) {
                        $returnArr = [
                            "ResponseCode" => "200",
                            "Result" => "true",
                            "title" => "Facility Update Successfully!!",
                            "message" => "Facility section!",
                            "action" => "list_facility.php",
                        ];
                    } 
                }
            }
        } else {
            $table = "tbl_facility";
            $field = ["status" => $okey, "title" => $title];
            $where = "where id=" . $id . "";

            $check = trim($h->updateData($field, $table, $where));
            if ($check == -1) {
                $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
            } else {
                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Facility Update Successfully!!",
                        "message" => "Facility section!",
                        "action" => "list_facility.php",
                    ];
                } 
            }
        }
    } elseif ($_POST["type"] == "com_payout") {
        $payout_id = $_POST["payout_id"];
        $target_dir = dirname(dirname(__FILE__)) . "/images/proof/";
        $url = "images/proof/";
        $temp = explode(".", $_FILES["cat_img"]["name"]);
        $newfilename = round(microtime(true)) . "." . end($temp);
        $target_file = $target_dir . basename($newfilename);
        $url = $url . basename($newfilename);
        if (end($temp) != "jpg" && end($temp) != "png" && end($temp) != "jpeg") {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "false",
                "title" => "Sorry, only JPG, JPEG, PNG  files are allowed !!",
                "message" => "Upload Problem!!",
                "action" => "list_payout.php",
            ];
        } else {
            move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
            $table = "payout_setting";
            $field = ["proof" => $url, "status" => "completed"];
            $where = "where id=" . $payout_id . "";

            $check = trim($h->updateData($field, $table, $where));
            if ($check == -1) {
                $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
            } else {
                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Payout Update Successfully!!",
                        "message" => "Payout section!",
                        "action" => "list_payout.php",
                    ];
                } 
            }
        }
    } elseif ($_POST["type"] == "point_delete") {
        $id = $_POST["id"];
        $table = "tbl_board_drop_points";
        $where = "where id=" . $id . "";

        $check = trim($h->deleteData($where, $table));
        if ($check == -1) {
            $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
        } else {
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Point Delete Successfully!!",
                    "message" => "Point section!",
                    "action" => "list_board_drop.php",
                ];
            } 
        }
    } elseif ($_POST["type"] == "sub_pick_route_delete") {
        $id = $_POST["id"];
        $table = "tbl_sub_route_time";
        $where = "where id=" . $id . "";

        $check = trim($h->deleteData($where, $table));
        if ($check == -1) {
            $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
        } else {
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Sub route Delete Successfully!!",
                    "message" => "Sub route section!",
                    "action" => "list_pick_time.php",
                ];
            } 
        }
    } elseif ($_POST["type"] == "sub_drop_route_delete") {
        $id = $_POST["id"];
        $table = "tbl_drop_sub_route";
        $where = "where id=" . $id . "";

        $check = trim($h->deleteData($where, $table));
        if ($check == -1) {
            $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
        } else {
            if ($check == 1) {
                $returnArr = [
                    "ResponseCode" => "200",
                    "Result" => "true",
                    "title" => "Sub route Delete Successfully!!",
                    "message" => "Sub route section!",
                    "action" => "list_drop_time.php",
                ];
            } 
        }
    } elseif ($_POST["type"] == "update_status") {
        $id = $_POST["id"];
        $status = $_POST["status"];
        $coll_type = $_POST["coll_type"];
        $page_name = $_POST["page_name"];
        if ($coll_type == "userstatus") {
            $table = "tbl_user";
            $field = "status=" . $status . "";
            $where = "where id=" . $id . "";

            $table = "tbl_user";
            $field = ["status" => $status];
            $where = "where id=" . $id . "";

            $check = trim($h->updateData($field, $table, $where));
            if ($check == -1) {
                $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
            } else {
                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "User Status Change Successfully!!",
                        "message" => "User section!",
                        "action" => "userlist.php",
                    ];
                } 
            }
        } elseif ($coll_type == "verifystatus") {
            $table = "tbl_user";
            $field = ["is_verify" => $status];
            $where = "where id=" . $id . "";

            $check = trim($h->updateData($field, $table, $where));
            if ($check == -1) {
                $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
            } else {
                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Agent Verify Status Change Successfully!!",
                        "message" => "User section!",
                        "action" => "userlist.php",
                    ];
                } 
            }
        } elseif ($coll_type == "dark_mode") {
            $table = "tbl_setting";
            $field = ["show_dark" => $status];
            $where = "where id=" . $id . "";

            $check = trim($h->updateData($field, $table, $where));
            if ($check == -1) {
                $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
            } else {
                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Dark Mode Status Change Successfully!!",
                        "message" => "Dark Mode section!",
                        "action" => $page_name,
                    ];
                } 
            }
        } elseif ($coll_type == "sdark_mode") {
            $table = "tbl_bus_operator";
            $field = ["dark_mode" => $status];
            $where = "where id=" . $id . "";

            $check = trim($h->updateData($field, $table, $where));
            if ($check == -1) {
                $returnArr = ["ResponseCode" => "200", "Result" => "true", "title" => "Please Activate Domain First!!!", "message" => "Validation!!", "action" => "validate_domain.php"];
            } else {
                if ($check == 1) {
                    $returnArr = [
                        "ResponseCode" => "200",
                        "Result" => "true",
                        "title" => "Dark Mode Status Change Successfully!!",
                        "message" => "Dark Mode section!",
                        "action" => $page_name,
                    ];
                } 
            }
        } else {
            $returnArr = [
                "ResponseCode" => "200",
                "Result" => "false",
                "title" => "Option Not There!!",
                "message" => "Error!!",
                "action" => "dashboard.php",
            ];
        }
    } else {
        $returnArr = ["ResponseCode" => "200", "Result" => "false", "title" => "Don't Try Extra Function!", "message" => "welcome admin!!", "action" => "dashboard.php"];
    }
} else {
    $returnArr = ["ResponseCode" => "200", "Result" => "false", "title" => "Don't Try Extra Function!", "message" => "welcome admin!!", "action" => "dashboard.php"];
}
echo json_encode($returnArr);
?>
