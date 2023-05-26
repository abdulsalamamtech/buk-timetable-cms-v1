<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href=""
      rel="stylesheet"
    />
    <title>DELETE</title>

        <!-- Fontawesome CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- TAILWIND CSS -->
        <script src="https://cdn.tailwindcss.com"></script>

  </head>
  <body>
<!-- START OF HTML BODY -->
 
<?php


include "../includes/config.php";


function delete_table(){

    global $conn;
    $message = "";


    // START DELETE
    if(isset($_REQUEST['delete'])){

        $row_name = $_REQUEST['row_name'];
        $row_id = $_REQUEST['row_id'];
        $table_name = $_REQUEST['table_name'];
        

        $delete_details = $row_name;

        $table_uniq_id = "";
        switch ($table_name) {
            case 'classroom':
                $table_uniq_id = "class_id";
                break;
            case 'courses':
                $table_uniq_id = "course_id";
                break;
            case 'depertment':
                $table_uniq_id = "dept_id";
                break;
            
            case 'staffs':
                $table_uniq_id = "staff_id";
                break;
            
            case 'admin':
                $table_uniq_id = "admin_id";
                break;
            
            default:
                $table_uniq_id = "";
                break;
        }

echo "<div class='text-center m-auto mt-10 p-10 w-[60%] bg-red-200 text-gray-700 font-bold'>";
        echo "<br><h2 class='text-2xl py-3 text-red-600'> <i class='fa fa-trash'></i> 
                <span> DELETE </span>
                <i class='fa fa-trash'></i></h2><br>";

        echo "<br><p> <i class='fa fa-warning text-red-600'></i> 
                <span class='text-2xl'> ". $delete_details ." </span>
                is going to be deleted permanently!
                <i class='fa fa-warning text-red-600'></i></p><br>";
    
        // START DELETE FROM DATABASE
        $sql_delete = "DELETE from {$table_name} WHERE {$table_uniq_id} = '{$row_id}'";
        $query_delete = mysqli_query($conn, $sql_delete);
        if(!$query_delete){
            echo $delete_details . " Error: Unable to delete... <br>";
        }else{

            echo $delete_details . " Deleted successfully... <br>";
        

            if($table_name == "depertment"){
                $table_name = "department";
            }
echo "</div>";

            $message .= "<script>
                            setTimeout(() => window.location = \"{$table_name}.php?deleted={$delete_details}\", 3000);
                        </script>";
            echo $message;
            
        }
        // END DELETE FROM DATABASE

    }else{
    
        $redirect = "<script>
            setTimeout(() => window.location = 'index.php', 0);
        </script>";
    
        echo $redirect;
    }
    // END DELETE

}

delete_table();




include "../includes/footer_download.php";

?>

<!-- END OF HTML BODY -->
</body>
</html>

