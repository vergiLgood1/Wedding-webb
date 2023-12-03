<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
include('adminonly.php');
?>



<!-- Modal -->
<div class="modal fade" id="addpaket" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title fs-5" id="exampleModalLabel">Tambahkan Data Testimoni</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="code.php" method="POST" enctype="multipart/form-data">
      <div class="modal-body">
        
        <div class="form-group">
            <label> Nama </label>
            <input type="text" name="nama_testi" class="form-control" placeholder="Enter Name" required>
        </div>
        <div class="form-group">
            <label> Judul </label>
            <input type="text" name="judul_testi" class="form-control" placeholder="Enter Title" required>
        </div>
        <div class="form-group">
            <label> Deskripsi </label>
            <textarea name="des_testi" id="" cols="30" rows="10" class="form-control" placeholder="Enter Description" required></textarea>
        </div>
        <div class="form-group">
            <label> Gambar </label>
            <input type="file" name="gambar_testi" class="form-control" id="gambar_testi" required>
        </div>
      

        <input type="hidden" name="usertype" value="admin">

      </div>
      <div class="modal-footer">
        <style>
        .btn-dark {
        background-color: #ff8f9c;
        }
        </style>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="testi_save" class="btn btn-dark">Save changes</button>
      </div>
      </form>

    </div>
  </div>
</div>

<div class="container-fluid">
<!--DataTables Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
    <style>button{
            margin-top: 20px;
            
        }
        h3{
            text-align: center;
        }
        .btn-dark {
        background-color: #ff8f9c;
        }
        .text-primary {
        color: #ff8f9c !important;
        }
        </style>
        <h3 class="m-0 font-weight-bold text-primary">Testimoni</h3>
        <!-- <form action="code.php" method"POST">
            <button type="submit" name="delete_data2" class="btn btn-danger">Delete Data</button>
        </form> -->
            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#addpaket">
                Tambah Testimoni
            </button>
        
    </div>    

<div class="card-body">

    <?php
    if(isset($_SESSION['success']) && $_SESSION['success'] !='')
    {
        echo '<h2 class="bg-primary text-white">'.$_SESSION['success'].'</h2>';
        unset($_SESSION['success']);
    }

    if(isset($_SESSION['status']) && $_SESSION['status'] !='')
    {
        echo '<h2 class="bg-danger text-white">'.$_SESSION['status'].'</h2>';
        unset($_SESSION['status']);
    }

    ?>

    <div class="table-responsive">
        
    
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Gambar</th>
                    <th>EDIT</th>
                    <th>Delete</th>    
                </tr>    
            </thead>
            <tbody>
            
            <?php
            $query = "SELECT * FROM testimoni";
            $query_run = mysqli_query($connection, $query);
            if(mysqli_num_rows($query_run) > 0)
            {
                while($row = mysqli_fetch_assoc($query_run))
                {
                    ?>
                    <tr>
                        <!-- <td>
                            <input type="checkbox" onclick="toggleCheckbox(this)" value="<?php #echo $row['id'] ?>" <?php #echo $row['visible'] == 1 ? "checked" : "" ?>>
                        </td> -->
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nama_user']; ?></td>
                    <td><?php echo $row['judul']; ?></td>
                    <td><?php echo $row['deskripsi']; ?></td>
                    <td><?php echo '<img src="uptesti/'.$row['gambar_user'].'" width="100px;" height="100px" alt="gambar">' ?></td>
                    <td>
                        <form action="testimoniedit.php" method="POST">
                        <input type="hidden" name="id_testi" value="<?php echo $row['id']; ?>">    
                        <button type="submit" name="edit_data_testi" class="btn btn-success fas fa-edit"></button>
                        </form>
                    </td>
                    <td>
                        <form action="code.php" method="post">
                        <input type="hidden" name="id_deletetesti" value="<?php echo $row['id']; ?>">    
                        <button type="submit" name="deletetesti" class="btn btn-danger">DELETE</button>
                        </form>
                    </td>
                </tr>
                    <?php
                }
            }
            else{
                echo "Tidak ada Record data";
            }
            ?>  
            </tbody>    
        </table>

        </div>
    </div>
</div>



<?php
include('includes/scripts.php') ;
include('includes/footer.php');
?>

<!-- <script>
    function toggleCheckbox(box)
    {
        var id = $(box).attr("value");

        if($(box).prop("checked") == true)
        {
            var visible = 1;
        }
        else
        {
            var visible = 0;
        }
        var data = {
            "search_data": 1,
            "id": id,
            "visible": visible
        };

        $.ajax({
            type: "POST",
            url: "code.php",
            data: data,
            
            success: function(response) {
                //alert("Data Checked");
            }
        });
    }
</script> -->