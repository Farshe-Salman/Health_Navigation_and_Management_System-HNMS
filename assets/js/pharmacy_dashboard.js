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
const notificationsPanel = document.getElementById('notificationsPanel');
const notificationsList = document.getElementById('notificationsList');
const orderHistoryList = document.getElementById('orderHistoryList');


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


// ==================== Render Orders (Dashboard) ====================
function renderOrders() {
    const ordersList = document.getElementById('ordersList');
    ordersList.innerHTML = '';

    if (orders.length === 0) {
        ordersList.innerHTML = `<tr><td colspan="11">No orders yet</td></tr>`;
        return;
    }

    orders.forEach((order, index) => {
        const tr = document.createElement('tr');

        // Update column content
        let updateContent = '';
        if (order.status === "Pending") {
            updateContent = `
                <button onclick="completeOrder(${index})">Mark Completed</button>
                <button onclick="rejectOrder(${index})" style="margin-top:5px; background: red ; color: white ;">Reject</button>
            `;
        } else {
            updateContent = order.status;
        }

        tr.innerHTML = `
            <td data-label="Order ID">#${order.id}</td>
            <td data-label="Customer">${order.customer}<br>${order.phone}</td>
            <td data-label="Region">${order.region} / ${order.city} / ${order.area || '-'}</td>
            <td data-label="Address">${order.address}</td>
            <td data-label="Medicines">${order.medicines}</td>
            <td data-label="Total">৳${order.total}</td>
            <td data-label="Prescription">${order.prescription || 'N/A'}</td>
            <td data-label="Payment">${order.paymentMethod === 'cod' ? 'Cash on Delivery' : 'Digital Payment'}</td>
            <td data-label="Status">${order.status}</td>
            <td data-label="Update">${updateContent}</td>
            <td data-label="Actions">
                ${order.status !== "Rejected" ? `<button onclick="generateInvoice(${index})">Invoice</button>` : 'N/A'}
            </td>
        `;

        ordersList.appendChild(tr);
    });
}

// ==================== Render Order History (All Orders, No Actions) ====================
function renderOrderHistory() {
    const tbody = document.getElementById("orderHistoryList");
    tbody.innerHTML = "";

    if (orders.length === 0) {
        tbody.innerHTML = `<tr><td colspan="10">No orders yet.</td></tr>`;
        return;
    }

    orders.forEach((order) => {
        const tr = document.createElement("tr");
        tr.innerHTML = `
            <td data-label="Order ID">#${order.id}</td>
            <td data-label="Date">${order.date || new Date().toLocaleString()}</td>
            <td data-label="Customer">${order.customer}<br>${order.phone}</td>
            <td data-label="Region">${order.region} / ${order.city} / ${order.area || '-'}</td>
            <td data-label="Address">${order.address}</td>
            <td data-label="Medicines">${order.medicines}</td>
            <td data-label="Total">৳${parseFloat(order.total).toFixed(2)}</td>
            <td data-label="Prescription">${order.prescription || 'N/A'}</td>
            <td data-label="Payment">${order.paymentMethod === 'cod' ? 'Cash on Delivery' : 'Digital Payment'}</td>
            <td data-label="Status">${order.status}</td>
        `;
        tbody.appendChild(tr);
    });
}


// ==================== Complete Order & Invoice ====================
function completeOrder(index){
    orders[index].status = "Completed";
    renderOrders();
    updateNotifications();
    refreshOrdersAndDashboard(); // This ensures sales card updates immediately
    
}
// ==================== Reject Order ====================
function rejectOrder(index) {
    // Update the order status
    orders[index].status = "Rejected";
    // Refresh orders table
    renderOrders();
    // Refresh notifications panel
    updateNotifications();
    // Update dashboard cards (pending orders, sales, etc.)
    refreshOrdersAndDashboard(); 
}

// ==================== Generate Invoice ====================
function generateInvoice(index){
    const order = orders[index];
    const invoiceWindow = window.open('', 'Invoice', 'width=800,height=600');
    invoiceWindow.document.write(`
        <html>
        <head>
            <title>Invoice #${order.id}</title>
            <style>
                body{ font-family: Arial; padding: 20px; }
                h2{text-align:center;}
                table{width:100%; border-collapse: collapse; margin-top:20px;}
                table, th, td{border:1px solid #000;}
                th, td{padding:10px; text-align:left;}
                .totals{margin-top:20px; float:right;}
            </style>
        </head>
        <body>
            <h2>HNMS Pharmacy</h2>
            <p><strong>Invoice ID:</strong> #${order.id}</p>
            <p><strong>Customer:</strong> ${order.customer} (${order.phone})</p>
            <p><strong>Address:</strong> ${order.address}, ${order.area}, ${order.city}, ${order.region}</p>
            <table>
                <thead><tr><th>Medicine</th><th>Qty</th><th>Price (৳)</th></tr></thead>
                <tbody>
                    ${order.medicines.split(',').map(med=>{
                        const parts = med.trim().split(' x ');
                        return `<tr><td>${parts[0]}</td><td>${parts[1]||1}</td><td>৳${(parts[1]||1)*10}</td></tr>`;
                    }).join('')}
                </tbody>
            </table>
            <div class="totals">
                <p><strong>Total: ৳${order.total}</strong></p>
                <p><strong>Payment Method:</strong> ${order.paymentMethod === 'cod' ? 'Cash on Delivery' : 'Digital Payment'}</p>
                <p><strong>Status:</strong> ${order.status}</p>
            </div>
            <p>Thank you for ordering from HNMS Pharmacy!</p>
        </body>
        </html>
    `);
    invoiceWindow.document.close();
    invoiceWindow.print();
}

// ==================== Notifications ====================
function updateNotifications(){
    const pendingOrdersArr = orders.filter(o => o.status === "Pending");
    notificationCount.textContent = pendingOrdersArr.length;

    if(pendingOrdersArr.length > 0){
        notificationsList.innerHTML = pendingOrdersArr.map((o, idx) => `
            <div class="notification-item" data-order-index="${idx}">
                <strong>Order #${o.id} from ${o.customer}</strong>
                <span class="date">${o.date || new Date().toLocaleString()}</span>
            </div>
        `).join('');

        // Add click listener for each notification
        notificationsList.querySelectorAll('.notification-item').forEach(item => {
            item.onclick = () => {
                const index = parseInt(item.getAttribute('data-order-index'));
                
                // Show Orders section and scroll
                showSection('orders');    
                renderOrders();           
                window.scrollTo({top: document.getElementById('orders').offsetTop, behavior: 'smooth'});
                
                // Optionally: mark notification as "viewed" by removing it
                item.remove();

                // Update notification count
                notificationCount.textContent = notificationsList.querySelectorAll('.notification-item').length;
                
                // Hide panel if no notifications left
                if(notificationCount.textContent === "0"){
                    notificationsPanel.style.display = "none";
                }
            };
        });
    } else {
        notificationsList.innerHTML = `<div class="notification-item">No notifications at the moment.</div>`;
        notificationCount.textContent = 0;
    }
}

// Toggle notifications panel
function showNotifications(){
    if(notificationsPanel.style.display === "flex") {
        notificationsPanel.style.display = "none";
    } else { 
        updateNotifications(); 
        notificationsPanel.style.display = "flex"; 
    }
}

// ==================== Update Dashboard Cards ====================
function updateDashboardCards() {
    // Update Pending Orders
    const pendingCount = orders.filter(o => o.status === "Pending").length;
    document.getElementById("pendingOrders").textContent = pendingCount;

    // Update Today's Sales (sum of completed orders)
    const totalSales = orders
        .filter(o => o.status === "Completed")
        .reduce((sum, o) => sum + parseFloat(o.total), 0);
    document.getElementById("todaysSales").textContent = `৳ ${totalSales.toFixed(2)}`;
}

// ==================== Refresh Orders & Dashboard ====================
function refreshOrdersAndDashboard() {
    renderOrders();           // Refresh orders table
    updateNotifications();    // Refresh notifications panel
    updateDashboardCards();   // Update dashboard cards
    renderOrderHistory();     // Refresh order history table
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
refreshOrdersAndDashboard();
renderInventory();        
renderOrders();
loadPharmacyProfile();
renderOrderHistory();
