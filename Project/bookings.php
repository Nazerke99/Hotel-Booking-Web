<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bookings</title>
    <?php require ('inc/links.php') ?>
    <link rel="stylesheet" href="css/common.css">
</head>

<body class="bg-light">
    <?php require ('inc/header.php');
    if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
        redirect('index.php');
    }
    ?>
    <div class="col-12 my-5 px-4">
        <h2 class="fw-bold">BOOKINGS</h2>
        <div style="font-size: 14px;">
            <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
            <span class="text-secondary">></span>
            <a href="#" class="text-secondary text-decoration-none">BOOKINGS</a>
        </div>
    </div>

    <?php
    $query = "SELECT bo.*, bd.*
          FROM booking  bo
          INNER JOIN booking_details bd ON bo.id = bd.booking_id
          WHERE ((bo.booking_status = 'booked')
                 OR (bo.booking_status = 'cancelled')
                 OR (bo.booking_status = 'payment failed'))
                 AND (bo.user_id=?)
          ORDER BY bo.id DESC";
    $result = select($query[$_SESSION['uId']], 'i');
    while ($data = mysqli_fetch_assoc($result)) {
        $date = date("d-m-Y", strtotime($data['datentime']));
        $checkin = date("d-m-Y", strtotime($data['check_in']));
        $checkout = date("d-m-Y", strtotime($data[' check_out ']));

        $status_bg="";
        $btn="";

        if($data['bookings_status']=='booked')
        {
            $status_bg="bg-success";
            if($data['arrival']==1)
            {
                $btn="<button type='button'  class='btn btn-dark btn-sm shadow-none'>Bookind</button>";
               
            }else{
                $btn="<button type='button'  class='btn btn-danger btn-sm shadow-none'>Cancel</button>";

            }
        }else if(){

        }
    }

    ?>




</body>

</html>