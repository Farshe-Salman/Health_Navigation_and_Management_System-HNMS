<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <!-- Dashboard -->
      <div id="dashboard" class="section" style="display:block;">
        <div class="welcome-banner">
          <h2>Quick overview of your health activities</h2>
        </div>
        <div class="dashboard-cards">
          <div class="card">
            <h3>Upcoming Appointments</h3>
            <ul id="appointmentsList">
              <li>No appointments scheduled.</li>
            </ul>
          </div>
          <div class="card">
            <h3>Nearest Hospital / Pharmacy</h3>
            <iframe src="https://www.google.com/maps/embed/v1/search?q=hospitals+near+me&key=YOUR_GOOGLE_MAPS_API_KEY"
              width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
          </div>
          <div class="card">
            <h3>Health Tips</h3>
            <ul>
              <li>Stay hydrated by drinking at least 8 glasses of water daily.</li>
              <li>Incorporate at least 30 minutes of exercise into your daily routine.</li>
              <li>Eat a balanced diet rich in fruits, vegetables, and whole grains.</li>
              <li>Ensure you get 7-8 hours of quality sleep each night.</li>
              <li>Practice stress-relief techniques such as meditation or deep breathing.</li>
            </ul>
          </div>
        </div>
      </div>
</body>
</html>