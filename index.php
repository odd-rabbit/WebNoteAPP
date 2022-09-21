<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">
      <link rel="stylesheet" href="style.css" />
    <title>Goal Tracker</title>
  </head>
  <body>
    <div id="container">
        <nav>
            <div>
                <form class="d-flex" action="index.php" method="post">

                    <input type="search" placeholder="Search" aria-label="Search" name="search">
                    <button class="btnComplete" type="submit">Search</button>
                </form>
            </div>

        </nav>
<!--        sent message-->
        <?php
        session_start();
        if(isset($_SESSION['note-key'])){
            echo "<div class='alert alert-success' role='alert' id='liveAlertBtn'>
            You have successfully created a note! Save the following key to ensure ownership of this note:
            <meta name='note-key' id='note-key'>" . $_SESSION['note-key'] . "</meta>
            </div>
            ";
            session_destroy();
        }
        ?>
<!--        create button-->
        <div  style="text-align: center">
            <button type="button" class="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                CREATE NOTE
            </button>
        </div>
<!--        note input-->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="exampleModalLabel">Create</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="new_note.php" method="post">
                        <div class="modal-body">
                            <div class="card card-body">
                                <label for="note-category">Type</label>
                                <select name="note-category" id="note-category">
                                    <option value="0">Public Edit</option>
                                    <option value="1">Public Read</option>
                                    <option value="2">Private</option>
                                </select>
                                <label for="note-name">Name</label>
                                <input type="text" placeholder="CJ Patoilo" name="note-name" id="note-name">
                                <label for="note-text">Note</label>
                                <textarea class="editText" name="note-text" id="note-text"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="button button-outline" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="button" >Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<!--result display-->
        <?php
        if(isset($_REQUEST['search'])){
            require_once 'connect.php';
            $sql = "SELECT * FROM note WHERE name LIKE "  . "'%" . $_REQUEST['search']. "%'";
            $result = mysqli_query($link, $sql) or die(mysqli_error($link));
            echo "<h2>Results</h2>";
            while($row = mysqli_fetch_array($result)){
                if($row['category'] != 2){
                    echo "";
                    if($row['category'] == 0){
                        $cat = "Public Edit";
                    } elseif ($row['category' == 1]) {
                        $cat = "Public Read";
                    } else {
                        $cat = "Other";
                    }
                    ?>
                    <div class='notes'>
                    <button type='button' class='btnComplete' data-bs-toggle='modal' data-bs-target='#editModal'>
                        OPEN
                    </button><strong>
                    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 id="exampleModalLabel">Create</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="new_note.php" method="post">
                                    <div class="modal-body">
                                        <div class="card card-body">
                                            <label for="note-category">Type</label>
                                            <select name="note-category" id="note-category">
                                                <option value="0">Public Edit</option>
                                                <option value="1">Public Read</option>
                                                <option value="2">Private</option>
                                            </select>
                                            <label for="note-name">Name</label>
                                            <input type="text" placeholder="CJ Patoilo" name="note-name" id="note-name">
                                            <label for="note-text">Note</label>
                                            <textarea class="editText" name="note-text" id="note-text"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="button button-outline" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="button" >Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
        <?php
                    echo  $row['name'] . "</strong><p>" . $row['content'] . "</p>Create Date: " . $row['date'] . " $cat";
                    echo "</div>";
                }
            }
        }
        ?>
    </div>

  </body>
</html>
