// ==================== Sidebar & Dashboard ====================
const sidebar = document.getElementById('sidebar');
const appointmentsList = document.getElementById('appointmentsList');
const notificationCount = document.getElementById('notificationCount');
let appointments = [];

function toggleSidebar() {
    sidebar.classList.toggle("show");
}

function showSection(sectionId, event) {
    document.querySelectorAll(".section").forEach(sec => sec.style.display = "none");
    const sec = document.getElementById(sectionId);
    if (sec) sec.style.display = "block";

    document.querySelectorAll(".sidebar a").forEach(link => link.classList.remove("active"));
    if (event && event.currentTarget) event.currentTarget.classList.add("active");

    if (window.innerWidth <= 768) sidebar.classList.remove("show");
}

// ==================== Dashboard Appointments ====================
function updateDashboard() {
    appointmentsList.innerHTML = appointments.length
        ? appointments.map(a => `<li>${a}</li>`).join('')
        : '<li>No appointments scheduled.</li>';
    notificationCount.textContent = appointments.length;
}

// ========================Notifications========================
function showNotifications() {
    const panel = document.getElementById("notificationsPanel");
    const list = document.getElementById("notificationsList");
    if (appointments.length) {
        list.innerHTML = appointments.map((a, index) => `
            <div class="notification-item">
                <strong>${index + 1}. ${a}</strong>
                <span class="date">${new Date().toLocaleDateString()}</span>
            </div>`).join('');
    } else {
        list.innerHTML = `<div class="notification-item">No notifications at the moment.</div>`;
    }
    panel.style.display = "flex";
}

document.getElementById("closeNotifications")?.addEventListener("click", () => {
    document.getElementById("notificationsPanel").style.display = "none";
});

//=====================book appoinments validation=================
const appointmentForm = document.getElementById("appointmentForm");

// Helper functions
function showError(id, message) {
  document.getElementById(id).textContent = message;
}

function clearError(id) {
  document.getElementById(id).textContent = "";
}

// Validation functions
function validateHospital() {
  const val = document.getElementById("hospitalSelect").value.trim();
  if (!val) {
    showError("hospitalError", "Please select a hospital.");
    return false;
  }
  clearError("hospitalError");
  return true;
}

function validateName() {
  const val = document.getElementById("patientName").value.trim();
  if (!val) {
    showError("nameError", "Name is required.");
    return false;
  } else if (!/^[a-zA-Z\s]+$/.test(val)) {
    showError("nameError", "Only letters allowed.");
    return false;
  }
  clearError("nameError");
  return true;
}

function validateDOB() {
  const val = document.getElementById("dob").value;
  if (!val) {
    showError("dobError", "Date of birth is required.");
    return false;
  }
  clearError("dobError");
  return true;
}

function validateGender() {
  const val = document.getElementById("gender").value.trim();
  if (!val) {
    showError("genderError", "Please select gender.");
    return false;
  }
  clearError("genderError");
  return true;
}

function validateContact() {
  const val = document.getElementById("contact").value.trim();
  if (!val) {
    showError("contactError", "Contact number is required.");
    return false;
  } else if (!/^\+8801[0-9]{9}$/.test(val)) {
    showError("contactError", "Must be a valid Bangladeshi number (+8801XXXXXXXXX).");
    return false;
  }
  clearError("contactError");
  return true;
}

function validateDoctor() {
  const val = document.getElementById("doctorSelect").value.trim();
  if (!val) {
    showError("doctorError", "Please select a doctor.");
    return false;
  }
  clearError("doctorError");
  return true;
}

function validateAppointmentDate() {
  const val = document.getElementById("appointmentDate").value;
  if (!val) {
    showError("appointmentDateError", "Please select appointment date.");
    return false;
  }
  clearError("appointmentDateError");
  return true;
}

// Real-time validation
document.getElementById("hospitalSelect").addEventListener("change", validateHospital);
document.getElementById("patientName").addEventListener("input", validateName);
document.getElementById("dob").addEventListener("change", validateDOB);
document.getElementById("gender").addEventListener("change", validateGender);
document.getElementById("contact").addEventListener("input", validateContact);
document.getElementById("doctorSelect").addEventListener("change", validateDoctor);
document.getElementById("appointmentDate").addEventListener("change", validateAppointmentDate);

// Submit event
appointmentForm.addEventListener("submit", function(e) {
  e.preventDefault();

  // Validate all fields
  const hospitalValid = validateHospital();
  const nameValid = validateName();
  const dobValid = validateDOB();
  const genderValid = validateGender();
  const contactValid = validateContact();
  const doctorValid = validateDoctor();
  const appointmentDateValid = validateAppointmentDate();

  // If any field invalid, prevent submit
  if (!hospitalValid || !nameValid || !dobValid || !genderValid ||
      !contactValid || !doctorValid || !appointmentDateValid) {
    const firstError = document.querySelector(".error-text:not(:empty)");
    if (firstError) firstError.scrollIntoView({ behavior: "smooth" });
    return; // stop submission
  }

  // All valid – Add appointment to dashboard
  const patientName = document.getElementById("patientName").value.trim();
  const hospital = document.getElementById("hospitalSelect").value.trim();
  const doctor = document.getElementById("doctorSelect").value.trim();
  const date = document.getElementById("appointmentDate").value;
  const time = document.getElementById("appointmentTime").value;

  const appointmentText = `${patientName} at ${hospital} with ${doctor} on ${date} ${time}`;
  appointments.push(appointmentText);
  updateDashboard();

  alert("Appointment submitted successfully!");
  this.reset();
});

// ==================== Hospital Search ====================
async function searchHospitalAjax() {
  try {
    const keyword = document.getElementById('searchHospitals').value;
    const res = await fetch(`../controller/hospital_search.php?keyword=${encodeURIComponent(keyword)}`);
    document.getElementById('hospitalList').innerHTML = await res.text();
  } catch (err) {
    console.error("Error fetching hospitals:", err);
  }
}

// ==================== Doctor Search ====================
async function searchDoctorAjax() {
  try {
    const keyword = document.getElementById('searchDoctor').value;
    const specialization = document.getElementById('doctorDepartment').value;

    const res = await fetch(
      `../controller/doctor_search.php?keyword=${encodeURIComponent(keyword)}&specialization=${encodeURIComponent(specialization)}`
    );

    document.getElementById('doctorList').innerHTML = await res.text();
  } catch (err) {
    console.error("Error fetching doctors:", err);
  }
}

document.getElementById('searchDoctor')?.addEventListener('keyup', searchDoctorAjax);
document.getElementById('doctorDepartment')?.addEventListener('change', searchDoctorAjax);

// ==================== Load on Page ====================
window.addEventListener('DOMContentLoaded', () => {
    searchHospitalAjax();
    searchDoctorAjax();
    loadAppointments(); 
    loadHistory();
});

// ==================== Change Password ====================
// Toggle password visibility
    function togglePassword(fieldId) {
      const input = document.getElementById(fieldId);
      const toggle = input.nextElementSibling;
      if (input.type === "password") {
        input.type = "text";
        toggle.textContent = "Hide";
      } else {
        input.type = "password";
        toggle.textContent = "Show";
      }
    }

    // Real-time validation
    const currentPassword = document.getElementById("currentPassword");
    const newPassword = document.getElementById("newPassword");
    const confirmPassword = document.getElementById("confirmPassword");

    const currentError = document.getElementById("currentError");
    const newError = document.getElementById("newError");
    const confirmError = document.getElementById("confirmError");
    const message = document.getElementById("passwordMessage");

    function validateCurrent() {
      if (!currentPassword.value.trim()) {
        currentError.textContent = "Current password is required.";
      } else {
        currentError.textContent = "";
      }
    }

   function validateNew() {
  const newVal = newPassword.value.trim();

  if (!newVal) {
    newError.textContent = "New password is required.";
  } 
  else if (
    newVal.length < 6 ||               
    !/[A-Z]/.test(newVal) ||          
    !/[a-z]/.test(newVal) ||          
    !/\d/.test(newVal) ||         
    !/[@$!%*?&]/.test(newVal)         
  ) {
    newError.textContent = "Password must include upper, lower, number, special char & 6+ chars.";
  } 
  else if (newVal === currentPassword.value.trim() && newVal !== "") {
    newError.textContent = "New password cannot be the same as current.";
  } 
  else {
    newError.textContent = "";
  }

  validateConfirm(); 
}


    function validateConfirm() {
      const newVal = newPassword.value.trim();
      const confirmVal = confirmPassword.value.trim();
      if (!confirmVal) {
        confirmError.textContent = "Confirm password is required.";
      } else if (newVal !== confirmVal) {
        confirmError.textContent = "Passwords do not match.";
      } else {
        confirmError.textContent = "";
      }
    }

    // Attach real-time events
    currentPassword.addEventListener("input", validateCurrent);
    newPassword.addEventListener("input", validateNew);
    confirmPassword.addEventListener("input", validateConfirm);

    // On form submit
    document.getElementById("changePasswordForm").addEventListener("submit", function(e) {
      e.preventDefault();

      validateCurrent();
      validateNew();
      validateConfirm();

      if (!currentError.textContent && !newError.textContent && !confirmError.textContent) {
        message.textContent = "Password updated successfully!";
        message.style.color = "green";
        this.reset();
      } else {
        message.textContent = "Please fix the errors above.";
        message.style.color = "red";
      }
    });


// Sample appointments data
let my_appointments = [
    { id: 1, doctor: "Dr. Smith", department: "Cardiology", hospital: "City Hospital", address: "123 Main St", date: "2025-09-20", time: "10:00 AM", status: "Confirmed" },
    { id: 2, doctor: "Dr. Jane", department: "Dermatology", hospital: "Green Clinic", address: "45 Park Ave", date: "2025-09-22", time: "02:30 PM", status: "Pending" },
    { id: 3, doctor: "Dr. John", department: "Neurology", hospital: "Central Hospital", address: "78 High St", date: "2025-09-25", time: "11:15 AM", status: "Cancelled" }
];

function loadAppointments() {
    const tbody = document.getElementById("appointmentsBody");
    tbody.innerHTML = "";

    my_appointments.forEach((app, index) => {
        let statusClass = app.status.toLowerCase();
        tbody.innerHTML += `
            <tr>
                <td>${index + 1}</td>
                <td>${app.doctor}</td>
                <td>${app.department}</td>
                <td>${app.hospital}</td>
                <td>${app.address}</td>
                <td>${app.date}</td>
                <td>${app.time}</td>
                <td><span class="status-${statusClass}">${app.status}</span></td>
                <td>
                    <button class="app-btn app-btn-view" onclick="viewAppointment(${app.id})">View</button>
                    <button class="app-btn app-btn-cancel" onclick="cancelAppointment(${app.id})">Cancel</button>
                </td>
            </tr>
        `;
    });
}

function viewAppointment(id){
    alert("View details for appointment #" + id);
}

function cancelAppointment(id){
    alert("Cancel appointment #" + id);
}

// Show the appointments section
function showAppointments(){
    showSection("appointmentsSection"); 
    loadAppointments();
}

// ================Sample patient history data=================
// Sample history data
let my_history = [
    { id: 1, doctor: "Dr. Smith", department: "Cardiology", hospital: "City Hospital", address: "123 Main St", date: "2025-01-15", diagnosis: "Hypertension", treatment: "Medication", status: "Completed" },
    { id: 2, doctor: "Dr. Jane", department: "Dermatology", hospital: "Green Clinic", address: "45 Park Ave", date: "2025-03-10", diagnosis: "Acne", treatment: "Topical Cream", status: "Completed" },
    { id: 3, doctor: "Dr. John", department: "Neurology", hospital: "Central Hospital", address: "78 High St", date: "2025-08-05", diagnosis: "Migraine", treatment: "Prescription", status: "Ongoing" }
];

function loadHistory() {
    const tbody = document.getElementById("historyBody");
    tbody.innerHTML = "";

    my_history.forEach((item, index) => {
        let statusClass = item.status.toLowerCase();
        tbody.innerHTML += `
            <tr>
                <td>${index + 1}</td>
                <td>${item.doctor}</td>
                <td>${item.department}</td>
                <td>${item.hospital}</td>
                <td>${item.address}</td>
                <td>${item.date}</td>
                <td>${item.diagnosis}</td>
                <td>${item.treatment}</td>
                <td><span class="status-${statusClass}">${item.status}</span></td>
            </tr>
        `;
    });
}

function showHistory() {
    showSection("historySection");
    loadHistory();
}

// ==================== Patient Profile ====================
let patientProfile = { 
    username: "user123",
    name: "Shizan Sarkar", 
    email: "shizan@example.com", 
    phone: "01712345678" 
};

function showProfile() { 
    showSection("profileSection"); 
    loadProfile(); 
}

function loadProfile() {
    document.getElementById("profileName").value = patientProfile.name;
    document.getElementById("profileEmail").value = patientProfile.email;
    document.getElementById("username").value = patientProfile.username;
    document.getElementById("profilePhone").value = patientProfile.phone;
    document.getElementById("navbarProfileName").innerText = patientProfile.name;
}

function enableAllFields() {
    // Enable all fields except username and email
    document.querySelectorAll('#profileForm input, #profileForm select').forEach(el => {
        if(el.id !== 'username' && el.id !== 'profileEmail'){
            el.removeAttribute('disabled');
        }
    });
    alert("You can now edit your profile!");
}

// Save profile
document.getElementById("profileForm").addEventListener("submit", function (e) {
    e.preventDefault();
    patientProfile.name = document.getElementById("profileName").value;
    patientProfile.phone = document.getElementById("profilePhone").value;
    document.getElementById("navbarProfileName").innerText = patientProfile.name;
    alert("Profile updated successfully!");

    // Disable editable fields again
    document.querySelectorAll('#profileForm input, #profileForm select').forEach(el => {
        if(el.id !== 'username' && el.id !== 'profileEmail'){
            el.setAttribute('disabled', true);
        }
    });
});

// ==================== Profile Image Upload ====================
const profileImageInput = document.getElementById('profileImageInput');
const profileImagePreview = document.getElementById('profileImagePreview');

function uploadProfileDoc(type){
    if(type === 'profileImage'){
        profileImageInput.click(); 
    }
}

profileImageInput.addEventListener('change', e => {
    const file = e.target.files[0];
    if(file){
        const reader = new FileReader();
        reader.onload = ev => {
            profileImagePreview.src = ev.target.result;
            patientProfile.profileImage = ev.target.result;
        };
        reader.readAsDataURL(file);
    }
});

// ================= Profile Age ====================
const profileDOB = document.getElementById('profileDOB');
const profileAge = document.getElementById('profileAge');

function calculateAge(dob){
    const birthDate = new Date(dob);
    const today = new Date();
    let age = today.getFullYear() - birthDate.getFullYear();
    const monthDiff = today.getMonth() - birthDate.getMonth();
    if(monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) age--;
    return age;
}

if(profileDOB && profileAge){
    profileAge.value = calculateAge(profileDOB.value);
    profileDOB.addEventListener('change', ()=> profileAge.value = calculateAge(profileDOB.value));
}

// ==================== Initialize ====================
updateDashboard();
