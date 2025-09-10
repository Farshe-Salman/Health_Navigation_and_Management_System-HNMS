// ============================
// HNMS Pharmacy Dashboard JS
// ============================

// ----- Data Storage (Demo Arrays) -----
let inventory = [
    {name: "Paracetamol", category: "Tablet", stock: 100, price: 5, expiry: "2026-01-15"},
    {name: "Amoxicillin", category: "Capsule", stock: 50, price: 10, expiry: "2025-12-30"}
];

let orders = [
    {id: 1001, customer: "Rahim", medicines: "Paracetamol x 2, ORS x 1", total: 120, status: "Pending"},
    {id: 1002, customer: "Karim", medicines: "Amoxicillin x 1", total: 10, status: "Pending"}
];

let staff = [
    {name: "Hasan", role: "Pharmacist", contact: "01712345678"},
    {name: "Salma", role: "Assistant", contact: "01798765432"}
];

let bill = [];

// ----- DOM Elements -----
const medicineList = document.getElementById('medicineList');
const ordersList = document.getElementById('ordersList');
const staffList = document.getElementById('staffList');
const billItems = document.getElementById('billItems');
const billTotal = document.getElementById('billTotal');
const pendingOrders = document.getElementById('pendingOrders');
const todaysSales = document.getElementById('todaysSales');
const lowStockList = document.getElementById('lowStockList');

// ----- Utility Functions -----
function renderInventory() {
    medicineList.innerHTML = '';
    inventory.forEach((med, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${med.name}</td>
            <td>${med.category}</td>
            <td>${med.stock}</td>
            <td>${med.price}</td>
            <td>${med.expiry}</td>
            <td>
                <button class="btn-secondary" onclick="editMedicine(${index})">Edit</button>
                <button class="btn-danger" onclick="deleteMedicine(${index})">Delete</button>
            </td>
        `;
        medicineList.appendChild(row);
    });
    updateLowStock();
}

function renderOrders() {
    ordersList.innerHTML = '';
    orders.forEach((order, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>#${order.id}</td>
            <td>${order.customer}</td>
            <td>${order.medicines}</td>
            <td>${order.total}</td>
            <td>${order.status}</td>
            <td>
                ${order.status === "Pending" ? `<button class="btn-primary" onclick="completeOrder(${index})">Mark as Completed</button>` : 'Completed'}
            </td>
        `;
        ordersList.appendChild(row);
    });
    updateDashboardMetrics();
}

function renderStaff() {
    staffList.innerHTML = '';
    staff.forEach((member, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${member.name}</td>
            <td>${member.role}</td>
            <td>${member.contact}</td>
            <td><button class="btn-danger" onclick="removeStaff(${index})">Remove</button></td>
        `;
        staffList.appendChild(row);
    });
}

function updateDashboardMetrics() {
    const pending = orders.filter(o => o.status === "Pending").length;
    pendingOrders.innerText = pending;
    const totalSales = orders.filter(o => o.status === "Completed").reduce((sum, o) => sum + o.total, 0);
    todaysSales.innerText = totalSales;
}

function updateLowStock() {
    const lowStockItems = inventory.filter(m => m.stock <= 10);
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

// ----- Inventory Functions -----
function addMedicine() {
    const name = prompt("Medicine Name:");
    const category = prompt("Category:");
    const stock = parseInt(prompt("Stock Quantity:"));
    const price = parseFloat(prompt("Price (৳):"));
    const expiry = prompt("Expiry Date (YYYY-MM-DD):");
    if(name && category && !isNaN(stock) && !isNaN(price) && expiry){
        inventory.push({name, category, stock, price, expiry});
        renderInventory();
    }
}

function editMedicine(index) {
    const med = inventory[index];
    const name = prompt("Medicine Name:", med.name);
    const category = prompt("Category:", med.category);
    const stock = parseInt(prompt("Stock Quantity:", med.stock));
    const price = parseFloat(prompt("Price (৳):", med.price));
    const expiry = prompt("Expiry Date (YYYY-MM-DD):", med.expiry);
    if(name && category && !isNaN(stock) && !isNaN(price) && expiry){
        inventory[index] = {name, category, stock, price, expiry};
        renderInventory();
    }
}

function deleteMedicine(index) {
    if(confirm(`Are you sure you want to delete ${inventory[index].name}?`)){
        inventory.splice(index,1);
        renderInventory();
    }
}

// ----- Orders Functions -----
function completeOrder(index) {
    orders[index].status = "Completed";
    renderOrders();
}

// ----- Billing Functions -----
function addToBill() {
    const name = document.getElementById('medicineName').value.trim();
    const qty = parseInt(document.getElementById('medicineQty').value);
    if(!name || isNaN(qty) || qty <= 0){
        alert("Enter valid medicine and quantity");
        return;
    }
    const med = inventory.find(m => m.name.toLowerCase() === name.toLowerCase());
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
    bill.forEach(item => {
        const med = inventory.find(m => m.name === item.name);
        if(med) med.stock -= item.qty;
    });
    // Add order to orders list
    const orderId = orders.length ? orders[orders.length-1].id + 1 : 1001;
    const medicinesStr = bill.map(b => `${b.name} x ${b.qty}`).join(', ');
    const total = bill.reduce((sum,b) => sum + b.price*b.qty,0);
    orders.push({id: orderId, customer: "Walk-in", medicines: medicinesStr, total, status: "Completed"});
    bill = [];
    renderBill();
    renderInventory();
    renderOrders();
    alert("Invoice generated and order completed!");
}

// ----- Staff Functions -----
function addStaff() {
    const name = prompt("Staff Name:");
    const role = prompt("Role:");
    const contact = prompt("Contact Number:");
    if(name && role && contact){
        staff.push({name, role, contact});
        renderStaff();
    }
}

function removeStaff(index) {
    if(confirm(`Remove staff ${staff[index].name}?`)){
        staff.splice(index,1);
        renderStaff();
    }
}

// ==================== Pharmacy Profile ====================

// Sample pharmacy profile
let pharmacyProfile = {
  name: "City Pharmacy",
  email: "citypharmacy@example.com",
  phone: "01712345678",
  address: "Dhaka, Bangladesh",
  hours: "9:00 AM - 10:00 PM"
};

// Open Pharmacy Profile Section
function showPharmacyProfile() {
  showSection("pharmacyProfile"); // Section ID
  loadPharmacyProfile();
}

// Load pharmacy profile data into form
function loadPharmacyProfile() {
  document.getElementById("profileName").value = pharmacyProfile.name;
  document.getElementById("profileEmail").value = pharmacyProfile.email;
  document.getElementById("profilePhone").value = pharmacyProfile.phone;
  document.getElementById("profileAddress").value = pharmacyProfile.address;
  document.getElementById("profileHours").value = pharmacyProfile.hours;


   // Update navbar name dynamically
    document.getElementById("navbarPharmacyName").innerText = pharmacyProfile.name;
}

// Enable editing for a specific input field
function enableEdit(fieldId) {
    const input = document.getElementById(fieldId);
    input.disabled = false;
    input.focus();
}
// Save profile changes
document.querySelector("#pharmacyProfile form").addEventListener("submit", function(e) {
  e.preventDefault();

  pharmacyProfile.name = document.getElementById("profileName").value;
  pharmacyProfile.email = document.getElementById("profileEmail").value;
  pharmacyProfile.phone = document.getElementById("profilePhone").value;
  pharmacyProfile.address = document.getElementById("profileAddress").value;
  pharmacyProfile.hours = document.getElementById("profileHours").value;

   // Update navbar name dynamically
    document.getElementById("navbarPharmacyName").innerText = pharmacyProfile.name;

  alert("Pharmacy profile updated successfully!");
});




// ----- Sidebar & Notifications -----
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
// ----- Initial Render -----
renderInventory();
renderOrders();
renderStaff();
updateDashboardMetrics();
