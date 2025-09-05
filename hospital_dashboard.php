<?php include("db_connect.php"); 
$hospital_id=2;

$sql = "SELECT name FROM hospitals WHERE hospital_id = '$hospital_id'";
$res = mysqli_query($conn, $sql);

 $row = mysqli_fetch_assoc($res);
$hospital_name = $row['name'];
?>

<?php
if(isset($_GET['doctor_delete_id'])){
    $doctor_id = $_GET['doctor_delete_id'];
    $del_sql = "DELETE FROM doctors WHERE doctor_id='$doctor_id'";
    mysqli_query($conn, $del_sql);
    echo "<script>alert('Doctor deleted successfully!'); window.location.href='hospital_dashboard.php';</script>";
}

if(isset($_POST['doctor_add'])){
    $name = $_POST['name'];
    $spec = $_POST['specialization'];
    $qual = $_POST['qualification'];
    $exp = $_POST['experience_years'];
    $fee = $_POST['consultation_fee'];
    $days = $_POST['schedule_days'];
    $st = $_POST['start_time'];
    $et = $_POST['end_time'];

    $photoName = $_FILES['photo']['name'];
    $tmp = $_FILES['photo']['tmp_name'];
    $uploadDir = "uploads/";
    move_uploaded_file($tmp, $uploadDir . $photoName);

    $sql = "INSERT INTO doctors (hospital_id,name,specialization,qualification,
             experience_years,consultation_fee,photo,schedule_days,start_time,end_time)
            VALUES ('$hospital_id','$name','$spec','$qual','$exp','$fee','$photoName',
            '$days','$st','$et')";
    mysqli_query($conn, $sql);
    echo "<script>alert('Doctor added successfully!'); window.location.href='hospital_dashboard.php';</script>";
}

if(isset($_GET['service_delete_id'])){
    $service_id = $_GET['service_delete_id'];
    $del_sql = "DELETE FROM diagnostic_services WHERE service_id='$service_id'";
    mysqli_query($conn, $del_sql);
    echo "<script>alert('Service deleted successfully!'); window.location.href='hospital_dashboard.php';</script>";
}

if(isset($_POST['diagonstic_add'])){
    $sName=$_POST['serviceName'];
    $rPrice=$_POST['regularPrice'];
    $dRate=$_POST['discountRate'];

    $sql="INSERT INTO diagnostic_services (hospital_id, service_name, regular_price, discount_rate)
          Values ('$hospital_id', '$sName', '$rPrice', '$dRate')";
    
    mysqli_query($conn, $sql);
    echo "<script>alert('Service added successfully!'); window.location.href='hospital_dashboard.php';</script>";

}

if(isset($_GET['surgery_delete_id'])){
    $surgery_id = $_GET['surgery_delete_id'];
    $del_sql = "DELETE FROM surgery WHERE surgery_id='$surgery_id'";
    mysqli_query($conn, $del_sql);
    echo "<script>alert('Surgery Packages deleted successfully!'); window.location.href='hospital_dashboard.php';</script>";
}

if(isset($_POST['surgery_add'])){
    $suName = $_POST['surgeryName'];
    $pw = $_POST['priceInWord'];
    $ps = $_POST['priceInStandard'];
    $pd = $_POST['priceInDeluxe'];
    $psu = $_POST['priceInSuite'];
    $duration = $_POST['durationOfStay'];

    $sql = "INSERT INTO surgery (hospital_id,surgery_name,price_in_word, price_in_standard, price_in_deluxe, price_in_suite, duration)
            VALUES ('$hospital_id','$suName', '$pw', '$ps', '$pd', '$psu', '$duration')";
    mysqli_query($conn, $sql);
    echo "<script>alert('Doctor surgery successfully!'); window.location.href='hospital_dashboard.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>HNMS Hospital Dashboard</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="Dash.css">
</head>
<body>
<div class="sidebar" id="sidebar">
    <div class="logo">
        <img src="HNMS.png" alt="HNMS logo">
        <span class="logo-text">HEALTH NAVIGATION AND MANAGEMENT</span>
    </div>
    <a href="#" onclick="showSection('dashboard')">Dashboard</a>
    <a href="#" onclick="showSection('doctor')">Show Doctor List & Add Doctor</a>
    <a href="#" onclick="showSection('appointment')">Doctors Appointment</a>
    <a href="#" onclick="showSection('diagnostic')">Diagnostic Services</a>
    <a href="#" onclick="showSection('surgery')">Surgery Packages</a>
    <a href="#" onclick="showSection('profile')">Profile</a>
    <a href="#" class="log-out">Log-out</a>
</div>

<div class="main">
    <div class="navbar">
        <div class="hamburger" onclick="toggleSidebar()">
            <i class="fa fa-bars"></i>
        </div>
        <div class="navbar-logo">
            <img src="HNMS.png" alt="HNMS Logo">
            <span>HNMS</span>
        </div>
        <div class="navbar-links">
            <a href="#" onclick="showSection('doctor')">Find Doctor</a>
            <a href="#" onclick="showSection('appointments')">Appointments</a>
        </div>
        <div class="navbar-right">
            <div class="profile">
                <img src="Profile.jpg" alt="Profile Picture">
                <span class="profile-name">Welcome, <?php echo $hospital_name; ?> </span>
            </div>
            <div class="notification" onclick="showNotifications()">
                <i class="fa fa-bell"></i>
                <span class="notification-count" id="notificationCount">0</span>
            </div>
            <div class="settings" onclick="openSettings()">
                <i class="fa fa-cog"></i>
            </div>
        </div>
    </div>

    <div class="content">
        <div id="dashboard" class="section" style="display: block;">
            <div class="welcome-banner">
                <h2>Welcome back, <?php echo $hospital_name; ?> </h2>
                <p>Here your hospital overview</p>
            </div>
        </div>

        <div id="doctor" class="section" style="display: flex;">
            <div class="container">
                <div>
                    <h3>Doctor List</h3>
                    <table style="border-collapse: collapse; width: 100%;">
                        <tr>
                            <th>Name</th>
                            <th>Specialization</th>
                            <th>Qualification</th>
                            <th>Experience</th>
                            <th>Fee</th>
                            <th>Schedule</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Photo</th>
                            <th>Delete</th>
                        </tr>
                        <?php
                        $sql = "SELECT * FROM doctors WHERE hospital_id='$hospital_id'";
                        $res = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($res) > 0){
                            while($row = mysqli_fetch_assoc($res)){
                                echo "<tr>
                                        <td>{$row['name']}</td>
                                        <td>{$row['specialization']}</td>
                                        <td>{$row['qualification']}</td>
                                        <td>{$row['experience_years']} years</td>
                                        <td>{$row['consultation_fee']}</td>
                                        <td>{$row['schedule_days']}</td>
                                        <td>{$row['start_time']}</td>
                                        <td>{$row['end_time']}</td>
                                        <td><img src='uploads/{$row['photo']}' width='60' height='60'></td>
                                        <td><a href='?doctor_delete_id={$row['doctor_id']}' onclick=\"return confirm('Are you sure?');\">Delete</a></td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='10'>No doctors found for this hospital</td></tr>";
                        }
                        ?>
                    </table>
                </div>

                <div style="display: block;">
                    <h3>Add Doctor</h3>
                    <form method="POST" enctype="multipart/form-data">
                        <input type="text" name="name" placeholder="Doctor Name" required><br>
                        <input type="text" name="specialization" placeholder="Specialization"><br>
                        <input type="text" name="qualification" placeholder="Qualification"><br>
                        <input type="number" name="experience_years" placeholder="Experience (Years)"><br>
                        <input type="number" name="consultation_fee" placeholder="Fee"><br>
                        <input type="text" name="schedule_days" placeholder="Schedule Days"><br>
                        <input type="time" name="start_time"><br>
                        <input type="time" name="end_time"><br>
                        <input type="file" name="photo" accept="image/*"><br>
                        <button type="submit" name="doctor_add">Add Doctor</button>
                    </form>
                </div>
            </div>
        </div>

        <div id="appointment" class="section">
            <h2>Appintment lIst</h2>
        </div>

        <div id="diagnostic" class="section">
            <div class="container">
                <div>
                    <h3>Diagonstic Services List</h3>
                    <table style="border-collapse: collapse; width: 100%;">
                        <tr>
                            <th>Service Name</th>
                            <th>Regular Price</th>
                            <th>Discount Rate</th>
                            <th>Discount Price</th>
                            <th>Delete</th>
                        </tr>
                        <?php
                        $sql = "SELECT * FROM  diagnostic_services WHERE hospital_id='$hospital_id'";
                        $res = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($res) > 0){
                            while($row = mysqli_fetch_assoc($res)){
                                echo "<tr>
                                        <td>{$row['service_name']}</td>
                                        <td>{$row['regular_price']}/-</td>
                                        <td>{$row['discount_rate']}%</td>
                                        <td>{$row['discount_price']}/-</td>
                                        <td><a href='?service_delete_id={$row['service_id']}' onclick=\"return confirm('Are you sure?');\">Delete</a></td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='10'>No services found for this hospital</td></tr>";
                        }
                        ?>
                    </table>
                </div>

                <div style="display: block;">
                    <h3>Add Diagonstic Services</h3>
                    <form method="POST" enctype="multipart/form-data">
                        <input type="text" name="serviceName" placeholder="Service Name"><br>
                        <input type="number" name="regularPrice" placeholder="Regular Price"><br>
                        <input type="number" name="discountRate" placeholder="Discount Rate in %"><br>
                        <button type="submit" name="diagonstic_add">Add Service</button>
                    </form>
                </div>
            </div>
        </div>

        <div id="surgery" class="section">
            <div class="container">
                <div>
                    <h3>Surgery Packages List</h3>
                    <table style="border-collapse: collapse; width: 100%;">
                        <tr>
                            <th>Surgery Name</th>
                            <th>Price in word</th>
                            <th>Price in Standard</th>
                            <th>Price in Deluxe</th>
                            <th>Price in Suite</th>
                            <th>Duraiton of stay</th>
                            <th>Delete</th>
                        </tr>
                        <?php
                        $sql = "SELECT * FROM  surgery WHERE hospital_id='$hospital_id'";
                        $res = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($res) > 0){
                            while($row = mysqli_fetch_assoc($res)){
                                echo "<tr>
                                        <td>{$row['surgery_name']}</td>
                                        <td>{$row['price_in_word']}/-</td>
                                        <td>{$row['price_in_standard']}/-</td>
                                        <td>{$row['price_in_deluxe']}/-</td>
                                        <td>{$row['price_in_suite']}/-</td>
                                        <td>{$row['duration']}days</td>
                                        <td><a href='?surgery_delete_id={$row['surgery_id']}' onclick=\"return confirm('Are you sure?');\">Delete</a></td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='10'>No surgery found for this hospital</td></tr>";
                        }
                        ?>
                    </table>
                </div>

                <div style="display: block;">
                    <h3>Add Surgery Packages</h3>
                    <form method="POST" enctype="multipart/form-data">
                        <input type="text" name="surgeryName" placeholder="Surgery Name"><br>
                        <input type="number" name="priceInWord" placeholder="Price in word"><br>
                        <input type="number" name="priceInStandard" placeholder="Price in Standard"><br>
                        <input type="number" name="priceInDeluxe" placeholder="Price in Deluxe"><br>
                        <input type="number" name="priceInSuite" placeholder="Price in Suite"><br>
                        <input type="number" name="durationOfStay" placeholder="Duraiton of stay"><br>
                        <button type="submit" name="surgery_add">Add Service</button>
                    </form>
                </div>
            </div>
        </div>

        <div id="profile" class="section">
            <h2>Profile</h2>
        </div>
    </div>

    <div class="footer">
        <p>© 2025 HNMS. All Rights Reserved.</p>
        <p>Contact: support@hnms.com | Phone: +8801303672091</p>
    </div>
</div>

<script src="Dash.js"></script>

<!-- <script>

function showSection(id){
    const sections = document.querySelectorAll('.section');
    sections.forEach(s => s.style.display='none');
    document.getElementById(id).style.display='block';
}
</script> -->

</body>
</html>
