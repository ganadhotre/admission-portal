<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search Results</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
 .back-btn {
    position: absolute;
    top: 20px; /* Adjust as needed for your layout */
    left: 20px; /* Adjust as needed for your layout */
    padding: 10px 15px;
    background-color: #00A79D; /* Same color as the form button */
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px; /* Adjust as needed */
    text-align: center;
    line-height: 1; /* Centers the icon vertically */
    z-index: 10; /* Ensures the button is above other elements */
}

.back-btn:hover {
    background-color: #138496; /* Darker shade for hover effect */
}

.back-btn i {
    margin-right: 5px; /* Gives some space next to the arrow icon */
}

  </style>
</head>
<body>
  <div class="container">
    <h1>Search Results</h1>

    <button onclick="location.href='index.html'" class="back-btn">
        <i class="fa fa-arrow-left"></i>
    </button>
    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead class="thead-dark">
          <tr>
            <th>College Name</th>
            <th>Type</th>
            <th>City</th>
            <th>State</th>
            <th>Country</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Include the database connection file
          include 'db_connection.php';

          // Retrieve form data
          $country = isset($_GET['country']) ? $_GET['country'] : '';
          $state = isset($_GET['state']) ? $_GET['state'] : '';
          $city = isset($_GET['city']) ? $_GET['city'] : '';
          $type = isset($_GET['collegeType']) ? $_GET['collegeType'] : '';

          // Build SQL query
          $sql = "SELECT * FROM clg_data WHERE 1";

          // Add conditions based on form data
          if (!empty($country)) {
              $sql .= " AND country = '$country'";
          }
          if (!empty($state)) {
              $sql .= " AND state = '$state'";
          }
          if (!empty($city)) {
              $sql .= " AND city = '$city'";
          }
          if (!empty($type)) {
              $sql .= " AND type = '$type'";
          }

          // Execute query
          $result = $conn->query($sql);

          // Display results in table format
          if ($result === FALSE) {
              // Handle query execution error
              echo "Error executing query: " . $conn->error;
          } else {
              if ($result->num_rows > 0) {
                  // Output data of each row
                  while ($row = $result->fetch_assoc()) {
                      echo '<tr>';
                      echo '<td>' . $row["name"] . '</td>';
                      echo '<td>' . $row["type"] . '</td>';
                      echo '<td>' . $row["city"] . '</td>';
                      echo '<td>' . $row["state"] . '</td>';
                      echo '<td>' . $row["country"] . '</td>';
                      echo '</tr>';
                  }
              } else {
                  echo '<tr><td colspan="5">No colleges found matching the criteria.</td></tr>';
              }
          }

          // Close connection
          $conn->close();
          ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
