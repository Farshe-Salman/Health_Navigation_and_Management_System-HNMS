<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
         <!-- Pharmacy Section -->
      <div id="pharmacy" class="section">
        <h3>Pharmacy & Medicines</h3>
        <input type="text" placeholder="Search pharmacy or medicine..." id="searchPharmacy">

        <div class="pharmacy-list">
          <!-- Example Pharmacy Card -->
          <div class="pharmacy-card">
            <img src="pharmacy1.jpg" alt="City Pharmacy">
            <div class="pharmacy-info">
              <h4>City Pharmacy</h4>
              <p class="status">Status: Open (9:00 AM - 10:00 PM)</p>
              <p class="location">Location: Dhaka, Bangladesh</p>
            </div>
            <div class="button-group">
              <button class="btn-primary" onclick="openMedicineCatalog('City Pharmacy')">View All Products</button>
              <button class="btn-secondary">View Details</button>
            </div>
          </div>

          <!-- phar2 -->
          <div class="pharmacy-card">
            <img src="pharmacy1.jpg" alt="Lazz Pharmacy">
            <div class="pharmacy-info">
              <h4>Lazz Pharmacy</h4>
              <p class="status">Status: Open (9:00 AM - 10:00 PM)</p>
              <p class="location">Location: Dhaka, Bangladesh</p>
            </div>
            <div class="button-group">
              <button class="btn-primary" onclick="openMedicineCatalog('City Pharmacy')">View Medicines</button>
              <button class="btn-secondary">View Details</button>
            </div>
          </div>

          <!-- phar3 -->
          <div class="pharmacy-card">
            <img src="pharmacy1.jpg" alt="Tamanna Pharmacy">
            <div class="pharmacy-info">
              <h4>Tamanna Pharmacy</h4>
              <p class="status">Status: Open (9:00 AM - 10:00 PM)</p>
              <p class="location">Location: Dhaka, Bangladesh</p>
            </div>
            <div class="button-group">
              <button class="btn-primary" onclick="openMedicineCatalog('City Pharmacy')">View Medicines</button>
              <button class="btn-secondary">View Details</button>
            </div>
          </div>


          <!-- Add other pharmacy cards here -->
        </div>
      </div>

      <!-- Pharmacy Medicines Section -->
      <div id="pharmacyMedicinesSection" class="section" style="display:none;">
        <div class="med-header">
          <h3 id="medSectionTitle">Pharmacy Medicines</h3>
          <div class="med-header-buttons">
            <button class="btn-secondary" onclick="showCart()">View Cart</button>
            <button class="btn-secondary" onclick="backToPharmacy()">Back to Pharmacies</button>
          </div>
        </div>

        <div id="pharmacyMedicineList" class="medicine-list">
          <!-- Medicines will be dynamically loaded here via JS -->
        </div>
      </div>

      <!-- Pharmacy Cart Section -->
      <div id="pharmacyCartSection" class="section" style="display:none;">
        <div class="med-header">
          <h3>My Cart</h3>
          <div class="med-header-buttons">
            <button class="btn-secondary" onclick="backToMedicines()">Back to Medicines</button>
          </div>
        </div>

        <div id="cartItemsList" class="medicine-list">
          <!-- Cart items dynamically loaded -->
        </div>

        <h4>Total: <span id="cartTotal">৳0</span></h4>
        <div class="cart-actions">
          <button class="btn-primary" onclick="checkoutCart()">Checkout</button>
          <button class="btn-secondary" onclick="clearCart()">Clear Cart</button>
        </div>
      </div>



      <!-- Delivery / Order Section -->
      <div id="deliverySection" class="section" style="display:none;">
        <h3>Delivery Details & Order Summary</h3>
        <div class="delivery-container">

          <!-- LEFT: Order Summary -->
          <div class="order-box">
            <h4>Order Summary</h4>
            <div id="orderSummary" style="margin-bottom: 20px;"></div>
            <h4>Total Payable: <span id="orderTotal">৳0</span></h4>
          </div>

          <!-- RIGHT: Delivery Form -->
          <div class="form-box">
            <form id="deliveryForm">
              <div class="form-row">
                <div class="form-group">
                  <label>Receiver Name (Optional)</label>
                  <input type="text" id="custName">
                </div>
                <div class="form-group">
                  <label>Receiver Phone*</label>
                  <input type="tel" id="custPhone" placeholder="+8801XXXXXXXXX" required>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group">
                  <label>Region*</label>
                  <select id="custRegion" required>
                    <option value="">Select Region</option>
                    <option>Dhaka</option>
                    <option>Chattogram</option>
                    <option>Rajshahi</option>
                    <option>Khulna</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>City*</label>
                  <input type="text" id="custCity" required>
                </div>
                <div class="form-group">
                  <label>Area (Optional)</label>
                  <input type="text" id="custArea">
                </div>
              </div>

              <div class="form-group">
                <label>Address*</label>
                <textarea id="custAddress" required></textarea>
              </div>

              <!-- Prescription Upload -->
              <div class="form-group prescription-upload">
                <label for="custPrescription" class="btn-prescription">
                  Select Prescription (optional)
                </label>
                <input type="file" id="custPrescription" accept="image/*,.pdf" style="display:none;">
                <span id="prescriptionFileName" class="file-name">No file selected</span>
              </div>


              <!-- Payment Options -->
              <div class="form-group">
                <label>Payment Method*</label>
                <select id="paymentMethod" required>
                  <option value="">Select Payment Method</option>
                  <option value="cod">Cash on Delivery</option>
                  <option value="digital">Digital Payment</option>

                </select>
              </div>

              <button type="button" class="btn-primary" onclick="placeOrder()">Place Order</button>
            </form>
          </div>
        </div>
      </div>
</body>
</html>