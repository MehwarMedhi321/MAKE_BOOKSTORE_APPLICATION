<?php
$con = mysqli_connect('localhost', 'root', '', 'userinfo') or die("Couldn't Connected");

$insert = false;
$delete = false;
$Update = false;
$rented = false;

if (isset($_GET['delete'])) {
    $sno = $_GET['delete'];
    $sql = "DELETE FROM library WHERE library.id = $sno;";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $delete = true;
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['idnoEdit'])) {
        if (isset($_POST['rentId'])) {
            $rentId = $_POST['rentId'];

            $sql = "UPDATE library SET isRented = 1 WHERE library.id = $rentId;";
            $result = mysqli_query($con, $sql);

            if ($result) {
                $rented = true;
            }
        }
        $idno = $_POST['idnoEdit'];
        $BookName = $_POST['BookNameEdit'];
        $authorName = $_POST['authorNameEdit'];
        $price = $_POST['priceEdit'];
        $isbnName = $_POST['isbnNameEdit'];
        $CountBook = $_POST['CountBookEdit'];
        $type = $_POST['typeEdit'];


        $sql = "UPDATE library SET book = '$BookName', author = '$authorName', price = '$price', ISBN = '$isbnName', CountBook = '$CountBook', typeno = '$type' WHERE library.id = $idno;";

        $result = mysqli_query($con, $sql);

        if ($result) {
            $Update = true;
        }
    } else {
        $BookName = $_POST['BookName'];
        $authorName = $_POST['authorName'];
        $price = $_POST['price'];
        $isbnName = $_POST['isbnName'];
        $CountBook = $_POST['CountBook'];
        $type = $_POST['type'];


        $sql = "INSERT INTO library ( book, author, price, ISBN,  CountBook,typeno) VALUES ( '$BookName', '$authorName', '$price', '$isbnName', '$CountBook', '$type');";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $insert = true;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="createBook.css">

    <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

    <title> World Library Website </title>

</head>

<body>
    <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModallabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Books</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="bodyFonst">
                        <form action="createBook.php" method="POST" id="fromNavbar">
                            <input type="hidden" id="idnoEdit" name="idnoEdit">
                            <label for="BookName">Book Name:</label>
                            <input type="text" id="BookNameEdit" name="BookNameEdit" placeholder="Enter book name" required>

                            <label for="AuthorName">Author:</label>
                            <input type="text" id="authorNameEdit" name="authorNameEdit" placeholder="Enter author name" required>

                            <label for="PriceVal">Price:</label>
                            <input type="number" id="priceEdit" name="priceEdit" placeholder="Enter price" required>

                            <label for="ISBNCode">ISBN:</label>
                            <input type="text" id="isbnNameEdit" name="isbnNameEdit" placeholder="Enter ISBN" required>

                            <label for="BookCount">Count Book:</label>
                            <input type="number" id="CountBookEdit" name="CountBookEdit" placeholder="which Books" required>

                            <div id="textItem">
                                <label>Type:</label>
                                <input type="radio" id="typeEdit" name="typeEdit" value="Programming" required>
                                <label for="Programing">Programming</label>

                                <input type="radio" id="typeEdit" name="typeEdit" value="English" required>
                                <label for="English">English</label>

                                <input type="radio" id="typeEdit" name="typeEdit" value="Science" required>
                                <label for="Science">Science</label>
                            </div>
                            <button type='submit' id="modal" class='btn'>Update Book</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="bodyFonst">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <h1 class="navbar-brand" href="#" style="color: white; font-size:2rem">World <span style="color: blue; font-size:2rem"> Library</span></h1>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#" style="color: blue;">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Service</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Content</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <?php
        if ($insert) {
            echo  "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Message:  </strong>Your Book Has been Add Successfull.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
        ?>

        <?php
        if ($delete) {
            echo  "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Message:  </strong>Your Book Has been Delete Successfull.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
        ?>
        <?php
        if ($Update) {
            echo  "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Message:  </strong>Your Book Has been Update Successfull.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
        ?>

        <div id="main" class="mb-5">
            <i class="fa-solid fa-droplet" style="padding-left: 10%; cursor: pointer; float: right; font-size: 20px;" id="colorChangeByIcon"></i>
            <h1 id="header" style="color: balck; font-size:4rem; font-weight: 600">World <span style="color: blue; font-size:4rem;font-weight: 600;">Library</span> </h1>

            <form action="createBook.php" method="POST">
                <label for="BookName">Book Name:</label>
                <input type="text" id="BookName" name="BookName" placeholder="Enter book name" required>

                <label for="AuthorName">Author:</label>
                <input type="text" id="authorName" name="authorName" placeholder="Enter author name" required>

                <label for="PriceVal">Price:</label>
                <input type="number" id="price" name="price" placeholder="Enter price" required>

                <label for="ISBNCode">ISBN:</label>
                <input type="text" id="isbnName" name="isbnName" placeholder="Enter ISBN" required>

                <label for="BookCount">Count Book:</label>
                <input type="number" id="CountBook" name="CountBook" placeholder="which Books" required>

                <div id="textItem">
                    <label>Type:</label>
                    <input type="radio" id="Programing" name="type" value="Programming" required>
                    <label for="Programing">Programming</label>

                    <input type="radio" id="English" name="type" value="English" required>
                    <label for="English">English</label>

                    <input type="radio" id="Science" name="type" value="Science" required>
                    <label for="Science">Science</label>
                </div>
                <button type='submit' class='btn'>Add Book</button>
            </form>

            <table id="mytable">
                <thead>
                    <tr style='border: 2px solid black;  '>
                        <th style='border: 2px solid black; background-color:rgb(76,68,182,0.888); color:white;'>S.no</th>
                        <th style='border: 2px solid black; background-color:rgb(76,68,182,0.888); color:white;'>Book Name</th>
                        <th style='border: 2px solid black; background-color:rgb(76,68,182,0.888); color:white;'>Author</th>
                        <th style='border: 2px solid black; background-color:rgb(76,68,182,0.888); color:white;'>Price</th>
                        <th style='border: 2px solid black; background-color:rgb(76,68,182,0.888); color:white;'>ISBN</th>
                        <th style='border: 2px solid black; background-color:rgb(76,68,182,0.888); color:white;'>Count Book</th>
                        <th style='border: 2px solid black; background-color:rgb(76,68,182,0.888); color:white;'>Type</th>
                        <th style='border: 2px solid black; background-color:rgb(76,68,182,0.888); color:white;'>Edit</th>
                        <th style='border: 2px solid black; background-color:rgb(76,68,182,0.888); color:white;'>Delete</th>
                        <th style='border: 2px solid black; background-color:rgb(76,68,182,0.888); color:white;'>Rent Book</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $sql = "SELECT * FROM library";
                    $result = mysqli_query($con, $sql);
                    $id =  0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $id + 1;
                        echo "<tr >
                     <th scope='row' style='border: 2px solid black; background-color:rgb(76,68,182,0.888); color:white;'>" .  $id . "</th>
                     <td style='border: 1px solid black; background-color:rgba(187, 183, 233, 0.888);'>" . $row['book'] . "</td>
                     <td style='border: 1px solid black; background-color:rgba(187, 183, 233, 0.888);'>" . $row['author'] . "</td>
                     <td style='border: 1px solid black; background-color:rgba(187, 183, 233, 0.888);'>" . $row['price'] . "</td>
                     <td style='border: 1px solid black; background-color:rgba(187, 183, 233, 0.888);'>" . $row['ISBN'] . "</td>
                     <td style='border: 1px solid black; background-color:rgba(187, 183, 233, 0.888);'>" . $row['CountBook'] . "</td>
                     <td style='border: 1px solid black; background-color:rgba(187, 183, 233, 0.888);'>" . $row['typeno'] . "</td>
                     <td style='border: 1px solid black; background-color:rgba(187, 183, 233, 0.888);'> <button type='submit' class='Button btn btn-success' id=" . $row['id'] . ">Edit</button></td>   
                     <td style='border: 1px solid black; background-color:rgba(187, 183, 233, 0.888);'> <button type='submit' class='delete btn btn-success' id=d" . $row['id'] . ">Delete</button></td>
                     <td style='border: 1px solid black; background-color:rgba(187, 183, 233, 0.888); width:60px;'><button type='submit' class='Rent btn btn-success' id=r" . $row['id'] . ">Rent</button>
                     </td>
                     </tr>";
                    }

                    ?>

                </tbody>
            </table>
        </div>
    </div>
    </div>
    <hr>

    <script>
        $(document).ready(function() {
            $('#mytable').DataTable();
        });
    </script>


    <script>
        let Btn = document.getElementsByClassName("Button");

        Array.from(Btn).forEach((element) => {
            element.addEventListener("click", (e) => {
                e.preventDefault();
                tr = e.target.parentNode.parentNode;
                BookName = tr.getElementsByTagName("td")[0].innerHTML;
                authorName = tr.getElementsByTagName("td")[1].innerHTML;
                price = tr.getElementsByTagName("td")[2].innerHTML;
                isbnName = tr.getElementsByTagName("td")[3].innerHTML;
                CountBook = tr.getElementsByTagName("td")[4].innerHTML;
                type = tr.getElementsByTagName("td")[5].innerHTML;

                BookNameEdit.value = BookName;
                authorNameEdit.value = authorName;
                priceEdit.value = price;
                isbnNameEdit.value = isbnName;
                CountBookEdit.value = CountBook;
                typeEdit.value = typeno;
                idnoEdit.value = e.target.id;

                $('#editModal').modal('show');


            });
        });

        Delete = document.getElementsByClassName("delete");
        Array.from(Delete).forEach((element) => {

            element.addEventListener("click", (e) => {
                e.preventDefault();
                sno = e.target.id.substr(1, );
                if (confirm("You Are Agree For Delete This Form!")) {

                    window.location = `createBook.php?delete=${sno}`;

                } else {
                    console.log("Now");
                }
            });
        });
    </script>

</body>

</html>