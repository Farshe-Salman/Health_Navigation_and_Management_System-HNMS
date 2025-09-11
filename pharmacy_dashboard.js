// ============================
// HNMS Pharmacy Dashboard JS
// ============================

// ----- Data Storage (Demo Arrays) -----
let inventory = JSON.parse(localStorage.getItem("medicines")) || [];

let orders = [
    {
        id: 1001,
        customer: "Rahim",
        phone: "01712345678",
        region: "Dhaka",
        city: "Dhaka",
        area: "Dhanmondi",
        address: "House 12, Road 5",
        medicines: "Paracetamol x 2, ORS x 1",
        total: 120,
        prescription: null,
        paymentMethod: "cod",
        status: "Pending",
        date: "2025-09-11 14:30"
    },
    {
        id: 1002,
        customer: "Karim",
        phone: "01898765432",
        region: "Chattogram",
        city: "Chattogram",
        area: "Pahartali",
        address: "House 45, Road 7",
        medicines: "Amoxicillin x 1",
        total: 10,
        prescription: null,
        paymentMethod: "digital",
        status: "Pending",
        date: "2025-09-11 15:00"
    }
];


let bill = [];

// ----- Verification -----
let verificationDocs = {
  tin: null,
  drug: null,
  gst: null,
  status: "Pending" // Pending / Approved / Rejected
};

// ----- Pharmacy Profile -----
let pharmacyProfile = {
  name: "City Pharmacy",
  email: "citypharmacy@example.com",
  phone: "01712345678",
  address: "Dhaka, Bangladesh",
  hours: "9:00 AM - 10:00 PM"
};

// ----- DOM Elements -----
const sidebar = document.getElementById('sidebar');
const medicineList = document.getElementById('medicineList');
const ordersList = document.getElementById('ordersList');
const billItems = document.getElementById('billItems');
const billTotal = document.getElementById('billTotal');
const pendingOrders = document.getElementById('pendingOrders');
const todaysSales = document.getElementById('todaysSales');
const lowStockList = document.getElementById('lowStockList');
const notificationCount = document.getElementById('notificationCount');

// ==================== Inventory Functions ====================
function renderInventory() {
    const medicines = JSON.parse(localStorage.getItem("medicines")) || [];
    medicineList.innerHTML = '';
    if (medicines.length === 0) {
        medicineList.innerHTML = `<tr><td colspan="7">No medicines added yet</td></tr>`;
        return;
    }
    medicines.forEach((med) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${med.name}</td>
            <td>${med.category}</td>
            <td>${med.stock}</td>
            <td>${med.price}</td>
            <td>${med.expiry}</td>
            <td>
                 Drug License: ${med.documents.drugLicense ? "✅" : "❌"} <br>
                 Prescription: ${med.documents.prescriptionRequired} <br>
                 Import Cert: ${med.documents.importCert ? "✅" : "N/A"}
            </td>
            <td>
                <button class="btn-danger" onclick="deleteMedicine(${med.id})">Delete</button>
            </td>
        `;
        medicineList.appendChild(row);
    });
    updateLowStock();
}

function deleteMedicine(id) {
    let medicines = JSON.parse(localStorage.getItem("medicines")) || [];
    medicines = medicines.filter(med => med.id !== id);
    localStorage.setItem("medicines", JSON.stringify(medicines));
    renderInventory();
}

function updateLowStock() {
    const medicines = JSON.parse(localStorage.getItem("medicines")) || [];
    const lowStockItems = medicines.filter(m => m.stock <= 10);
    lowStockList.innerHTML = '';
    if(lowStockItems.length === 0){
        lowStockList.innerHTML = '<li>No low stock items</li>';
    } else {
        lowStockItems.forEach(item => {
            const li = document.createElement('li');
            li.innerText = `${item.name} - ${item.stock} pcs left`;
            lowStockList.appendChild(li);
        });
    }
}

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
// =====================notification====================
// ==================== Notifications ====================

// We'll use pending orders as notifications
function updateNotifications() {
    const panel = document.getElementById("notificationsPanel");
    const list = document.getElementById("notificationsList");

    // Pending orders as notifications
    const pendingOrdersArr = orders.filter(o => o.status === "Pending");

    // Update notification count
    notificationCount.textContent = pendingOrdersArr.length;

    // Populate notifications panel
    if (pendingOrdersArr.length > 0) {
        list.innerHTML = pendingOrdersArr.map((o, index) => `
            <div class="notification-item">
                <strong>Order #${o.id} from ${o.customer}</strong>
                <span class="date">${o.date || new Date().toLocaleString()}</span>
            </div>
        `).join('');
    } else {
        list.innerHTML = `<div class="notification-item">No notifications at the moment.</div>`;
    }

    // Hide panel by default
    panel.style.display = "none";
}

// Show/hide notifications panel
function showNotifications() {
    const panel = document.getElementById("notificationsPanel");
    if (panel.style.display === "flex") {
        panel.style.display = "none";
    } else {
        updateNotifications(); // Refresh notifications
        panel.style.display = "flex";
    }
}

// Close button for notifications
document.getElementById("closeNotifications").addEventListener("click", () => {
    document.getElementById("notificationsPanel").style.display = "none";
});

// Call this whenever orders are updated
function refreshNotifications() {
    updateNotifications();
}

// Example: refresh notifications whenever orders change
renderOrders();
refreshNotifications();

// ==================== Orders Functions ====================

function renderOrders() {
    ordersList.innerHTML = '';

    // Fetch orders from localStorage to sync patient-side orders
    orders = JSON.parse(localStorage.getItem("orders")) || orders;

    if(orders.length === 0){
        ordersList.innerHTML = `<tr><td colspan="10">No orders yet</td></tr>`;
        pendingOrders.innerText = 0;
        todaysSales.innerText = 0;
        return;
    }

    orders.forEach((order, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>#${order.id}</td>
            <td>${order.customer}<br>${order.phone}</td>
            <td>${order.region} / ${order.city} / ${order.area || '-'}</td>
            <td>${order.address}</td>
            <td>${order.medicines}</td>
            <td>৳${order.total}</td>
            <td>${order.prescription || 'N/A'}</td>
            <td>${order.paymentMethod === 'cod' ? 'Cash on Delivery' : 'Digital Payment'}</td>
            <td>${order.status}</td>
            <td>
                ${order.status === "Pending" ? `<button class="btn-primary" onclick="completeOrder(${index})">Mark as Completed</button>` : 'Completed'}
            </td>
        `;
        ordersList.appendChild(row);
    });

    updateDashboardMetrics();
}

function completeOrder(index) {
    orders[index].status = "Completed";
    localStorage.setItem("orders", JSON.stringify(orders)); // Persist change
    renderOrders();
}

function updateDashboardMetrics() {
    const pending = orders.filter(o => o.status === "Pending").length;
    pendingOrders.innerText = pending;

    const totalSales = orders
        .filter(o => o.status === "Completed")
        .reduce((sum, o) => sum + parseFloat(o.total), 0);

    todaysSales.innerText = totalSales;
}

// Initial call to load orders
renderOrders();

// ==================== Billing Functions ====================
function addToBill() {
    const name = document.getElementById('medicineName').value.trim();
    const qty = parseInt(document.getElementById('medicineQty').value);
    if(!name || isNaN(qty) || qty <= 0){
        alert("Enter valid medicine and quantity");
        return;
    }
    const medicines = JSON.parse(localStorage.getItem("medicines")) || [];
    const med = medicines.find(m => m.name.toLowerCase() === name.toLowerCase());
    if(!med){
        alert("Medicine not found in inventory");
        return;
    }
    if(med.stock < qty){
        alert(`Not enough stock. Available: ${med.stock}`);
        return;
    }
    const existing = bill.find(b => b.name === med.name);
    if(existing){
        existing.qty += qty;
    } else {
        bill.push({name: med.name, price: med.price, qty});
    }
    renderBill();
}

function renderBill() {
    billItems.innerHTML = '';
    let total = 0;
    bill.forEach(item => {
        const li = document.createElement('li');
        li.innerText = `${item.name} x ${item.qty} = ৳ ${item.price * item.qty}`;
        billItems.appendChild(li);
        total += item.price * item.qty;
    });
    billTotal.innerText = total;
}

function generateInvoice() {
    if(bill.length === 0){
        alert("Bill is empty!");
        return;
    }
    // Reduce stock
    let medicines = JSON.parse(localStorage.getItem("medicines")) || [];
    bill.forEach(item => {
        const med = medicines.find(m => m.name === item.name);
        if(med) med.stock -= item.qty;
    });
    localStorage.setItem("medicines", JSON.stringify(medicines));

    // Add order to orders list
    const orderId = orders.length ? orders[orders.length-1].id + 1 : 1001;
    const medicinesStr = bill.map(b => `${b.name} x ${b.qty}`).join(', ');
    const total = bill.reduce((sum,b) => sum + b.price*b.qty,0);
    orders.push({id: orderId, customer: "Walk-in", medicines: medicinesStr, total, status: "Completed"});
    bill = [];
    renderBill();
    renderInventory();
    renderOrders();
    alert("✅ Invoice generated and order completed!");
}

// ==================== Pharmacy Profile Functions ====================
function loadPharmacyProfile() {
  document.getElementById("profileName").value = pharmacyProfile.name;
  document.getElementById("profileEmail").value = pharmacyProfile.email;
  document.getElementById("profilePhone").value = pharmacyProfile.phone;
  document.getElementById("profileAddress").value = pharmacyProfile.address;
  document.getElementById("profileHours").value = pharmacyProfile.hours;
  document.getElementById("navbarPharmacyName").innerText = pharmacyProfile.name;

  // Update document statuses
  updateVerificationDocsStatus();
}

function enableEdit(fieldId) {
  const input = document.getElementById(fieldId);
  input.disabled = false;
  input.focus();
}

document.querySelector("#pharmacyProfile form").addEventListener("submit", function(e) {
  e.preventDefault();
  pharmacyProfile.name = document.getElementById("profileName").value;
  pharmacyProfile.email = document.getElementById("profileEmail").value;
  pharmacyProfile.phone = document.getElementById("profilePhone").value;
  pharmacyProfile.address = document.getElementById("profileAddress").value;
  pharmacyProfile.hours = document.getElementById("profileHours").value;
  document.getElementById("navbarPharmacyName").innerText = pharmacyProfile.name;
  alert("✅ Pharmacy profile updated successfully!");
});

// ==================== Verification Functions ====================
function uploadProfileDoc(docType) {
  const fileInput = document.getElementById(`${docType}File`);
  if(fileInput && fileInput.files.length > 0){
    if(docType === 'trade') verificationDocs.drug = fileInput.files[0].name;
    else verificationDocs[docType] = fileInput.files[0].name;

    alert(`✅ ${docType.toUpperCase()} uploaded successfully!`);
    updateVerificationDocsStatus();
    checkVerification();
  } else {
    alert("Please select a file to upload!");
  }
}

function updateVerificationDocsStatus() {
  document.getElementById("docTINStatus").innerText = verificationDocs.tin ? "✅ Uploaded" : "❌ Not Uploaded";
  document.getElementById("docDrugStatus").innerText = verificationDocs.drug ? "✅ Uploaded" : "❌ Not Uploaded";
  document.getElementById("docGSTStatus").innerText = verificationDocs.gst ? "✅ Uploaded" : "❌ Not Uploaded";
}

// ==================== Verification Status on Dashboard ====================
function checkVerification() {
  const notice = document.getElementById("verificationNotice");
  if (!notice) return;

  // Show notice only if pharmacy is not verified
  if (verificationDocs.status !== "Approved") {
    notice.style.display = "block";
    notice.innerHTML = `
      <p><strong>⚠️ Your pharmacy account is not verified.</strong></p>
      <p>Status: <b>${verificationDocs.status}</b></p>
      <p>Please upload <b>TIN</b>, <b>Drug License</b>, and <b>GST/VAT</b> 
      in the <a href="#" onclick="showSection('pharmacyProfile')">Profile Section</a> 
      for Superadmin approval.</p>
    `;
  } else {
    notice.style.display = "none"; // Hide if verified
  }
}

// Call it whenever dashboard loads
function showSection(sectionId, event) {
  document.querySelectorAll(".section").forEach(sec => sec.style.display = "none");
  const sec = document.getElementById(sectionId);
  if (sec) sec.style.display = "block";

  document.querySelectorAll(".sidebar a").forEach(link => link.classList.remove("active"));
  if (event && event.currentTarget) event.currentTarget.classList.add("active");

  if (window.innerWidth <= 768) {
    sidebar.classList.remove("show");
  }

  // Check verification when opening dashboard
  if (sectionId === "dashboard") {
    checkVerification();
  }
}

// ----- Initial Call on page load -----
showSection("dashboard");


// ==================== Sidebar & Sections ====================
function showSection(sectionId, event) {
  document.querySelectorAll(".section").forEach(sec => sec.style.display = "none");
  const sec = document.getElementById(sectionId);
  if (sec) sec.style.display = "block";

  document.querySelectorAll(".sidebar a").forEach(link => link.classList.remove("active"));
  if (event && event.currentTarget) event.currentTarget.classList.add("active");

  if (window.innerWidth <= 768) {
    sidebar.classList.remove("show");
  }

  if (sectionId === "dashboard") checkVerification();
}
// ==================== Add Medicine (Section-based) ====================
document.getElementById("addMedicineFormSection").addEventListener("submit", function (e) {
    e.preventDefault();

    const name = document.getElementById("medNameSection").value.trim();
    const category = document.getElementById("medCategorySection").value;
    const stock = parseInt(document.getElementById("medStockSection").value);
    const price = parseFloat(document.getElementById("medPriceSection").value);
    const expiry = document.getElementById("medExpirySection").value;


    const drugImage = document.getElementById("drugImageFileSection").files[0];
    const drugLicense = document.getElementById("drugLicenseFileSection").files[0];
    const prescriptionRequired = document.getElementById("prescriptionRequiredSection").value;
    const importCert = document.getElementById("importCertFileSection").files[0];

    // Validation
    if (!name || !category || isNaN(stock) || isNaN(price) || !expiry) {
        alert("⚠️ Please fill all required fields.");
        return;
    }

    if (!drugLicense) {
        alert("⚠️ Please upload a valid Drug License.");
        return;
    }

    if (prescriptionRequired === "yes" && !importCert) {
        alert("⚠️ Please upload Import Certificate for this medicine.");
        return;
    }

    const newMedicine = {
        id: Date.now(),
        name,
        category,
        stock,
        price,
        expiry,
        documents: {
            drugImage: drugImage.name,
            drugLicense: drugLicense.name,
            prescriptionRequired,
            importCert: importCert ? importCert.name : null
        }
    };

    let medicines = [];
    medicines.push(newMedicine);

    renderInventory();
    // Reset form
    document.getElementById("addMedicineFormSection").reset();
    // Navigate back to inventory section
    showSection("inventory");
    alert("✅ Medicine added successfully with required documents.");
});

// ==================== Open Add Medicine Section ====================
function openAddMedicineSection() {
    showSection("addMedicineSection");
}
// ==================== Preload some medicines ====================
let medicines = [
    {
        id: 1,
        name: "Paracetamol",
        category: "Painkiller",
        stock: 50,
        price: 15.0,
        expiry: "2026-12-31",
        documents: {
            drugImage:null ,
            drugLicense: null,
            prescriptionRequired: "no",
            importCert: null
        }
    },
    {
        id: 2,
        name: "Amoxicillin",
        category: "Antibiotic",
        stock: 30,
        price: 25.0,
        expiry: "2025-09-30",
        documents: {
            drugImage: null ,
            drugLicense: null,
            prescriptionRequired: "yes",
            importCert: null
        }
    },
    {
        id: 3,
        name: "Cetirizine",
        category: "Antihistamine",
        stock: 20,
        price: 10.0,
        expiry: "2026-05-15",
        documents: {
            drugImage: null,
            drugLicense: null,
            prescriptionRequired: "no",
            importCert: null
        }
    },
    {
        id: 4,
        name: "Napa",
        category: "Antihistamine",
        stock: 20,
        price: 10.0,
        expiry: "2026-05-15",
        documents: {
            drugImage: null,
            drugLicense: null,
            prescriptionRequired: "no",
            importCert: null
        }
    },
    {
        id: 5,
        name: "Cetirizine",
        category: "Antihistamine",
        stock: 20,
        price: 10.0,
        expiry: "2026-05-15",
        documents: {
            drugImage: null,
            drugLicense: null,
            prescriptionRequired: "no",
            importCert: null
        }
    }
];

// ==================== Render Medicine Inventory ====================
function renderInventory() {
    const container = document.getElementById('inventoryMedicineList');
    container.innerHTML = '';

    if (medicines.length === 0) {
        container.innerHTML = '<p>No medicines available. Add new medicines.</p>';
        return;
    }

    medicines.forEach((med) => {
        const item = document.createElement('div');
        item.classList.add('medicine-item');

        item.innerHTML = `
            <div class="medicine-card">
             <img src="image.png" alt="${med.name}" >
                <h4>${med.name}</h4>
                <p>Category: ${med.category}</p>
                <p>Price: ৳ ${med.price}</p>
                <p>Stock: ${med.stock}</p>
                <p>Expiry: ${med.expiry}</p>
            
                <button class="edit-btn" onclick="editMedicine(${med.id})">Edit</button>
                <button class="delete-btn" onclick="deleteMedicine(${med.id})">Delete</button>
            </div>
        `;

        container.appendChild(item);
    });
}

// ==================== Delete Medicine ====================
function deleteMedicine(id) {
    medicines = medicines.filter(m => m.id !== id);
    renderInventory();
}

// ==================== Enable Inputs / Files ====================
function enableEdit(inputId) {
    const input = document.getElementById(inputId);
    if (input) {
        input.disabled = false;
        input.focus();
    }
}

function enableFile(fileInputId) {
    const fileInput = document.getElementById(fileInputId);
    if (fileInput) {
        fileInput.disabled = false; // Enable the file input
        fileInput.click();          // Optional: automatically open file dialog
    }
}

// ==================== Edit Medicine ====================
function editMedicine(id) {
    const med = medicines.find(m => m.id === id);
    if (!med) {
        alert("Medicine not found!");
        return;
    }

    showSection("editMedicineSection");

    // Populate form fields
    document.getElementById("medNameSection").value = med.name;
    document.getElementById("medCategorySection").value = med.category;
    document.getElementById("medStockSection").value = med.stock;
    document.getElementById("medPriceSection").value = med.price;
    document.getElementById("medExpirySection").value = med.expiry;
    document.getElementById("prescriptionRequiredSection").value = med.documents.prescriptionRequired;

    // Clear file inputs
    document.getElementById("editdrugImageFileSection").value = '';
    document.getElementById("editdrugLicenseFileSection").value = '';
    document.getElementById("editimportCertFileSection").value = '';

    // Handle form submission
    const form = document.getElementById("editMedicineFormSection");
    form.onsubmit = function(e) {
        e.preventDefault();

        // Update medicine details
        med.name = document.getElementById("medNameSection").value.trim();
        med.category = document.getElementById("medCategorySection").value;
        med.stock = parseInt(document.getElementById("medStockSection").value);
        med.price = parseFloat(document.getElementById("medPriceSection").value);
        med.expiry = document.getElementById("medExpirySection").value;
        med.documents.prescriptionRequired = document.getElementById("prescriptionRequiredSection").value;

        // Update documents if files are selected
        const drugImage = document.getElementById("editdrugImageFileSection").files[0];
        const drugLicense = document.getElementById("editdrugLicenseFileSection").files[0];
        const importCert = document.getElementById("editimportCertFileSection").files[0];

        if (drugImage) med.documents.drugImage = drugImage.name;
        if (drugLicense) med.documents.drugLicense = drugLicense.name;
        if (importCert) med.documents.importCert = importCert.name;

        alert("✅ Medicine updated successfully!");
        renderInventory();
        showSection("inventory");
    }
}


// ==================== Initial Load ====================
renderInventory();        
renderOrders();
updateDashboardMetrics();
loadPharmacyProfile();
