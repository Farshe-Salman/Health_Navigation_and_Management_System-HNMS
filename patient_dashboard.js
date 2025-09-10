// ==================== Sidebar & Dashboard Elements ====================
const sidebar = document.getElementById('sidebar');
const appointmentsList = document.getElementById('appointmentsList');
const notificationCount = document.getElementById('notificationCount');
let appointments = [];

// ==================== Hospital → Doctor mapping ====================
const hospitalDoctors = {
  "City General Hospital": ["Dr. Sarah Khan", "Dr. Sarkar Md. Shizan", "Dr. Michael Brown"],
  "Sunrise Diagnostics": ["Dr. John Smith", "Dr. Emily Davis"]
};

const doctorDetails = {
  "Dr. Sarkar Md. Shizan": { hospital: "City General Hospital", speciality: "ENT & Head Neck Surgery" },
  "Dr. Michael Brown": { hospital: "City General Hospital", speciality: "Orthopedics" },
  "Dr. John Smith": { hospital: "Sunrise Diagnostics", speciality: "Neurology" },
  "Dr. Emily Davis": { hospital: "Sunrise Diagnostics", speciality: "Dermatology" },
  "Dr. Sarah Khan": { hospital: "City General Hospital", speciality: "Cardiology Care Centre" }
};


// ==================== Sidebar ====================
function toggleSidebar() {
  sidebar.classList.toggle("show");
}

function showSection(sectionId, event) {
  // Hide all sections
  document.querySelectorAll(".section").forEach(sec => sec.style.display = "none");

  // Show the requested section
  const sec = document.getElementById(sectionId);
  if (sec) sec.style.display = "block";

  // Update active sidebar link
  document.querySelectorAll(".sidebar a").forEach(link => link.classList.remove("active"));
  if (event && event.currentTarget) event.currentTarget.classList.add("active");

  // On mobile, hide sidebar after clicking a link
  if (window.innerWidth <= 768) {
    sidebar.classList.remove("show"); // instead of toggleSidebar()
  }
}

// ==================== Dashboard Appointments ====================
function updateDashboard() {
  appointmentsList.innerHTML = appointments.length
    ? appointments.map(a => `<li>${a}</li>`).join('')
    : '<li>No appointments scheduled.</li>';
  
  notificationCount.textContent = appointments.length;
}

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

document.getElementById("closeNotifications").addEventListener("click", () => {
  document.getElementById("notificationsPanel").style.display = "none";
});

// ==================== Doctor Appointment Logic ====================
function updateDoctors(hospitalName) {
  const doctorSelect = document.getElementById("doctorSelect");
  doctorSelect.innerHTML = "<option value=''>Select Doctor</option>";
  if (hospitalDoctors[hospitalName]) {
    hospitalDoctors[hospitalName].forEach(doctor => {
      let option = document.createElement("option");
      option.value = doctor;
      option.textContent = doctor;
      doctorSelect.appendChild(option);
    });
  }
}

document.getElementById("hospitalSelect").addEventListener("change", function() {
  updateDoctors(this.value);
});

document.getElementById("appointmentForm").addEventListener("submit", function(e) {
  e.preventDefault();
  const hospital = document.getElementById("hospitalSelect").value;
  const patientName = document.getElementById("patientName").value;
  const doctor = document.getElementById("doctorSelect").value;
  const date = document.getElementById("appointmentDate").value;
  const time = document.getElementById("appointmentTime").value;

  appointments.push(`${patientName} at ${hospital} with ${doctor} on ${date} at ${time}`);
  updateDashboard();
  alert("Your appointment request has been submitted!");
  showSection('dashboard');
  this.reset();
  updateDoctors("");
  document.getElementById("hospitalSelect").disabled = false;
});

function bookAppointmentFromHospital(hospitalName) {
  showSection('appointments');
  const hospitalSelect = document.getElementById("hospitalSelect");
  hospitalSelect.value = hospitalName;
  hospitalSelect.disabled = true;
  updateDoctors(hospitalName);
}

function showAppointmentSection() {
  showSection('appointments');
  const hospitalSelect = document.getElementById("hospitalSelect");
  hospitalSelect.disabled = false;
  hospitalSelect.value = "";
  updateDoctors("");
}

// Booking from doctor card
document.querySelectorAll('.doctor-card .btn-primary').forEach(button => {
  button.addEventListener('click', (e) => {
    const doctorCard = e.currentTarget.closest('.doctor-card');
    const doctorName = doctorCard.querySelector('h4').textContent;
    if (doctorDetails[doctorName]) {
      const details = doctorDetails[doctorName];
      showSection('appointments');
      const hospitalSelect = document.getElementById("hospitalSelect");
      hospitalSelect.value = details.hospital;
      hospitalSelect.disabled = true;
      updateDoctors(details.hospital);
      document.getElementById("doctorSelect").value = doctorName;
      document.getElementById("speciality").value = details.speciality;
    }
  });
});

// ==================== Change Password ====================
document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("changePasswordForm");
  if (form) {
    form.addEventListener("submit", function(e) {
      e.preventDefault();
      form.reset();
      alert("Password change functionality is not implemented in this demo.");
    });
  }
});

// ==================== Pharmacy & Cart ====================
let cart = [];
let currentPharmacy = null;

const pharmacyMedicines = {
  "City Pharmacy": [
    { name: "Paracetamol", price: 20, img: "image.png" },
    { name: "Amoxicillin", price: 120, img: "image.png" },
    { name: "Cetirizine", price: 30, img: "image.png" },
    { name: "Insulin", price: 550, img: "image.png" }
  ],
  "Lazz Pharmacy": [
    { name: "ORS Saline", price: 15, img: "med5.jpg" },
    { name: "Vitamin C", price: 50, img: "med6.jpg" }
  ],
  "Tamanna Pharmacy": [
    { name: "Paracetamol", price: 20, img: "med7.jpg" }
  ]
};

// Open medicine catalog
function openMedicineCatalog(pharmacyName) {
  currentPharmacy = pharmacyName;
  showSection("pharmacyMedicinesSection");

  document.getElementById("medSectionTitle").innerText = `${pharmacyName} - Medicines`;

  renderMedicines();
}

// Render medicines for current pharmacy
function renderMedicines() {
  const list = document.getElementById("pharmacyMedicineList");
  list.innerHTML = "";
  const medicines = pharmacyMedicines[currentPharmacy] || [];

  medicines.forEach((med, index) => {
    const inCart = cart.find(i => i.name === med.name);
    const controls = inCart
      ? `<div class="qty-controls">
          <button onclick="updateQty('${med.name}', -1)">-</button>
          <span>${inCart.qty}</span>
          <button onclick="updateQty('${med.name}', 1)">+</button>
        </div>`
      : `<button onclick="addToCart('${med.name}', ${med.price}, '${med.img}')">Add to Cart</button>`;

    const card = document.createElement("div");
    card.className = "medicine-card";
    card.innerHTML = `
      <img src="${med.img}" alt="${med.name}">
      <h4>${med.name}</h4>
      <p>৳${med.price}</p>
      ${controls}`;
    list.appendChild(card);
  });
}

// Add to cart
function addToCart(name, price, img) {
  const existing = cart.find(i => i.name === name);
  if (existing) {
    existing.qty++;
  } else {
    cart.push({ name, price, img, qty: 1 });
  }
  renderMedicines();
}

// Update qty
function updateQty(name, change) {
  const item = cart.find(i => i.name === name);
  if (!item) return;
  item.qty += change;
  if (item.qty <= 0) {
    cart = cart.filter(i => i.name !== name);
  }
  renderMedicines();
  renderCart();
}

// Show cart
function showCart() {
  if (!cart.length) {
    alert("Your cart is empty!");
    return;
  }
  showSection("pharmacyCartSection");
  renderCart();
}


// Render cart items
function renderCart() {
  const list = document.getElementById("cartItemsList");
  const totalSpan = document.getElementById("cartTotal");
  list.innerHTML = "";
  let total = 0;

  cart.forEach(item => {
    total += item.price * item.qty;
    const card = document.createElement("div");
    card.className = "medicine-card";
    card.innerHTML = `
      <img src="${item.img}" alt="${item.name}">
      <h4>${item.name}</h4>
      <p>৳${item.price}</p>
      <div class="qty-controls">
        <button onclick="updateQty('${item.name}', -1)">-</button>
        <span>${item.qty}</span>
        <button onclick="updateQty('${item.name}', 1)">+</button>
      </div>
    `;
    list.appendChild(card);
  });

  totalSpan.innerText = "৳" + total;
}


// Clear cart
function clearCart() {
  cart = [];
  renderCart();
}

// Back to pharmacy list
function backToPharmacy() {
  showSection("pharmacy");
}

// Back to medicines
function backToMedicines() {
  showSection("pharmacyMedicinesSection");
  renderMedicines();
}

// Checkout
// Checkout
function checkoutCart() {
  if (!cart.length) {
    alert("Your cart is empty!");
    return;
  }
  showSection("deliverySection");
  renderOrderSummary();
}

// Render order summary with interactive controls
function renderOrderSummary() {
  const orderSummary = document.getElementById("orderSummary");
  const orderTotal = document.getElementById("orderTotal");
  orderSummary.innerHTML = "";
  let total = 0;

  if (!cart.length) {
    orderSummary.innerHTML = "<p>Your cart is empty.</p>";
    orderTotal.innerText = "৳0";
    return;
  }

  // Create table
  const table = document.createElement("table");
  table.style.width = "100%";
  table.style.borderCollapse = "collapse";

  // Table header
  const thead = document.createElement("thead");
  thead.innerHTML = `
    <tr style="background:#f0f0f0;">
      <th style="padding:8px;">Image</th>
      <th style="padding:8px;">Name</th>
      <th style="padding:8px;">Unit Price</th>
      <th style="padding:8px;">Quantity</th>
      <th style="padding:8px;">Total</th>
      <th style="padding:8px;">Action</th>
    </tr>
  `;
  table.appendChild(thead);

  // Table body
  const tbody = document.createElement("tbody");

  cart.forEach(item => {
    total += item.price * item.qty;
    const tr = document.createElement("tr");
    tr.style.borderBottom = "1px solid #ccc";
    tr.innerHTML = `
      <td style="padding:8px; text-align:center;"><img src="${item.img}" alt="${item.name}" style="width:50px;height:50px;"></td>
      <td style="padding:8px;">${item.name}</td>
      <td style="padding:8px;">৳${item.price}</td>
      <td style="padding:8px; text-align:center;">
        <button onclick="updateQty('${item.name}', -1); renderOrderSummary();">-</button>
        <span style="margin:0 8px;">${item.qty}</span>
        <button onclick="updateQty('${item.name}', 1); renderOrderSummary();">+</button>
      </td>
      <td style="padding:8px;">৳${item.price * item.qty}</td>
      <td style="padding:8px; text-align:center;">
        <button onclick="removeFromCart('${item.name}'); renderOrderSummary();">X</button>
      </td>
    `;
    tbody.appendChild(tr);
  });

  table.appendChild(tbody);
  orderSummary.appendChild(table);

  orderTotal.innerText = "৳" + total;

}

function removeFromCart(name) {
  cart = cart.filter(i => i.name !== name);
  renderCart();
  renderOrderSummary();
}
//prescription
const prescriptionInput = document.getElementById("custPrescription");
const prescriptionFileName = document.getElementById("prescriptionFileName");

prescriptionInput.addEventListener("change", function() {
  if (this.files && this.files.length > 0) {
    prescriptionFileName.textContent = this.files[0].name;
  } else {
    prescriptionFileName.textContent = "No file selected";
  }
});


// Place order
function placeOrder() {
  const name = document.getElementById("custName").value;
  const phone = document.getElementById("custPhone").value;
  const city = document.getElementById("custCity").value;
  const address = document.getElementById("custAddress").value;
  const prescriptionFile = document.getElementById("custPrescription").files[0];
  const paymentMethod = document.querySelector("input[name='payment']:checked")?.value;

  if (!phone || !city || !address) {
    alert("Please fill all required delivery details.");
    return;
  }

  // Build order summary
  let orderText = "📦 Order placed successfully!\n\nItems:\n";
  cart.forEach(item => {
    orderText += `${item.name} x${item.qty} = ৳${item.price * item.qty}\n`;
  });

  const total = cart.reduce((sum, i) => sum + i.price * i.qty, 0);
  orderText += `\nTotal: ৳${total}\n`;

  // Prescription info
  orderText += prescriptionFile ? `Prescription: ${prescriptionFile.name}\n` : "Prescription: None\n";

  // Payment method
  orderText += `Payment: ${paymentMethod === "online" ? "Online Payment" : "Cash on Delivery"}\n`;

  // Delivery details
  orderText += `\nDelivery To:\n${name || "N/A"}\n${phone}\n${city}\n${address}`;

  alert(orderText);

  // Reset cart + form
  cart = [];
  document.getElementById("deliveryForm").reset();
  document.getElementById("prescriptionFileName").innerText = "";
  showSection("pharmacyMedicinesSection");
}
// ==================== Patient Profile ====================

let patientProfile = {
  name: "Shizan Sarkar",
  email: "shizan@example.com",
  phone: "01712345678"
};

// Open Profile Section
function showProfile() {
  showSection("profileSection");
  loadProfile();
}

// Load profile data into the form
function loadProfile() {
  document.getElementById("profileName").value = patientProfile.name;
  document.getElementById("profileEmail").value = patientProfile.email;
  document.getElementById("profilePhone").value = patientProfile.phone;


  document.getElementById("navbarProfileName").innerText = patientProfile.name;
}

// Enable editing for a specific input field
function enableEdit(fieldId) {
    const input = document.getElementById(fieldId);
    input.disabled = false;
    input.focus();
}

// Save profile changes
document.getElementById("profileForm").addEventListener("submit", function(e) {
  e.preventDefault();

  // Update patientProfile object
  patientProfile.name = document.getElementById("profileName").value;
  patientProfile.email = document.getElementById("profileEmail").value;
  patientProfile.phone = document.getElementById("profilePhone").value;

  document.getElementById("navbarProfileName").innerText = patientProfile.name;

  alert("Profile updated successfully!");
});



// ==================== Blood Bank ====================
// Sample blood bank data
const bloodBank = [
  { hospital: "City General Hospital", bloodGroup: "A+", units: 5, donors: [{ name: "Alice", contact: "01711112222" }, { name: "Bob", contact: "01733334444" }] },
  { hospital: "Sunrise Diagnostics", bloodGroup: "A+", units: 3, donors: [{ name: "John", contact: "01855556666" }] },
  { hospital: "City General Hospital", bloodGroup: "O-", units: 2, donors: [{ name: "Sarah", contact: "01977778888" }] }
];

// ==================== Show Blood Bank Section ====================
function showBloodBank() {
  showSection("bloodBankSection");
  renderBloodList(bloodBank);
}

// ==================== Render Blood List ====================
function renderBloodList(list) {
  const container = document.getElementById("bloodList");
  container.innerHTML = "";

  if (!list.length) {
    container.innerHTML = "<p>No blood units found.</p>";
    return;
  }

  list.forEach(item => {
    const donorsHtml = item.donors.map(d =>
      `<button class="donor-btn" onclick="askDonor('${d.name}', '${d.contact}', '${item.hospital}', '${item.bloodGroup}')">${d.name}</button>`
    ).join(" ");

    const card = document.createElement("div");
    card.className = "blood-card";
    card.innerHTML = `
      <p><strong>Hospital:</strong> ${item.hospital}</p>
      <p><strong>Blood Group:</strong> ${item.bloodGroup}</p>
      <p><strong>Units Available:</strong> ${item.units}</p>
      <p><strong>Donors:</strong> ${donorsHtml || "No donors listed"}</p>
      <button ${item.units === 0 ? "disabled" : ""} onclick="requestBlood('${item.hospital}', '${item.bloodGroup}')">
        Request Blood
      </button>
    `;
    container.appendChild(card);
  });
}

// ==================== Search Blood Units ====================
function searchBlood() {
  const bloodGroup = document.getElementById("bloodSearch").value;
  const hospital = document.getElementById("hospitalSelectBB")?.value || "";

  const results = bloodBank.filter(item =>
    item.bloodGroup === bloodGroup && (hospital === "" || item.hospital === hospital)
  );

  renderBloodList(results);
}

// ==================== Ask Donor ====================
function askDonor(name, contact, hospital, bloodGroup) {
  document.getElementById("donorName").textContent = name;
  document.getElementById("donorContact").textContent = contact;
  document.getElementById("donorHospital").textContent = hospital;
  document.getElementById("donorBloodGroup").textContent = bloodGroup;

  document.getElementById("donorModal").style.display = "flex";
}

function closeDonorModal() {
  document.getElementById("donorModal").style.display = "none";
}


// ==================== Request Blood ====================
// Track blood requests
let bloodRequests = [];

// ==================== Request Blood ====================
// Open modal with hospital and blood info
function requestBlood(hospital, bloodGroup) {
  const item = bloodBank.find(b => b.hospital === hospital && b.bloodGroup === bloodGroup);

  if (!item || item.units <= 0) {
    alert("Sorry, no units available for this blood group.");
    return;
  }

  document.getElementById("reqHospital").value = hospital;
  document.getElementById("reqBloodGroup").value = bloodGroup;
  document.getElementById("bloodRequestModal").style.display = "flex";
}

// Close modal
function closeBloodRequestModal() {
  document.getElementById("bloodRequestModal").style.display = "none";
  document.getElementById("bloodRequestForm").reset();
}

// Handle form submission
document.getElementById("bloodRequestForm").addEventListener("submit", function(e) {
  e.preventDefault();

  const name = document.getElementById("reqName").value;
  const phone = document.getElementById("reqPhone").value;
  const note = document.getElementById("reqNote").value;
  const hospital = document.getElementById("reqHospital").value;
  const bloodGroup = document.getElementById("reqBloodGroup").value;

  // Decrease unit
  const item = bloodBank.find(b => b.hospital === hospital && b.bloodGroup === bloodGroup);
  if (item) item.units -= 1;

  // Record request
  bloodRequests.push({ name, phone, note, hospital, bloodGroup, date: new Date().toLocaleString() });

  alert(`Blood request successful!\n${bloodGroup} blood requested from ${hospital}.`);

  // Close modal and refresh list
  closeBloodRequestModal();
  searchBlood();
});


updateDashboard();