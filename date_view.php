<?php 
include 'inc/header.php';
include 'lib/Student.php';
?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <a class="btn btn-success" href="add.php">Add Student</a>
            <a class="btn btn-info pull-right" href="index.php">Take Attendance</a>
        </div>

        <div class="panel-body">
            <form method="post" action="">
                <table class="table table-striped"> 
                    <tr>
                        <th>Serial No</th>
                        <th>Attendance date</th>
                        <th>Action</th>
                    </tr>
                    <?php 
                        $std = new Student();
                        $get_date = $std->getDateList();
                        if($get_date){
                            $i=0;
                            while($value=$get_date->fetch_assoc()){
                                $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $value['attendance_time']; ?></td>
                        <td>
                            <a class="btn btn-primary" href="student_view.php?dt=<?php echo $value['attendance_time']; ?>">View Details</a>
                        </td>
                    </tr> 
                    <?php
                        }
                        }
                    ?>
                    
                </table>
            </form>
        </div>

    </div>
<?php include 'inc/footer.php';?>