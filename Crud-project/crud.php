<?php
// INSERT INTO `notes` (`sno`, `title`, `description`, `tstamp`) VALUES (NULL, 'buy books ', 'please buy books from book store', current_timestamp());
$insert = false;
$servername = "localhost";
$username = "root";
$password = "";
$database = "notes";
//create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// die if connection was not successfull
if (!$conn) {
  die("sorry connection failed" . mysqli_connect_error());
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = $_POST["title"];
  $desc = $_POST["desc"];
  //sql query
  $sql = "INSERT INTO `notes` (`sno`, `title`, `description`, `tstamp`) VALUES (NULL, '$title', '$desc', current_timestamp())";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    $insert = true;
  } else {
    echo "the" . mysqli_error($conn);
  }
}
// $sql = "SELECT * FROM `information`";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <title>Professor-Notes</title>
  
</head>

<body>
  <!--edit body modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Edit modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">edit this notes</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form class="pt-8 p-4" action="" method="post">
      <div class="mb-3">
        <label for="title" class="form-label font-bold">Notes Title</label>
        <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text"> Add Notes title</div>
      </div>

      <h2 class="form-text font-bold p-2">Note</h2>
      <div class="form-floating">
        <textarea class="form-control" placeholder="add description here" id="descriptionEdit" name="descriptionEdit" style="height: 100px"></textarea>
        <label for="desc">Write Note Here</label>
      </div>

      <button type="submit" class="btn btn-primary mt-2">Update Note</button>
    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-gray-700">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Php Crud</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact-Us</a>
          </li>
          
        </ul>
        <form class="d-flex bg-transparent ">
          <input class="form-control me-2 " type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success font-bold text-white border-white" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
  <?php
  if ($insert === true) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Hey</strong> Youre note is successfully inserted below under the table.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
  }
  ?>
  <div class="container">
    <h2 class="pt-4 pl-6">Add a Note</h2>
    <form class="pt-8 p-4" action="" method="post">
      <div class="mb-3">
        <label for="title" class="form-label font-bold">Notes Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text"> Add Notes title</div>
      </div>

      <h2 class="form-text font-bold p-2">Note</h2>
      <div class="form-floating">
        <textarea class="form-control" placeholder="add description here" id="description" name="desc" style="height: 100px"></textarea>
        <label for="desc">Write Note Here</label>
      </div>

      <button type="submit" class="btn btn-primary mt-2">Add Note</button>
    </form>
  </div>
  <div class="container" id="myTable">
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">Titile</th>
          <th scope="col">Description</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM `notes`";
        $result = mysqli_query($conn, $sql);
        $sno = 0;
        while ($row = mysqli_fetch_assoc($result)) {
          $sno = $sno + 1;
          echo "<tr>
      <th scope='row'>" . $sno . "</th> 
      <td>" . $row['title'] . "</td>
      <td>" . $row['description'] . "</td>
      <td> <button class='edit btn btn-sm btn-primary'>Edit</button> <a href='/del'>Delete</a> </td>
      </tr>";
        }
        
        ?>
      </tbody> 
    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready( function () {
      $('#datatable').DataTable();
    });
  </script>
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit" );
        tr=e.target.parentNode.parentNode;
        // apan yahan tr tag se title aur descriptio call karre jo parent  tag hai aur sub-parenet tag hai
        title = tr.getElementsByTagName("td")[0].innerText; 
        description = tr.getElementsByTagName("td")[1].innerText;
        console.log(title,description);
        titleEdit.value = title;
        descriptionEdit.value = description;
        $('#editModal').modal('toggle');
      })
    })
  </script>
</body>

</html>