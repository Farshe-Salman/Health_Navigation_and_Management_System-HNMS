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

// =============showProfile=============

function showProfile() { 
    showSection("hospitalProfile"); 
    loadProfile(); 
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


// ==================== Doctor Inventory ====================
let doctors = [
  {
    id: 1,
    name: "Dr. Arif Rahman",
    specialization: "Cardiologist",
    phone: "01711111111",
    email: "arif@example.com",
    experience: 12,
    availability: "Mon-Fri, 10AM-5PM",
    documents: {
      photo: null,
      license: null,
      degree: null
    }
  },
  {
    id: 2,
    name: "Dr. Nabila Hasan",
    specialization: "Dermatologist",
    phone: "01722222222",
    email: "nabila@example.com",
    experience: 8,
    availability: "Sun-Thu, 9AM-3PM",
    documents: {
      photo: null,
      license: null,
      degree: null
    }
  }
];

// ==================== Open Add Doctor Section ====================
function openDoctorSection() {
  showSection("addDoctorSection");
}

// ==================== Add Doctor ====================
document.getElementById("addDoctorForm").addEventListener("submit", function (e) {
  e.preventDefault();

  const name = document.getElementById("doctorName").value.trim();
  const specialization = document.getElementById("doctorSpecialization").value.trim();
  const phone = document.getElementById("doctorPhone").value.trim();
  const email = document.getElementById("doctorEmail").value.trim();
  const experience = parseInt(document.getElementById("doctorExperience").value);
  const availability = document.getElementById("doctorAvailability").value.trim();

  const photo = document.getElementById("doctorPhoto").files[0];
  const license = document.getElementById("doctorLicense").files[0];
  const degree = document.getElementById("doctorDegree").files[0];

  // Validation
  if (!name || !specialization || !phone || !email || isNaN(experience) || !availability) {
    alert("⚠️ Please fill all required fields.");
    return;
  }
  if (!photo || !license || !degree) {
    alert("⚠️ Please upload all required documents.");
    return;
  }

  const newDoctor = {
    id: Date.now(),
    name,
    specialization,
    phone,
    email,
    experience,
    availability,
    documents: {
      photo: photo.name,
      license: license.name,
      degree: degree.name
    }
  };

  doctors.push(newDoctor);
  renderDoctors();

  document.getElementById("addDoctorForm").reset();
  showSection("doctor");
  alert("✅ Doctor added successfully.");
});

// ==================== Render Doctors ====================
function renderDoctors() {
  const container = document.getElementById("inventoryDoctorList");
  container.innerHTML = "";

  if (doctors.length === 0) {
    container.innerHTML = "<p>No doctors available. Add new doctors.</p>";
    return;
  }

  doctors.forEach((doc) => {
    const item = document.createElement("div");
    item.classList.add("doctor-item");

    item.innerHTML = `
      <div class="doctor-card">
        <img src="doctor.png" alt="${doc.name}">
        <h4>${doc.name}</h4>
        <p>Specialization: ${doc.specialization}</p>
        <p>Phone: ${doc.phone}</p>
        <p>Email: ${doc.email}</p>
        <p>Experience: ${doc.experience} years</p>
        <p>Availability: ${doc.availability}</p>
        <button class="edit-btn" onclick="editDoctor(${doc.id})">Edit</button>
        <button class="delete-btn" onclick="deleteDoctor(${doc.id})">Delete</button>
      </div>
    `;
    container.appendChild(item);
  });
}

// ==================== Delete Doctor ====================
function deleteDoctor(id) {
  doctors = doctors.filter(d => d.id !== id);
  renderDoctors();
}

// ==================== Edit Doctor ====================
function editDoctor(id) {
  const doc = doctors.find(d => d.id === id);
  if (!doc) {
    alert("Doctor not found!");
    return;
  }

  showSection("editDoctorSection");

  // Populate fields
  document.getElementById("editDoctorName").value = doc.name;
  document.getElementById("editDoctorSpecialization").value = doc.specialization;
  document.getElementById("editDoctorPhone").value = doc.phone;
  document.getElementById("editDoctorEmail").value = doc.email;
  document.getElementById("editDoctorExperience").value = doc.experience;
  document.getElementById("editDoctorAvailability").value = doc.availability;

  // Make all inputs editable (remove disabled)
  document.getElementById("editDoctorName").disabled = false;
  document.getElementById("editDoctorSpecialization").disabled = false;
  document.getElementById("editDoctorPhone").disabled = false;
  document.getElementById("editDoctorEmail").disabled = false;
  document.getElementById("editDoctorExperience").disabled = false;
  document.getElementById("editDoctorAvailability").disabled = false;

  // Enable file inputs
  document.getElementById("editDoctorPhoto").disabled = false;
  document.getElementById("editDoctorLicense").disabled = false;
  document.getElementById("editDoctorDegree").disabled = false;

  // Clear file inputs
  document.getElementById("editDoctorPhoto").value = "";
  document.getElementById("editDoctorLicense").value = "";
  document.getElementById("editDoctorDegree").value = "";

  const form = document.getElementById("editDoctorForm");
  form.onsubmit = function (e) {
    e.preventDefault();

    // Update doctor details
    doc.name = document.getElementById("editDoctorName").value.trim();
    doc.specialization = document.getElementById("editDoctorSpecialization").value.trim();
    doc.phone = document.getElementById("editDoctorPhone").value.trim();
    doc.email = document.getElementById("editDoctorEmail").value.trim();
    doc.experience = parseInt(document.getElementById("editDoctorExperience").value);
    doc.availability = document.getElementById("editDoctorAvailability").value.trim();

    const photo = document.getElementById("editDoctorPhoto").files[0];
    const license = document.getElementById("editDoctorLicense").files[0];
    const degree = document.getElementById("editDoctorDegree").files[0];

    if (photo) doc.documents.photo = photo.name;
    if (license) doc.documents.license = license.name;
    if (degree) doc.documents.degree = degree.name;

    renderDoctors();
    showSection("doctor");
    alert("✅ Doctor updated successfully!");
  };
}


// ==================== Init ====================
renderDoctors();

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



// ==================== Hospital Profile ====================
let hospitalProfile = {
    username: "user123",
    hospitalName: "City Hospital",
    email: "cityhospital@example.com",
    phone: "01712345678",
    address: "Dhaka, Bangladesh",
    category: "general",
    facilities: ["ICU", "Emergency", "Pharmacy", "Lab"],
    profileImage: ""
};

// Show hospital profile and load data
function showHospitalProfile() {
    showSection("hospitalProfile");
    loadHospitalProfile();
}

function loadHospitalProfile() {
    document.getElementById("username").value = hospitalProfile.username;
    document.getElementById("hospitalName").value = hospitalProfile.hospitalName;
    document.getElementById("hospitalEmail").value = hospitalProfile.email;
    document.getElementById("hospitalPhone").value = hospitalProfile.phone;
    document.getElementById("hospitalAddress").value = hospitalProfile.address;
    document.getElementById("hospitalCategory").value = hospitalProfile.category;
    
    // Load facilities checkboxes
    const checkboxes = document.querySelectorAll('#hospitalFacilities input[type="checkbox"]');
    checkboxes.forEach(cb => {
        cb.checked = hospitalProfile.facilities.includes(cb.value);
    });

    // Load profile image
    if(hospitalProfile.profileImage) {
        document.getElementById("profileImagePreview").src = hospitalProfile.profileImage;
    }
}

// ===========Enable all hospital fields (profile + facilities + verification docs)============
function enableAllHospitalFields() {
  // Enable all inputs and selects except username
  document.querySelectorAll('#hospitalProfileForm input, #hospitalProfileForm select').forEach(el => {
    if (el.id !== 'username'&& el.id !== 'hospitalEmail') el.disabled = false;
  });

  // Enable all checkboxes
  document.querySelectorAll('#hospitalFacilities input[type="checkbox"]').forEach(cb => cb.disabled = false);

  // Enable all file inputs
  document.querySelectorAll('#verificationDocsContainer input[type="file"]').forEach(fileInput => fileInput.disabled = false);

  alert("You can now edit the hospital profile!");
}

// =============Save hospital profile===============
document.getElementById("hospitalProfileForm").addEventListener("submit", function(e){
    e.preventDefault();

    hospitalProfile.hospitalName = document.getElementById("hospitalName").value;
    hospitalProfile.phone = document.getElementById("hospitalPhone").value;
    hospitalProfile.address = document.getElementById("hospitalAddress").value;
    hospitalProfile.category = document.getElementById("hospitalCategory").value;

    // Save facilities
    const facilities = [];
    const checkboxes = document.querySelectorAll('#hospitalFacilities input[type="checkbox"]:checked');
    checkboxes.forEach(cb => facilities.push(cb.value));
    hospitalProfile.facilities = facilities;

    alert("Hospital profile updated successfully!");

    // Disable fields again
    const inputs = document.querySelectorAll('#hospitalProfileForm input, #hospitalProfileForm select');
    inputs.forEach(el => { if(el.id !== 'username') el.disabled = true; });
    const allCheckboxes = document.querySelectorAll('#hospitalFacilities input[type="checkbox"]');
    allCheckboxes.forEach(cb => cb.disabled = true);
    const verificationFiles = document.querySelectorAll('#verificationDocsContainer input[type="file"]');
    verificationFiles.forEach(fileInput => fileInput.disabled = true);
});

// ==================== Uploads & Previews ====================
const profileImageInput = document.getElementById('profileImageInput');
const profileImagePreview = document.getElementById('profileImagePreview');

const fileInputs = {
    license: document.getElementById('licenseFile'),
    accreditation: document.getElementById('accreditationFile'),
    vat: document.getElementById('vatFile')
};

const statusSpans = {
    license: document.getElementById('docLicenseStatus'),
    accreditation: document.getElementById('docAccreditationStatus'),
    vat: document.getElementById('docVATStatus')
};

// ==================== Unified Upload Function ====================
function uploadProfileDoc(type) {
    if (type === 'profileImage') {
        profileImageInput.click();
        return;
    }

    const fileInput = fileInputs[type];
    const statusSpan = statusSpans[type];

    if (!fileInput || !statusSpan) return;

    fileInput.click();
    fileInput.onchange = () => {
        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];
            const allowedTypes = ['application/pdf','image/jpeg','image/png','image/gif'];
            if (allowedTypes.includes(file.type)) {
                statusSpan.innerText = '✅ Uploaded';
            } else {
                statusSpan.innerText = '❌ Invalid file type';
                fileInput.value = "";
            }
        } else {
            statusSpan.innerText = '❌ Not Uploaded';
        }
    };
}

// ==================== Profile Image Preview ====================
profileImageInput.addEventListener('change', e => {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = ev => {
            profileImagePreview.src = ev.target.result;
            hospitalProfile.profileImage = ev.target.result;
        };
        reader.readAsDataURL(file);
    }
});
function updateDashboard() {
    // Example: Update navbar name and notifications
    document.getElementById('navbarProfileName').textContent = hospitalProfile.hospitalName;
    notificationCount.textContent = appointments.length;
}

// ==================== Initialize ====================
updateDashboard();
