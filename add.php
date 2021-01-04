<?php 
include 'inc/header.php';
include 'lib/Student.php';
?>
<?php 
    $std=new Student();
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $name=$_POST['name'];
        $roll=$_POST['roll'];
        $insertdata=$std->insertStudent($name,$roll);
    }
?>
<?php 
    if(isset($insertdata)){
        echo $insertdata;
    }
?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-success" href="add.php">Add Student</a>
                    <a class="btn btn-danger pull-right" href="index.php">Back</a>
                </div>
               
                <div class="panel-body">
                   <form method="post" action="">
                       <div class="form-group">
                           <label for="name">Student Name: </label>
                           <input class="form-control" type="text" name="name" id="name" required="1" />
                       </div>
                       <div class="form-group">
                           <label for="roll">Student Roll: </label>
                           <input class="form-control" type="number" name="roll" id="roll" required="1"/>
                       </div>
                       <div class="form-group">
                            <input type="submit" name="submit" value="Save Student" class="btn btn-primary"/>
                       </div>
                    </form>
                </div>
                
            </div>
<?php include 'inc/footer.php';?>