/* Dash.js */

// Sidebar & Dashboard Elements
const sidebar = document.getElementById('sidebar');
const appointmentsList = document.getElementById('appointmentsList');
const notificationCount = document.getElementById('notificationCount');
let appointments = [];

// Toggle Sidebar
function toggleSidebar() {
  sidebar.classList.toggle('show');
}

// Show Section & Highlight Sidebar Link
function showSection(sectionId, event) {
  document.querySelectorAll('.section').forEach(sec => sec.style.display = 'none');
  document.getElementById(sectionId).style.display = 'block';

  document.querySelectorAll('.sidebar a').forEach(link => link.classList.remove('active'));
  if(event) event.currentTarget.classList.add('active');

  if(window.innerWidth <= 768) toggleSidebar();
}

// Update Dashboard Appointments & Notification Count
function updateDashboard() {
  appointmentsList.innerHTML = appointments.length
    ? appointments.map(a => `<li>${a}</li>`).join('')
    : '<li>No appointments scheduled.</li>';
  
  notificationCount.textContent = appointments.length;
}

// Show Notifications
function showNotifications() {
  if (appointments.length) {
    alert(`You have ${appointments.length} notifications:\n` + appointments.join('\n'));
  } else {
    alert("No notifications at the moment.");
  }
}


// Handle Appointment Form Submission
document.getElementById("appointmentForm").addEventListener("submit", function(e){
  e.preventDefault();
  const patientName = document.getElementById("patientName").value;
  const doctor = document.getElementById("doctorSelect").value;
  const date = document.getElementById("appointmentDate").value;
  const time = document.getElementById("appointmentTime").value;

  appointments.push(`${patientName} with ${doctor} on ${date} at ${time}`);
  updateDashboard();
  alert("Your appointment request has been submitted!");
  showSection('dashboard');
  this.reset();
});

//Settings
const settings = document.querySelector('.settings');

// Settings click (e.g., Change Password)
if(settings) {
  settings.addEventListener('click', () => {
    // Replace alert with your password page
    alert("Redirect to Change Password page.");
    // window.location.href = "change-password.html";
  });
}



// Initial Dashboard Update
updateDashboard();
