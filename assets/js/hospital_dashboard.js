// ==================== Sidebar & Dashboard ====================
const sidebar = document.getElementById('sidebar');
const appointmentsList = document.getElementById('appointmentsList');
const notificationCount = document.getElementById('notificationCount');
let appointments = [];

// Toggle sidebar
function toggleSidebar() {
    sidebar.classList.toggle("show");
}

// Show/hide sections
function showSection(sectionId, event) {
    document.querySelectorAll(".section").forEach(sec => sec.style.display = "none");
    const sec = document.getElementById(sectionId);
    if (sec) sec.style.display = "block";

    document.querySelectorAll(".sidebar a").forEach(link => link.classList.remove("active"));
    if (event && event.currentTarget) event.currentTarget.classList.add("active");

    if (window.innerWidth <= 768) sidebar.classList.remove("show");
}

// ======================== Notifications ========================
function showNotifications() {
    const panel = document.getElementById("notificationsPanel");
    const list = document.getElementById("notificationsList");

    if (appointments.length) {
        list.innerHTML = appointments.map((a, index) => `
            <div class="notification-item">
                <strong>${index + 1}. ${a}</strong>
                <span class="date">${new Date().toLocaleDateString()}</span>
            </div>
        `).join('');
    } else {
        list.innerHTML = `<div class="notification-item">No notifications at the moment.</div>`;
    }
    panel.style.display = "flex";
}

document.getElementById("closeNotifications")?.addEventListener("click", () => {
    document.getElementById("notificationsPanel").style.display = "none";
});

// ==================== Doctor Inventory ====================
// Doctors now come from PHP (via data attributes), not from JS arrays

function openDoctorSection() {
    showSection("addDoctorSection");
}

// Delete doctor (redirect to backend delete)
function deleteDoctor(id) {
    if (confirm("Are you sure you want to delete this doctor?")) {
        window.location.href = `delete_doctor.php?id=${id}`;
    }
}
// =================Edit Doctor ====================
// Open edit form and preload doctor data
function editDoctor(button) {
    const doctorItem = button.closest(".doctor-item");
    if (!doctorItem) return;

    // Parse doctor data stored in data-doctor attribute
    const doctorData = JSON.parse(doctorItem.querySelector(".doctor-card").dataset.doctor);

    // Show the edit section
    showSection("editDoctorSection");

    // Fill values into inputs
    document.getElementById("editDoctorId").value = doctorData.doctor_id || '';
    document.getElementById("editDoctorName").value = doctorData.doctor_name || '';
    document.getElementById("editDoctorEmail").value = doctorData.email || '';
    document.getElementById("editDoctorPhone").value = doctorData.contact || '';
    document.getElementById("editDoctorSpecialization").value = doctorData.specialization || '';
    document.getElementById("editDoctorQualification").value = doctorData.qualification || '';
    document.getElementById("editDoctorExperience").value = doctorData.experience_years || '';
    document.getElementById("editconsultantfee").value = doctorData.consultation_fee || '';
    document.getElementById("editDoctorStartTime").value = doctorData.start_time || '';
    document.getElementById("editDoctorEndTime").value = doctorData.end_time || '';

    // Pre-check availability days
    const days = (doctorData.schedule_days || '').split(',').map(d => d.trim());
    document.querySelectorAll("#editDoctorSection input[type='checkbox']").forEach(cb => {
        cb.checked = days.includes(cb.value);
    });

    // Disable all fields initially
    document.querySelectorAll("#editDoctorSection input, #editDoctorSection select").forEach(input => {
        input.disabled = true;
    });
}

// Enable all inputs for editing when "Edit" button is clicked
function enableAllEditFields() {
    document.querySelectorAll("#editDoctorSection input, #editDoctorSection select").forEach(input => {
        input.disabled = false; // now username and password are also editable
    });
}



// ==================== Doctor Search ====================
async function searchDoctorAjax() {
  try {
    const keyword = document.getElementById('searchDoctors').value; // FIXED
    const res = await fetch(
      `../controller/hdash_doctor_search.php?keyword=${encodeURIComponent(keyword)}`
    );

    document.getElementById('inventoryDoctorList').innerHTML = await res.text(); // FIXED
  } catch (err) {
    console.error("Error fetching doctors:", err);
  }
}

document.getElementById('searchDoctors')?.addEventListener('keyup', searchDoctorAjax);


// ==================== Toggle Password ====================
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


// ==================== Hospital Profile Load ====================
function showHospitalProfile() { 
    showSection("hospitalProfile"); 
    loadHospitalProfile(); 
}

function loadHospitalProfile() {
    document.getElementById("username").value = hospitalProfile.username || "";
    document.getElementById("hospitalName").value = hospitalProfile.hospitalName || "";
    document.getElementById("hospitalEmail").value = hospitalProfile.email || "";
    document.getElementById("hospitalPhone").value = hospitalProfile.phone || "";
    document.getElementById("hospitalAddress").value = hospitalProfile.address || "";
    document.getElementById("hospitalCategory").value = hospitalProfile.category || "";

    // Set facilities checkboxes
    const checkboxes = document.querySelectorAll('#hospitalFacilities input[type="checkbox"]');
    checkboxes.forEach(cb => cb.checked = hospitalProfile.facilities?.includes(cb.value) || false);

    // Set profile image
    document.getElementById("profileImagePreview").src = hospitalProfile.profileImage || "default-profile.png";

    // Optional: update document placeholders if files are loaded
    if (hospitalProfile.licenseFile) {
        document.getElementById("licenseFilePlaceholder").value = hospitalProfile.licenseFile;
    }
    if (hospitalProfile.accreditationFile) {
        document.getElementById("accreditationFilePlaceholder").value = hospitalProfile.accreditationFile;
    }
    if (hospitalProfile.vatFile) {
        document.getElementById("vatFilePlaceholder").value = hospitalProfile.vatFile;
    }
}


// ==================== Edit Hospital Profile Fields ====================
function disableAllHospitalFields() {
    // Disable all inputs, selects, textareas including file upload buttons
    document.querySelectorAll('#hospitalProfileForm input, #hospitalProfileForm select, #verificationDocsContainer input, #verificationDocsContainer button').forEach(el => {
        // Keep Edit button enabled
        if (!el.classList.contains('edit-btn')) {
            el.setAttribute('disabled', true);
        }
    });
}

function enableAllHospitalFields() {
    // Enable all inputs, selects, and file upload buttons except the username
    document.querySelectorAll('#hospitalProfileForm input, #hospitalProfileForm select, #verificationDocsContainer input, #verificationDocsContainer button').forEach(el => {
        if (el.id !== "username" && !el.classList.contains('edit-btn')) {
            el.removeAttribute('disabled');
        }
    });

    alert("You can now edit the hospital profile!");
}

// Run on page load
window.onload = disableAllHospitalFields;

// ==================== Uploads & Previews ====================
const profileImageInput = document.getElementById('profileImageInput');
const profileImagePreview = document.getElementById('profileImagePreview');

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

// ==================== Dashboard Update ====================
function updateDashboard() {
    document.getElementById('navbarProfileName').textContent = hospitalProfile.hospitalName;
    notificationCount.textContent = appointments.length;

    const totalDoctors = document.querySelectorAll("#inventoryDoctorList .doctor-item").length;
    document.getElementById("totalDoctors").textContent = totalDoctors;
    document.getElementById("totalAppointments").textContent = appointments.length;
}

// ==================== Initialize ====================
document.addEventListener("DOMContentLoaded", () => {
    updateDashboard();
    searchDoctorAjax();
});
