<?php
$welcome = false;
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location:login.php");
    exit;
} else {
    require "./partials/_dbconection.php";
    $welcome = true;
    $success_msg = false;
    $failed_msg = false;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $prn = $_POST['PRN'];
        $mob = $_POST['Phone'];
        $branch = $_POST['branch'];
        $book = $_POST['book'];
        $author = $_POST['authorName'];
        $access = $_POST['access'];

        $sql = "INSERT INTO `student_details`(`Stud_name`,`Stud_prn`,`Stud_mob`,`Stud_branch`,`Book_name`,`Book_author`,`Book_access`)
                                         values('$name','$prn','$mob','$branch','$book','$author','$access')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $success_msg = true;
        } else {
            $failed_msg = true;
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <title>Welcome to Library <?php echo $_SESSION['name']; ?></title>
</head>

<body>
    <?php
    require "./partials/_nav.php";
    if ($success_msg) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>success !</strong> Book entry has beed successfully inserted!.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                   </div>';
    } elseif ($failed_msg) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Failed !</strong> Book with this PRN number is already access kindly return the book and then try.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                   </div>';
    }
    ?>
    <div class="container my-4">
        <h5>Welcome <?php
                    echo $_SESSION['name'];
                    ?></h5>
        <hr>
        <form action="/Login_system/welcome.php" method="POST">
            <div class="form-group row  my-2">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Student Name" autocomplete="Off" required>
                </div>
            </div>
            <div class="form-group row  my-3">
                <label for="PRN" class="col-sm-2 col-form-label">PRN No.</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="PRN" id="PRN" placeholder="Enter PRN No" maxlength="13" minlength="11" autocomplete="Off" required>
                </div>
            </div>
            <div class="form-group row  my-3">
                <label for="Phone" class="col-sm-2 col-form-label">Phone No.</label>
                <div class="col-sm-10">
                    <input type="tel" inputmode="tel" class="form-control" id="Phone" name="Phone" placeholder="Enter Phone No" maxlength="10" minlength="10" autocomplete="Off" required>
                </div>
            </div>
            <div class="form-group row my-3">
                <label for="branch" class="col-sm-2 col-form-label">Branch</label>
                <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" name="branch">
                        <option selected>Select Your Branch</option>
                        <option value="Electronics & Telecommunication">Electronics & Telecommunication</option>
                        <option value="Computer Science">Computer Science</option>
                        <option value="Mechanical Engineering">Mechanical Engineering</option>
                        <option value="Civil Engineering">Civil Engineering</option>
                    </select>
                </div>
            </div>
            <div class="form-group row my-3">
                <label for="bookName" class="col-sm-2 col-form-label">Book Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="bookName" name="book" placeholder="Book Name" autocomplete="Off" required>
                </div>
            </div>
            <div class="form-group row my-3">
                <label for="author" class="col-sm-2 col-form-label">Author</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="author" name="authorName" placeholder="Author Name" autocomplete="Off" required>
                </div>
            </div>
            <div class="form-group row my-3">
                <label for="access" class="col-sm-2 col-form-label">Accession No.</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="access" name="access" placeholder="Enter Accession no." autocomplete="Off" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Add Book</button>
                </div>
            </div>
        </form>
        <hr>
        <!-- table data -->
        <div class="container my-3">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th scope="col">SR.NO</th>
                        <th scope="col">Name</th>
                        <th scope="col">PRN</th>
                        <th scope="col">MOBILE NO</th>
                        <th scope="col">BRANCH</th>
                        <th scope="col">BOOK NAME</th>
                        <th scope="col">AUTHOR</th>
                        <th scope="col">ACCESSION NO</th>
                        <th scope="col">ISSUED DATE</th>
                        <th scope="col">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $dispaly = "SELECT*FROM `student_details` order by date asc";
                    $display_result = mysqli_query($conn, $dispaly);
                    //  $fetch_row_count=mysqli_num_rows($display_result);

                    while ($fetch_data = mysqli_fetch_assoc($display_result)) {
                        echo '
                        <tr>
                      <th scope="col">' . $fetch_data['sr.no'] . '</th>
                      <td>' . $fetch_data['Stud_name'] . '</td>
                      <td>' . $fetch_data['Stud_prn'] . '</td>
                      <td>' . $fetch_data['Stud_mob'] . '</td>
                      <td>' . $fetch_data['Stud_branch'] . '</td>
                      <td>' . $fetch_data['Book_name'] . '</td>
                      <td>' . $fetch_data['Book_author'] . '</td>
                      <td>' . $fetch_data['Book_access'] . '</td>
                      <td>' . $fetch_data['date'] . '</td>
                      <td><button type="button" class="btn btn-success my-2" href="/login_system/welcome.php">Edit</button>
                          <button type="button" class="btn btn-danger my-2" href="/login_system/welcome.php">Return</button>
                     </td>
                     </tr>
                      ';
                    }
                    ?>
                    </tr>
                </tbody>
            </table>
        </div>


        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
        <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#table').DataTable();
            });
        </script>
</body>

</html>