<?php session_start();
$current= "tms";
include ('header.php'); 

if($_REQUEST['id'] == '')
    $employee_id = ($_SESSION['user_id']);
else
    $employee_id = $_REQUEST['id'];
    
$timeArray = $func->createTimeSlot();
?>


<header class="main-header">
    <div class="container ">

     <?php $x = 0 ;/*$res1 = $conn->getData(_TBLCONTACT,"*","1",'res');*/
      $res1 = mysql_query("SELECT * FROM `employee` WHERE id = '$employee_id' ");
      while($row1 = mysql_fetch_assoc($res1)) { $x++;?>
        <h1 class="page-title">Profile</h1>

        <ol class="breadcrumb pull-right">
            <li><a href="#">Profile</a></li>
            <li class="active"><td><?php echo $row1['First_name']." ". $row1['Last_Name']; ?></td></li>
        </ol>
      <?php } ?>
    </div>
</header>





 <div class="container container-bottom">
<h2 class="section-title" id="tables-responsive">My Timesheet</h2>

    
 

            
        <div class="row">

        <div class="col-md-12">
            <h2 class="section-title" id="tables-responsive"><?php echo $month = date('F Y'); ?>

        
           <!--  <button  onclick="location.href = 'add-tms.php';" class="btn btn-primary  btn-sm pull-right"><i class="fa fa-plus"></i> ADD</button> --> </h2>
        
             <div class="bs-example"> <!-- B -->
                   
                <div class="table-responsive"> <!-- A -->
                     <table class="table table-striped table-bordered">
                       <thead class="thead-bg">
                         <tr>
                          <td>No. #</td>
                          <td>Date</td>
                          <td>Client</td>
                          <td>Brand</td>
                          <td>Acitivity</td>
                           <td>Start Time</td>
                          <td>End Time</td>
                          <td>Time Consumed</td>
                        
                         </tr>
                        </thead>
                 
           <?php $x = 0 ; $totTime = 0;
            $month = date('m'); /*$res1 = $conn->getData(_TBLCONTACT,"*","1",'res');*/
           $res = mysql_query("SELECT * FROM `tms_entform` WHERE employee_id = '$employee_id'AND month(`date`) = '".$month."' order by start_time ");
           while($row = mysql_fetch_assoc($res)) { $x++;
             $start_time = $row['start_time'];
             $end_time = $row['end_time'];

            ?>
      <tbody>
            <tr>
            <td><?php echo $x; ?></td>
			<td><?php echo  date("d/m/Y",strtotime($row['date']));?></td>
            
            <?php    echo "<td>".$conn->getData("tms_client","brand_name","brand_code = '".$row['brand_code']."' ",'val')."</td>"; ?>
            <?php    echo "<td>".$conn->getData("tms_brands","product_name","product_code = '".$row['product_code']."' ",'val')."</td>"; ?>
             <?php    echo "<td>".$conn->getData("activity","activity_list ","id = '".$row['activity']."' ",'val')."</td>"; ?>
            <td><?php echo $a = $timeArray[$start_time]; ?></td>
            <td><?php echo $b = $timeArray[$end_time]; ?></td>
            <td><?php $slots = $conn->getData("timeslot","count(id)","form_id = '".$row['id']."' ",'val');
            $diff = $func->get_time_difference($a,$b);
            if($diff == '00:15')
              $time = ($slots) * 15;
            else
              $time = ($slots+1) * 15;

            $totTime = $totTime + $time ;
            echo $func->convertToHoursMins($time, '%02d hours %02d minutes'); // should output 4 hours 17 minutes; ?></td>
           
                 
      </tr>
      <?php }// end while ?>
      <tr>
     

      </tbody>
    </table>
                    </div><!-- /.table-responsive A -->
                  </div> <!-- B -->
        </div> <!-- C -->
        </div>
      

    
    
    
</div> <!-- container  -->






















<!-- container -->
<?php include ('footer.php');   ?>