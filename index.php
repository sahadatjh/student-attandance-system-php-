<?php 
include 'inc/header.php';
include 'lib/Student.php';
?>
<script type="text/javascript">
    $(document).ready(function (){
        $("form").submit({
            var roll=true;
            $(':radio').each(function (){
               name=$(this).attend('name');
               if (roll &&! $(':radio[name="'+name+'"]:checked').length) {
                   alert(name + "Roll is missing....");
                   roll false;
                } 
            })
            return roll;
        })
    })
</script>
<?php 
$std =new Student();
$cur_date= date('d-m-Y');

if($_SERVER['REQUEST_METHOD']=='POST'){
        $attend=$_POST['attend'];
        $insertAttendance=$std->insertAttendance($attend,$cur_date);
    }
?>
<?php 
    if(isset($insertAttendance)){
        echo $insertAttendance;
    }
?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-success" href="add.php">Add Student</a>
                    <a class="btn btn-info pull-right" href="date_view.php">View All</a>
                </div>
               
                <div class="panel-body">
                    <div class="well text-center" style="font-size: 25px">
                        <strong>Date: </strong><?php echo $cur_date ;?>
                    </div>
                    <form method="post" action="">
                        <table class="table table-striped"> 
                            <tr>
                                <th>Serial No</th>
                                <th>Student Name</th>
                                <th>Roll</th>
                                <th>Attendance</th>
                            </tr>
                            <?php 
                                $get_student = $std->get_students();
                                if($get_student){
                                    $i=0;
                                    while($value=$get_student->fetch_assoc()){
                                        $i++;
                                    
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $value['name']; ?></td>
                                <td><?php echo $value['roll']; ?></td>
                                <td>
                                    <input type="radio" name="attend[<?php echo $value['roll']; ?>]" value="present" id="p">Present
                                    <input type="radio" name="attend[<?php echo $value['roll']; ?>]" value="absent" id="a">Absent
                                </td>
                            </tr> 
                            <?php
                                }
                                }
                            ?>
                            <tr>
                                <td colspan="4">
                                    <input type="submit" class="btn btn-primary" value="Save Attendance" name="submit" >
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                
            </div>
<?php include 'inc/footer.php';?>